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

        if ($this->router->fetch_method() != 'jobs_admin_get' && $this->router->fetch_method() != 'jobs_admin_post') {
            if (isset($_SESSION['search_sess']['admin'])) {
                unset($_SESSION['search_sess']['admin']);
            }
        }

        if ($this->router->fetch_method() != 'news_admin_get' && $this->router->fetch_method() != 'news_admin_post') {
            if (isset($_SESSION['news_sess']['admin'])) {
                unset($_SESSION['news_sess']['admin']);
            }
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

    public function jobs_admin_get($page = 1)
    {
        $status = isset($_SESSION['search_sess']['admin']['status']) ? $_SESSION['search_sess']['admin']['status'] : '';
        $keyword = isset($_SESSION['search_sess']['admin']['keyword']) ? $_SESSION['search_sess']['admin']['keyword'] : '';
        $limit = isset($_SESSION['search_sess']['admin']['limit']) ? $_SESSION['search_sess']['admin']['limit'] : 25;

        $data['status'] = $status;
        $data['keyword'] = $keyword;
        $data['limit'] = $limit;

        $offset = ($page * $limit) - $limit;
        $data['jobs'] = $this->jobs_model->get_all_admin($offset, $limit);

        $data['total_jobs'] = $this->jobs_model->get_all_cnt_admin($status, $keyword);

        $data['current_index_start'] = ($limit * ($page - 1)) + 1;
        $data['current_index_end'] = ($limit * ($page - 1)) + $limit;

        if ($data['current_index_end'] > $data['total_jobs']) {
            $data['current_index_end'] = $data['total_jobs'];
        }

        $this->init_pagination($data['total_jobs'], 'admin/jobs/p', $limit);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/jobs');
        $this->load->view('admin/footer');
    }

    public function jobs_admin_post()
    {
        $status = '';

        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            $_SESSION['search_sess']['admin']['status'] = $status;
        } else if (!empty($_SESSION['search_sess']['admin']['status'])) {
            $status = $_SESSION['search_sess']['admin']['status'];
        }

        $keyword = '';

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $_SESSION['search_sess']['admin']['keyword'] = $keyword;
        } else if (!empty($_SESSION['search_sess']['admin']['keyword'])) {
            $keyword = $_SESSION['search_sess']['admin']['keyword'];
        }

        $limit = isset($_POST['limit']) ? $_POST['limit'] : 25;

        $data['status'] = $status;
        $data['keyword'] = $keyword;
        $data['limit'] = $limit;

        $offset = 0;
        $data['jobs'] = $this->jobs_model->get_all_admin($offset, $limit);

        $data['total_jobs'] = $this->jobs_model->get_all_cnt_admin($status, $keyword);

        $data['current_index_start'] = 1;
        $data['current_index_end'] = $limit;

        $this->init_pagination($data['total_jobs'], 'admin/jobs/p', $limit);

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

    public function jobs_preview($id)
    {
        $data['job'] = $this->jobs_model->get_admin($id);
        $data['job']['jobs_stations'] = $this->jobs_stations_model->get_all($id);
        $data['job']['custom_fields'] = $this->custom_fields_model->get_all($id);

        if (empty($data['job'])) {
            show_404();
        }

        $data['favorites'] = [];

        if (!empty($_SESSION['session_id'])) {
            $session_id = $_SESSION['session_id'];
            $data['favorites'] = $this->favorites_model->get_all_job_ids($session_id);
        }

        $this->load->view('job_single', $data);
    }

    private function jobs_stations($data)
    {
        $ids = [];

        foreach ($data as $row) {
            $ids[] = $this->jobs_stations_model->insert($row);
        }

        return $ids;
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

        // Check for any base64 images in the body to store on the server as PNG.
        $imgs = $this->base64_to_png();

        if (!empty($_POST['custom_fields'])) {
            $custom_fields = json_decode($_POST['custom_fields']);
            unset($_POST['custom_fields']);
        }

        if (!empty($_POST['remove_custom_fields'])) {
            $remove_custom_fields = json_decode($_POST['remove_custom_fields']);
            unset($_POST['remove_custom_fields']);
        }

        if (!empty($_POST['stations'])) {
            $stations = json_decode($_POST['stations']);
            unset($_POST['stations']);
        }

        if (!empty($_POST['remove_stations'])) {
            $remove_stations = json_decode($_POST['remove_stations']);
            unset($_POST['remove_stations']);
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
            $custom_fields_ids = $this->handle_custom_fields($custom_fields, $id);
        }

        if (!empty($remove_custom_fields)) {
            $this->handle_remove_custom_fields($remove_custom_fields);
        }

        // Deal with stations
        $station_ids = [];

        if (!empty($stations)) {
            $station_ids = $this->handle_stations($stations, $id);
        }

        if (!empty($remove_stations)) {
            $this->handle_remove_stations($remove_stations);
        }

        $updated_at = $this->jobs_model->get_admin($id)['updated_at'];

        echo json_encode(['id' => $id, 'updated_at' => $updated_at, 'custom_fields_ids' => $custom_fields_ids, 'station_ids' => $station_ids, 'imgs' => $imgs]);
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

                    move_uploaded_file($tmp_name, './public/uploads/top_picture/' . $name);

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
                $orig_job_id = $job['id'];
                unset($job['id']);
                unset($job['created_at']);
                unset($job['updated_at']);

                $this->jobs_model->insert($job);

                $job_id = $this->db->insert_id();

                $stations = $this->jobs_stations_model->get_all($orig_job_id);

                foreach ($stations as $station) {
                    unset($station['id']);
                    unset($station['created_at']);
                    $station['job_id'] = $job_id;
                    $this->jobs_stations_model->insert($station);
                }

                $cfs = $this->custom_fields_model->get_all($orig_job_id);

                foreach ($cfs as $cf) {
                    unset($cf['id']);
                    unset($cf['created_at']);
                    $cf['job_id'] = $job_id;
                    $this->custom_fields_model->insert($cf);
                }
            }

        }
    }

    public function jobs_copy($id)
    {
        if (!empty($id)) {

            $job_ids = [$id];

            $jobs = $this->jobs_model->get_multiple($job_ids);

            foreach ($jobs as $job) {
                $orig_job_id = $job['id'];
                unset($job['id']);
                unset($job['created_at']);
                unset($job['updated_at']);

                $this->jobs_model->insert($job);

                $job_id = $this->db->insert_id();

                $stations = $this->jobs_stations_model->get_all($orig_job_id);

                foreach ($stations as $station) {
                    unset($station['id']);
                    unset($station['created_at']);
                    $station['job_id'] = $job_id;
                    $this->jobs_stations_model->insert($station);
                }

                $cfs = $this->custom_fields_model->get_all($orig_job_id);

                foreach ($cfs as $cf) {
                    unset($cf['id']);
                    unset($cf['created_at']);
                    $cf['job_id'] = $job_id;
                    $this->custom_fields_model->insert($cf);
                }
            }
        }

        redirect('/admin/jobs');
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

    public function get_lines_stations()
    {
        $lines = $this->lines_model->get_all();
        $stations = $this->stations_model->get_all();

        echo json_encode(['lines' => $lines, 'stations' => $stations]);
    }

    private function handle_custom_fields($custom_fields, $job_id)
    {

        $custom_fields_ids = [];

        foreach ($custom_fields as $custom_field) {
            switch ($custom_field->action) {
                case 'new':
                    $data = [
                        'job_id' => $job_id,
                        'title' => $custom_field->title,
                        'detail' => $custom_field->detail,
                        'sort_order' => $custom_field->sort_order
                    ];

                    $custom_fields_ids[] = $this->custom_fields_model->insert($data);
                    break;
                default:
                    $id = $custom_field->id;
                    $data = ['title' => $custom_field->title, 'detail' => $custom_field->detail, 'sort_order' => $custom_field->sort_order];
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

    private function handle_stations($stations, $job_id)
    {

        $stations_ids = [];

        foreach ($stations as $station) {
            $station->job_id = $job_id;
            $stations_ids[] = $this->jobs_stations_model->insert($station);
        }

        return $stations_ids;
    }

    private function handle_remove_stations($station_ids)
    {
        foreach ($station_ids as $id) {
            $this->jobs_stations_model->delete($id);
        }
    }

    public function news_admin_get($page = 1)
    {

        $status = isset($_SESSION['news_sess']['admin']['status']) ? $_SESSION['news_sess']['admin']['status'] : '';
        $keyword = isset($_SESSION['news_sess']['admin']['keyword']) ? $_SESSION['news_sess']['admin']['keyword'] : '';
        $limit = isset($_SESSION['news_sess']['admin']['limit']) ? $_SESSION['news_sess']['admin']['limit'] : 25;

        $data['status'] = $status;
        $data['keyword'] = $keyword;
        $data['limit'] = $limit;

        $offset = ($page * $limit) - $limit;

        $data['news'] = $this->news_model->get_all_admin($offset, $limit);
        $data['total_news'] = $this->news_model->get_all_cnt_admin($status, $keyword);

        $data['current_index_start'] = ($limit * ($page - 1)) + 1;
        $data['current_index_end'] = ($limit * ($page - 1)) + $limit;

        if ($data['current_index_end'] > $data['total_news']) {
            $data['current_index_end'] = $data['total_news'];
        }

        $this->init_pagination($data['total_news'], 'admin/news/p', $limit);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/news');
        $this->load->view('admin/footer');

    }

    public function news_get($id)
    {
        $data = $this->news_model->get_admin($id);

        $this->load->view('admin/header', $data);
        $this->load->view('admin/news-single');
        $this->load->view('admin/footer');
    }

    public function news_admin_post()
    {
        $status = '';

        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            $_SESSION['news_sess']['admin']['status'] = $status;
        } else if (!empty($_SESSION['news_sess']['admin']['status'])) {
            $status = $_SESSION['news_sess']['admin']['status'];
        }

        $keyword = '';

        if (isset($_POST['keyword'])) {
            $keyword = $_POST['keyword'];
            $_SESSION['news_sess']['admin']['keyword'] = $keyword;
        } else if (!empty($_SESSION['news_sess']['admin']['keyword'])) {
            $keyword = $_SESSION['news_sess']['admin']['keyword'];
        }

        $limit = isset($_POST['limit']) ? $_POST['limit'] : 25;

        $data['status'] = $status;
        $data['keyword'] = $keyword;
        $data['limit'] = $limit;

        $offset = 0;
        $data['news'] = $this->news_model->get_all_admin($offset, $limit);

        $data['total_news'] = $this->news_model->get_all_cnt_admin($status, $keyword);

        $data['current_index_start'] = 1;
        $data['current_index_end'] = $limit;

        $this->init_pagination($data['total_news'], 'admin/news/p', $limit);

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

    public function news_update()
    {

        $imgs = $this->base64_to_png();

        if (empty($_POST['id'])) {
            $id = $this->news_model->insert($_POST);
        } else {
            $id = $_POST['id'];
            $this->news_model->update($id, $_POST);
        }

        $updated_at = $this->news_model->get_admin($id)['updated_at'];

        echo json_encode(['id' => $id, 'updated_at' => $updated_at, 'imgs' => $imgs]);
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

            'バス停',

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
                unset($custom_field['sort_order']);

                foreach ($custom_field as $key => $value) {
                    $values[$values_index] = $value;
                    $values_index++;
                }

                $limit_index++;

                if ($limit_index == 8)
                    break;
            }

            array_splice($row, 33, 0, $values);


            fputcsv($output, mb_convert_encoding($row, 'SJIS-win', 'UTF-8'));
        }

        fclose($output);
    }

    public function jobs_csv_import()
    {
        $this->db->trans_start();

        $file = fopen($_FILES['csv']['tmp_name'], "r");

        $i = 0;

        while (($column = fgetcsv($file, 10000, ',', '"', '"')) != false) {

            mb_convert_variables('UTF-8', 'sjis-win', $column);

            if ($i == 0) {
                $i++;
                continue;
            }


            $job_id = $column[0];

            $job_data = [
                'business_content' => $column[1],
                'title' => $column[2],
                'body' => $column[3],
                'tantosha' => $column[4],
                'company_or_store_name' => $column[5],
                'employment_type' => $column[6],
                'salary_type' => $column[7],
                'min_salary' => $column[8],
                'max_salary' => $column[9],
                'job_type' => $column[10],
                'category' => $column[11],
                'a_region' => $column[12],
                'a_pref' => $column[13],
                'city' => $column[14],
                'address' => $column[15],
                'closest_bus_stop' => $column[31],
                'has_requirement' => $column[32],
                'map_url' => $column[49],
                'map_address' => $column[50],
                'lat' => $column[51],
                'lng' => $column[52],
                'gfj' => $column[53],
                'gfj_employment_type' => $column[54],
                'gfj_working_hours' => $column[55],
                'gfj_listing_start_date' => DateTime::createFromFormat('Y/m/j', $column[56])->format('Y-m-d'),
                'gfj_listing_end_date' => DateTime::createFromFormat('Y/m/j', $column[57])->format('Y-m-d'),
                'status' => $column[58],
                'top_picture' => $column[59],
                'traits' => $column[60],
                'memo' => $column[61],
                'created_at' => empty(trim($column[62])) ? date('Y-m-d H:i:s') : $column[62],
                'updated_at' => empty(trim($column[63])) ? date('Y-m-d H:i:s') : $column[63],
            ];

            if (empty($job_id)) {
                $job_id = $this->jobs_model->insert($job_data);
            } else if ($this->jobs_model->exists($job_id)) {
                $this->jobs_model->update($job_id, $job_data);
            } else {
                continue;
            }

            $station_data = [
                'job_id' => $job_id,
                'data' => [
                    [
                        'region' => $column[16],
                        'pref' => $column[17],
                        'line' => $column[18],
                        'station' => $column[19],
                        'walking_distance' => $column[20],
                    ],
                    [
                        'region' => $column[21],
                        'pref' => $column[22],
                        'line' => $column[23],
                        'station' => $column[24],
                        'walking_distance' => $column[25],
                    ],
                    [
                        'region' => $column[26],
                        'pref' => $column[27],
                        'line' => $column[28],
                        'station' => $column[29],
                        'walking_distance' => $column[30],
                    ]
                ]
            ];

            $stations = $this->jobs_stations_model->get_all($job_id);

            $station_data_count = count($station_data['data']);

            for ($i = 0; $i < $station_data_count; $i++) {

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
                    $station_id = $stations[$i]['id'];
                    $this->jobs_stations_model->update_by_date($station_date, $job_id, $data, $station_id);
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

            $custom_fields_data = [
                'job_id' => $job_id,
                'data' => [
                    [
                        'title' => $column[33],
                        'detail' => $column[34],
                    ],
                    [
                        'title' => $column[35],
                        'detail' => $column[36],
                    ],
                    [
                        'title' => $column[37],
                        'detail' => $column[38],
                    ],
                    [
                        'title' => $column[39],
                        'detail' => $column[40],
                    ],
                    [
                        'title' => $column[41],
                        'detail' => $column[42],
                    ],
                    [
                        'title' => $column[43],
                        'detail' => $column[44],
                    ],
                    [
                        'title' => $column[45],
                        'detail' => $column[46],
                    ],
                    [
                        'title' => $column[47],
                        'detail' => $column[48],
                    ]
                ]
            ];

            $custom_fields = $this->custom_fields_model->get_all($job_id);

            $custom_fields_data_count = count($custom_fields_data['data']);

            for ($i = 0; $i < $custom_fields_data_count; $i++) {

                $data = $custom_fields_data['data'][$i];

                if (
                    !empty($custom_fields[$i]) &&
                    !empty($data['title']) &&
                    !empty($data['detail'])
                ) {
                    $custom_fields_date = $custom_fields[$i]['created_at'];
                    $id = $custom_fields[$i]['id'];
                    $this->custom_fields_model->update_by_date($custom_fields_date, $job_id, $data, $id);
                } else if (
                    !empty($data['title']) &&
                    !empty($data['detail'])
                ) {
                    $data['job_id'] = $job_id;
                    $this->custom_fields_model->insert($data);
                }
            }
        }

        $this->db->trans_complete();
    }

    private function base64_to_png()
    {
        $body = $_POST['body'];

        $doc = new DOMDocument;
        $doc->loadHTML($body);

        $path = './public/uploads/' . date('Y') . '/' . date('m');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $pattern = '#^data:image/\w+;base64,#i';
        $imgs = [];

        foreach ($doc->getElementsByTagName('img') as $img) {

            $src = $img->getAttribute('src');

            if (preg_match($pattern, $src)) {
                $data = base64_decode(preg_replace($pattern, '', $src));

                $file = $path . '/' . uniqid() . '.png';
                file_put_contents($file, $data);

                $img = str_replace('./', '/', $file);

                $_POST['body'] = str_replace($src, $img, $_POST['body']);

                $imgs[] = $img;

            }
        }

        return $imgs;
    }

    private function init_pagination($total_rows, $page, $limit)
    {
        $config['base_url'] = base_url() . $page;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['attributes'] = ['class' => 'pagination-item'];
        $config['prev_link'] = '<button class="text-white"><i class="fa-solid fa-circle-chevron-left" style="font-size: 22px"></i></button>';
        $config['next_link'] = '<button class="text-white"><i class="fa-solid fa-circle-chevron-right" style="font-size: 22px"></i></button>';
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
    }
}
