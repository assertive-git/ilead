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
        redirect('/admin/jobs');
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

        if (
            !empty($_POST['job_id']) &&
            !empty($_POST['region']) &&
            !empty($_POST['pref']) &&
            !empty($_POST['line']) &&
            !empty($_POST['station']) &&
            !empty($_POST['walking_distance']) &&
            count($this->jobs_stations_model->get_all($_POST['job_id'])) < 3
        ) {
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

    public function jobs_csv_export()
    {

        $titles = [
            '求人ID',
            '業務内容 ',
            '求人見出し',
            '求人内容',
            '追加メールアドレス',
            '会社または店舗名',
            '雇用形態',
            '給与形態',
            '最低給与',
            '最高給与',
            '職種',
            '施設・種別',
            '住所（地域）',
            '住所（都道府県）',
            '住所（市区町村）',
            '番地・ビル名',

            '最寄り駅 (地方) 1',
            '最寄り駅 (都道府県) 1',
            '最寄り駅 (路線) 1',
            '最寄り駅 (駅) 1',
            '最寄り駅 (徒歩) 1',

            '最寄り駅 (地方) 2',
            '最寄り駅 (都道府県) 2',
            '最寄り駅 (路線) 2',
            '最寄り駅 (駅) 2',
            '最寄り駅 (徒歩) 2',

            '最寄り駅 (地方) 3',
            '最寄り駅 (都道府県) 3',
            '最寄り駅 (路線) 3',
            '最寄り駅 (駅) 3',
            '最寄り駅 (徒歩) 3',

            '必要資格',

            '募集要項 (項目) 1',
            '募集要項 (内容) 1',

            '募集要項 (項目) 2',
            '募集要項 (内容) 2',

            '募集要項 (項目) 3',
            '募集要項 (内容) 3',

            '募集要項 (項目) 4',
            '募集要項 (内容) 4',

            '募集要項 (項目) 5',
            '募集要項 (内容) 5',

            '募集要項 (項目) 6',
            '募集要項 (内容) 6',

            '募集要項 (項目) 7',
            '募集要項 (内容) 7',

            '募集要項 (項目) 8',
            '募集要項 (内容) 8',

            'GoogleマップURL',
            '住所、駅名、施設名、ランドマーク',
            '緯度',
            '経度',
            '「Googleしごと検索」を使用',
            '雇用形態 (Google)',
            '労働時間',
            '掲載日',
            '掲載期限',
            'ステータス',
            'トップ画像',
            'こだわり',
            'メモ',
            '作成日時',
            '更新日時'
        ];

        $data = $this->jobs_model->get_csv_export();

        for ($i = 0; $i < count($titles); $i++) {
            $titles[$i] = mb_convert_encoding($titles[$i], 'SJIS-win', 'UTF-8');
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=jobs.csv');
        if (ob_get_length() > 0) {
            ob_clean();
        }

        $output = fopen('php://output', 'w');

        fputcsv($output, $titles, ',', '"', '"');

        foreach ($data as $row) {


            // station splice begins @ index 16
            $values = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
            $values_index = 0;
            $limit_index = 0;

            $closest_stations = $this->jobs_stations_model->get_all($row['id']);

            foreach ($closest_stations as $closest_station) {

                unset($closest_station['id']);
                unset($closest_station['created_at']);

                foreach ($closest_station as $key => $value) {

                    $values[$values_index] = $key == 'walking_distance' ? $value . '分' : $value;
                    $values_index++;
                }

                $limit_index++;

                if ($limit_index == 3)
                    break;
            }



            array_splice($row, 16, 0, $values);

            // custom fields splice begins @ index 32
            $values = ['', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''];
            $values_index = 0;
            $limit_index = 0;

            $custom_fields = $this->custom_fields_model->get_all($row['id']);

            foreach ($custom_fields as $custom_field) {

                unset($custom_field['id']);
                unset($custom_field['created_at']);

                foreach ($custom_field as $key => $value) {
                    $values[$values_index] = $value;
                    $values_index++;
                }

                $limit_index++;

                if ($limit_index == 8)
                    break;
            }

            array_splice($row, 32, 0, $values);


            fputcsv($output, mb_convert_encoding($row, 'SJIS-win', 'UTF-8'));
        }

        fclose($output);
    }

    public function jobs_csv_import()
    {
        // $this->db->trans_start();

        $file = fopen($_FILES['csv']['tmp_name'], "r");

        $i = 0;

        while (($column = fgetcsv($file, 10000, ',', '"', '"')) != false) {

            mb_convert_variables('UTF-8', 'sjis-win', $column);

            if ($i == 0) {
                $i++;
                continue;
            }

            $job_id = $column[0];

            $job_keys = $this->jobs_model->get_keys();
            unset($job_keys[0]);
            $job_keys = array_values($job_keys);

            $job_data = [];
            $offsets = [1, 31, 48];
            $lengths = [15, 1, null];

            for ($i = 0; $i < 3; $i++) {
                $column_copy = $column;
                $job_data = array_merge($job_data, array_splice($column_copy, $offsets[$i], $lengths[$i]));
            }

            $job_data = array_combine($job_keys, array_values($job_data));

            if (empty($job_id)) {
                $job_id = $this->jobs_model->insert($job_data);
            } else {
                $this->jobs_model->update($job_id, $job_data);
            }

            $station_data = ['job_id' => $job_id, 'data' => []];
            $offsets = [16, 21, 26];

            for ($i = 0; $i < 3; $i++) {
                $column_copy = $column;
                $station_data['data'][] = array_combine(['region', 'pref', 'line', 'station', 'walking_distance'], array_values(array_splice($column_copy, $offsets[$i], 5)));
            }

            $stations = $this->jobs_stations_model->get_all($job_id);

            for ($i = 0; $i < count($station_data['data']); $i++) {

                $data = $station_data['data'][$i];

                if (
                    !empty($stations[$i]) &&
                    !empty($data['region']) &&
                    !empty($data['pref']) &&
                    !empty($data['line']) &&
                    !empty($data['station']) &&
                    !empty($data['walking_distance'])
                ) {
                    $station_date = $stations[$i]['created_at'];
                    $this->jobs_stations_model->update_by_date($station_date, $job_id, $data);
                } else if (
                    !empty($data['region']) &&
                    !empty($data['pref']) &&
                    !empty($data['line']) &&
                    !empty($data['station']) &&
                    !empty($data['walking_distance'])
                ) {
                    $data['job_id'] = $job_id;
                    $this->jobs_stations_model->insert($data);
                }
            }

            $custom_fields_data = ['job_id' => $job_id, 'data' => []];
            $offsets = [32, 34, 36, 38, 40, 42, 44, 46];

            for ($i = 0; $i < 8; $i++) {
                $column_copy = $column;
                $custom_fields_data['data'][] = array_combine(['title', 'detail'], array_values(array_splice($column_copy, $offsets[$i], 2)));
            }

            $custom_fields = $this->custom_fields_model->get_all($job_id);

            for ($i = 0; $i < count($custom_fields_data['data']); $i++) {

                $data = $custom_fields_data['data'][$i];

                if (
                    !empty($custom_fields[$i]) &&
                    !empty($data['title']) &&
                    !empty($data['detail'])
                ) {
                    $custom_fields_date = $stations[$i]['created_at'];
                    $this->custom_fields_model->update_by_date($custom_fields_date, $job_id, $data);
                } else if (
                    !empty($data['title']) &&
                    !empty($data['detail'])
                ) {
                    $data['job_id'] = $job_id;
                    $this->custom_fields_model->insert($data);
                }
            }
        }

        // $this->db->trans_complete();
    }

    public function base64_to_png()
    {
        $body = $_POST['body'];

        $doc = new DOMDocument;
        $doc->loadHTML($body);

        $path = './uploads/' . date('Y') . '/' . date('m');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $imgs = [];
        $pattern = '#^data:image/\w+;base64,#i';

        foreach ($doc->getElementsByTagName('img') as $img) {

            $src = $img->getAttribute('src');

            if (preg_match($pattern, $src)) {
                $data = base64_decode(preg_replace($pattern, '', $src));

                $file = $path . '/' . uniqid() . '.png';
                file_put_contents($file, $data);
                $imgs[] = str_replace('./', '/', $file);
            }
        }

        echo json_encode($imgs);
    }
}
