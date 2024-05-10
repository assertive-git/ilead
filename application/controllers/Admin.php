<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $public = ['login_get', 'login_post'];

        $route = $this->router->fetch_method();

        if (!in_array($route, $public) && empty($_SESSION['logged_in'])) {
            redirect('/admin/login');
        }
    }

    public function index()
    {
        $data['jobs'] = $this->jobs_model->get_all_admin();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/jobs');
        $this->load->view('admin/footer');
    }

    public function login_get()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/login');
        $this->load->view('admin/footer');
    }

    public function login_post()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == 'ilead' && $password === '0000') {
                $_SESSION['logged_in'] = true;
                redirect('/admin');
            } else {
                $data['error'] = 'ユーザー名またはパスワードが違います。';
                $this->load->view('admin/header', $data);
                $this->load->view('admin/login');
                $this->load->view('admin/footer');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('/admin/login');
    }

    public function jobs()
    {
        $data['jobs'] = $this->jobs_model->get_all_admin();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/jobs');
        $this->load->view('admin/footer');
    }

    public function jobs_new()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/job');
        $this->load->view('admin/footer');
    }

    public function jobs_get($id)
    {

        $data = $this->jobs_model->get_admin($id);
        $data['jobs_stations'] = $this->jobs_stations_model->get_all($id);
        $data['custom_fields'] = $this->custom_fields_model->get_all($id);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/job');
        $this->load->view('admin/footer');
    }

    public function jobs_stations()
    {

        if (!empty($_POST['job_id']) && !empty($_POST['region']) && !empty($_POST['pref']) && !empty($_POST['line']) && !empty($_POST['station']) && !empty($_POST['walking_distance'])) {

            $data = [
                'job_id' => $_POST['job_id'],
                'region' => $_POST['region'],
                'pref' => $_POST['pref'],
                'line' => $_POST['line'],
                'station' => $_POST['station'],
                'walking_distance' => $_POST['walking_distance'],
            ];

            $id = $this->jobs_stations_model->insert($data);

            echo json_encode(['id' => $id]);
        }

    }

    public function jobs_stations_delete()
    {
        if (!empty($_POST['id'])) {

            $id = $_POST['id'];

            $this->jobs_stations_model->delete($id);
        }
    }

    public function jobs_update()
    {


        $custom_fields = [];
        $remove_custom_fields = [];

        if (!empty($_POST['custom_fields'])) {
            $custom_fields = json_decode($_POST['custom_fields']);
            unset($_POST['custom_fields']);
        }

        if (!empty($_POST['remove_custom_fields'])) {
            $remove_custom_fields = json_decode($_POST['remove_custom_fields']);
            unset($_POST['remove_custom_fields']);
        }

        if (empty($_POST['id'])) {
            $id = $this->jobs_model->insert($_POST);
        } else {
            $id = $_POST['id'];
            $this->jobs_model->update($id, $_POST);
        }

        // Deal with custom fields
        $custom_fields_ids = [];

        if (!empty($custom_fields)) {
            $custom_fields_ids = $this->handle_custom_fields($custom_fields);
        }

        if (!empty($remove_custom_fields)) {
            $this->handle_remove_custom_fields($remove_custom_fields);
        }

        $updated_at = $this->jobs_model->get_admin($id)['updated_at'];

        echo json_encode(['id' => $id, 'updated_at' => $updated_at, 'custom_fields_ids' => $custom_fields_ids]);
    }

    public function jobs_upload()
    {
        if (count($_FILES) != 0 && count($_FILES['files']) != 0) {

            $data = [];

            $image_mime_types = [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp',
            ];


            for ($i = 0; $i < count($_FILES['files']['tmp_name']); $i++) {

                $mime_type = mime_content_type($_FILES['files']['tmp_name'][$i]);

                if (in_array($mime_type, $image_mime_types)) {

                    $ext = strtolower(pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION));

                    $tmp_name = $_FILES['files']['tmp_name'][$i];
                    $name = uniqid() . '.' . $ext;

                    move_uploaded_file($tmp_name, './uploads/top_picture/' . $name);

                    $data[] = $name;
                }
            }

            echo json_encode(['top_pictures' => $data]);
        }
    }
    public function jobs_copy_multiple()
    {
        if (isset($_POST['job_ids'])) {
            $job_ids = $_POST['job_ids'];

            $jobs = $this->jobs_model->get_multiple($job_ids);

            foreach ($jobs as $job) {

                unset($job['id']);  
                unset($job['created_at']);
                unset($job['updated_at']);

                $this->jobs_model->insert($job);
            }

        }
    }

    public function jobs_delete($id)
    {
        if (!empty($id)) {
            $this->jobs_model->delete($id);
        }

        redirect('/admin/jobs');
    }

    public function jobs_delete_multiple()
    {
        if (isset($_POST['job_ids'])) {
            $job_ids = $_POST['job_ids'];

            $this->jobs_model->delete_multiple($job_ids);
        }
    }

    public function delete_photo()
    {
        if (isset($_POST['photo'])) {
            unlink('.' . $_POST['photo']);
        }
    }

    private function handle_custom_fields($custom_fields)
    {

        $custom_fields_ids = [];

        foreach ($custom_fields as $custom_field) {
            switch ($custom_field->action) {
                case 'new':

                    $data = [
                        'job_id' => $custom_field->job_id,
                        'title' => $custom_field->title,
                        'detail' => $custom_field->detail,
                    ];

                    $custom_fields_ids[] = $this->custom_fields_model->insert($data);
                    break;
                default:
                    $id = $custom_field->id;
                    $data = ['title' => $custom_field->title, 'detail' => $custom_field->detail];
                    $this->custom_fields_model->update($id, $data);
            }
        }

        return $custom_fields_ids;
    }

    private function handle_remove_custom_fields($custom_fields)
    {
        foreach ($custom_fields as $custom_field) {
            $id = $custom_field->id;
            $this->custom_fields_model->delete($id);
        }
    }

    public function news()
    {
        $data['news'] = $this->news_model->get_all_admin();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/news');
        $this->load->view('admin/footer');

    }

    public function news_new()
    {
        $this->load->view('admin/header');
        $this->load->view('admin/news-single');
        $this->load->view('admin/footer');
    }

    public function news_get($id)
    {

        $data = $this->news_model->get_admin($id);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/news-single');
        $this->load->view('admin/footer');
    }

    public function news_update()
    {

        if (empty($_POST['id'])) {
            $id = $this->news_model->insert($_POST);
        } else {
            $id = $_POST['id'];
            $this->news_model->update($id, $_POST);
        }

        $updated_at = $this->news_model->get_admin($id)['updated_at'];

        echo json_encode(['id' => $id, 'updated_at' => $updated_at]);
    }

    public function news_delete($id)
    {

        $this->news_model->delete($id);

        redirect('/admin/news');
    }

    public function jobs_single_col_update()
    {
        if (isset($_POST['job_id']) && isset($_POST['column']) && isset($_POST['contents'])) {
            $job_id = $_POST['job_id'];
            $column = $_POST['column'];
            $contents = $_POST['contents'];

            $data = [$column => $contents];

            $this->jobs_model->update($job_id, $data);
        }
    }

    public function jobs_single_col_multiple_update()
    {
        if (isset($_POST['job_ids']) && isset($_POST['column']) && isset($_POST['contents'])) {
            $job_ids = $_POST['job_ids'];
            $column = $_POST['column'];
            $contents = $_POST['contents'];

            $data = [$column => $contents];

            $this->jobs_model->update_multiple($job_ids, $data);
        }
    }
}
