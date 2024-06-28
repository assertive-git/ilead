<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if(isset($_SESSION['search_sess'])) {
			unset($_SESSION['search_sess']);
		}
	}

	public function index()
	{
		$data = [];

		$data['total_jobs'] = $this->jobs_model->get_all_cnt();
		$data['new_jobs'] = $this->jobs_model->get_new_jobs();
		$data['direct'] = $this->jobs_model->get_direct();
		$data['deployment'] = $this->jobs_model->get_deployment();
		$data['news'] = $this->news_model->get_new_news();

		// $pls_data = [];

		// $japan_lines_stations = $this->stations_model->get_all_prefs_lines_stations();


		// foreach ($japan_lines_stations as $pref_line_station) {
		// 	$pls_data[$pref_line_station['prefecture']][$pref_line_station['line_name']][] = $pref_line_station['station_name'];
		// }

		// $data['japan_lines_stations'] = $pls_data;

		$data['region_area'] = '';
		$data['prefectures_area'] = '';
		$data['areas'] = [];
		$data['stations'] = [];

		$data['region_lines_stations'] = '';
		$data['prefectures_lines_stations'] = '';
		$data['ln'] = '';
		$data['stations_all'] = [];



		$this->load->view('home', $data);
	}

	public function news()
	{

		$data['news'] = $this->news_model->get_all();

		$this->load->view('news_list', $data);
	}

	public function news_single($id)
	{
		$data['news'] = $this->news_model->get($id);


		if (empty($data['news'])) {
			redirect('/news');
		}

		$this->load->view('news_single', $data);
	}

	public function map_get()
	{
		$areas = [];
		$stations = [];
		$employment_types = [];
		$salary = [];
		$job_types = [];
		$categories = [];
		$traits = [];
		$freeword = '';

		$offset = 0;
		$limit = 20;

		$data['jobs'] = $this->jobs_model->get_all($offset, $limit, $areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);
		$data['total_jobs'] = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['region_area'] = '';
		$data['prefectures_area'] = '';
		$data['areas'] = [];

		$data['region_lines_stations'] = '';
		$data['prefectures_lines_stations'] = '';
		$data['ln'] = '';
		$data['stations_all'] = [];

		// $japan_lines_stations = $this->stations_model->get_all_prefs_lines_stations();

		// foreach ($japan_lines_stations as $pref_line_station) {
		// 	$pls_data[$pref_line_station['prefecture']][$pref_line_station['line_name']][] = $pref_line_station['station_name'];
		// }

		// $data['japan_lines_stations'] = $pls_data;

		$this->load->view('map', $data);
	}

	public function map_post()
	{
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_types = isset($_POST['employment_types']) ? $_POST['employment_types'] : [];
		$salary = isset($_POST['salary']) ? $_POST['salary'] : [];
		$job_types = isset($_POST['job_types']) ? $_POST['job_types'] : [];
		$categories = isset($_POST['categories']) ? implode('|', $_POST['categories']) : [];
		$traits = isset($_POST['traits']) ? implode('|', $_POST['traits']) : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$offset = 0;
		$limit = 99999;

		$data['jobs'] = $this->jobs_model->get_all($offset, $limit, $areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['total_jobs'] = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['region_area'] = isset($_POST['region_area']) ? $_POST['region_area'] : '';
		$data['prefectures_area'] = isset($_POST['prefectures_area']) ? $_POST['prefectures_area'] : '';
		$data['areas'] = isset($_POST['areas']) ? $_POST['areas'] : [];

		$data['region_lines_stations'] = isset($_POST['region_lines_stations']) ? $_POST['region_lines_stations'] : '';
		$data['prefectures_lines_stations'] = isset($_POST['prefectures_lines_stations']) ? $_POST['prefectures_lines_stations'] : '';
		$data['stations'] = $stations;
		$data['ln'] = isset($_POST['ln']) ? $_POST['ln'] : '';
		$data['stations_all'] = isset($_POST['stations_all']) ? $_POST['stations_all'] : [];

		// $japan_lines_stations = $this->stations_model->get_all_prefs_lines_stations();

		// foreach ($japan_lines_stations as $pref_line_station) {
		// 	$pls_data[$pref_line_station['prefecture']][$pref_line_station['line_name']][] = $pref_line_station['station_name'];
		// }

		// $data['japan_lines_stations'] = $pls_data;

		$this->load->view('map', $data);
	}

	public function total_jobs()
	{
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_types = isset($_POST['employment_types']) ? $_POST['employment_types'] : [];
		$salary = isset($_POST['salary']) ? $_POST['salary'] : [];
		$job_types = isset($_POST['job_types']) ? $_POST['job_types'] : [];
		$categories = isset($_POST['categories']) ? implode('|', $_POST['categories']) : [];
		$traits = isset($_POST['traits']) ? implode('|', $_POST['traits']) : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$cnt = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		echo json_encode(['total_jobs' => $cnt]);

	}

	public function jobs($id)
	{
		$data['job'] = $this->jobs_model->get($id);
		$data['job']['jobs_stations'] = $this->jobs_stations_model->get_all($id);
		$data['job']['custom_fields'] = $this->custom_fields_model->get_all($id);


		if (empty($data['job'])) {
			redirect('/job_list');
		}

		$this->load->view('job_single', $data);
	}

	public function job_list_get($page = 1)
	{
		$areas = isset($_SESSION['search_sess']['areas']) ? $_SESSION['search_sess']['areas'] : [];
		$stations = isset($_SESSION['search_sess']['stations']) ? $_SESSION['search_sess']['stations'] : [];
		$employment_types = isset($_SESSION['search_sess']['employment_types']) ? $_SESSION['search_sess']['employment_types'] : [];
		$salary = isset($_SESSION['search_sess']['salary']) ? $_SESSION['search_sess']['salary'] : [];
		$job_types = isset($_SESSION['search_sess']['job_types']) ? $_SESSION['search_sess']['job_types'] : [];
		$categories = isset($_SESSION['search_sess']['categories']) ? implode('|', $_SESSION['search_sess']['categories']) : [];
		$traits = isset($_SESSION['search_sess']['traits']) ? implode('|', $_SESSION['search_sess']['traits']) : [];
		$freeword = isset($_SESSION['search_sess']['freeword']) ? $_SESSION['search_sess']['freeword'] : '';

		$region_area = isset($_SESSION['search_sess']['region_area']) ? $_SESSION['search_sess']['region_area'] : '';
		$prefectures_area = isset($_SESSION['search_sess']['prefecturs_area']) ? $_SESSION['search_sess']['prefectures_area'] : '';

		$region_lines_stations = isset($_SESSION['search_sess']['region_lines_stations']) ? $_SESSION['search_sess']['region_lines_stations'] : '';
		$prefectures_lines_stations = isset($_SESSION['search_sess']['prefectures_lines_stations']) ? $_SESSION['search_sess']['prefectures_lines_stations'] : '';
		$ln = isset($_SESSION['search_sess']['ln']) ? $_SESSION['search_sess']['ln'] : '';
		$stations_all = isset($_SESSION['search_sess']['stations_all']) ? $_SESSION['search_sess']['stations_all'] : [];

		$limit = 10;
		$offset = ($page * $limit) - $limit;
		$data['jobs'] = $this->jobs_model->get_all($offset, $limit, $areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		if (count($data['jobs']) == 0) {
			redirect('/job_list');
		}

		$data['total_jobs'] = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['current_index_start'] = ($limit * ($page - 1)) + 1;
		$data['current_index_end'] = ($limit * ($page - 1)) + $limit;

		if ($data['current_index_end'] > $data['total_jobs']) {
			$data['current_index_end'] = $data['total_jobs'];
		}

		$this->init_pagination($data['total_jobs'], 'job_list', $limit);

		$data['areas'] = $areas;
		$data['stations'] = $stations;
		$data['salary'] = $salary;
		$data['employment_types'] = $employment_types;
		$data['job_types'] = $job_types;
		$data['categories'] = $categories;
		$data['traits'] = $traits;
		$data['freeword'] = $freeword;

		$data['region_area'] = $region_area;
		$data['prefectures_area'] = $prefectures_area;
		$data['region_lines_stations'] = $region_lines_stations;
		$data['prefectures_lines_stations'] = $prefectures_lines_stations;
		$data['ln'] = $ln;
		$data['stations_all'] = $stations_all;

		// $japan_lines_stations = $this->stations_model->get_all_prefs_lines_stations();

		// foreach ($japan_lines_stations as $pref_line_station) {
		// 	$pls_data[$pref_line_station['prefecture']][$pref_line_station['line_name']][] = $pref_line_station['station_name'];
		// }

		// $data['japan_lines_stations'] = $pls_data;

		$this->load->view('job_list', $data);

	}

	public function job_list_post()
	{
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_types = isset($_POST['employment_types']) ? $_POST['employment_types'] : [];
		$salary = isset($_POST['salary']) ? $_POST['salary'] : [];
		$job_types = isset($_POST['job_types']) ? $_POST['job_types'] : [];
		$categories = isset($_POST['categories']) ? implode('|', $_POST['categories']) : [];
		$traits = isset($_POST['traits']) ? implode('|', $_POST['traits']) : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$region_area = isset($_POST['region_area']) ? $_POST['region_area'] : '';
		$prefectures_area = isset($_POST['prefectures_area']) ? $_POST['prefectures_area'] : '';
		$region_lines_stations = isset($_POST['region_lines_stations']) ? $_POST['region_lines_stations'] : '';
		$prefectures_lines_stations = isset($_POST['prefectures_lines_stations']) ? $_POST['prefectures_lines_stations'] : '';
		$ln = isset($_POST['ln']) ? $_POST['ln'] : '';
		$stations_all = isset($_POST['stations_all']) ? $_POST['stations_all'] : [];

		$_SESSION['search_sess']['areas'] = $areas;
		$_SESSION['search_sess']['stations'] = $stations;
		$_SESSION['search_sess']['employment_types'] = $employment_types;
		$_SESSION['search_sess']['salary'] = $salary;
		$_SESSION['search_sess']['job_types'] = $job_types;
		$_SESSION['search_sess']['categories'] = $categories;
		$_SESSION['search_sess']['traits'] = $traits;
		$_SESSION['search_sess']['freeword'] = $freeword;

		$_SESSION['search_sess']['region_area'] = $region_area;
		$_SESSION['search_sess']['prefectures_area'] = $prefectures_area;

		$_SESSION['search_sess']['region_lines_stations'] = $region_lines_stations;
		$_SESSION['search_sess']['prefectures_lines_stations'] = $prefectures_lines_stations;
		$_SESSION['search_sess']['ln'] = $ln;
		$_SESSION['search_sess']['stations_all'] = $stations_all;

		$limit = 10;
		$offset = (1 * $limit) - $limit;
		$data['jobs'] = $this->jobs_model->get_all($offset, $limit, $areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['current_index_start'] = 1;
		$data['current_index_end'] = $limit;

		$data['total_jobs'] = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$this->init_pagination($data['total_jobs'], 'job_list', $limit);

		$data['areas'] = $areas;
		$data['stations'] = $stations;
		$data['salary'] = $salary;
		$data['employment_types'] = $employment_types;
		$data['job_types'] = $job_types;
		$data['categories'] = $categories;
		$data['traits'] = $traits;
		$data['freeword'] = $freeword;

		$data['region_area'] = $region_area;
		$data['prefectures_area'] = $prefectures_area;

		$data['region_lines_stations'] = $region_lines_stations;
		$data['prefectures_lines_stations'] = $prefectures_lines_stations;
		$data['ln'] = $ln;
		$data['stations_all'] = $stations_all;

		// $japan_lines_stations = $this->stations_model->get_all_prefs_lines_stations();

		// foreach ($japan_lines_stations as $pref_line_station) {
		// 	$pls_data[$pref_line_station['prefecture']][$pref_line_station['line_name']][] = $pref_line_station['station_name'];
		// }

		// $data['japan_lines_stations'] = $pls_data;

		$this->load->view('job_list', $data);
	}

	public function jobs_entry($id)
	{
		$data['id'] = $id;

		$this->load->view('entry', $data);
	}

	public function jobs_confirm($id)
	{
		if (isset($_POST['action']) && $_POST['action'] == 1) {
			$this->sendmail($id);
		} else {
			$data['id'] = $id;
			$this->load->view('confirm', $data);
		}


	}

	public function jobs_complete($id)
	{
		if (isset($_SESSION['confirm'])) {
			unset($_SESSION['confirm']);
			// mail logic here.
			// var_dump($_POST);

			$this->load->view('complete');
		} else {
			redirect('/jobs/' . $id . '/entry');
		}
	}

	public function favorites($page = 1)
	{
		$data['jobs'] = [];

		if (!empty($_SESSION['favorites'])) {
			$ids = $_SESSION['favorites'];
			$data['jobs'] = $this->jobs_model->get_by_ids($ids);
		}

		$limit = 10;

		$data['current_index_start'] = ($limit * ($page - 1)) + 1;
		$data['current_index_end'] = ($limit * ($page - 1)) + $limit;

		if ($data['current_index_end'] > count($data['jobs'])) {
			$data['current_index_end'] = count($data['jobs']);
		}

		$this->init_pagination(count($data['jobs']), 'favorites', $limit);

		$this->load->view('favorites', $data);
	}

	public function get_jobs_by_id()
	{
		if (!empty($_POST['job_ids'])) {
			$job_ids = $_POST['job_ids'];
			echo json_encode(['jobs' => $this->jobs_model->get_by_ids($job_ids)]);
		}
	}

	// public function get_top_picture($image)
	// {
	// 	$content = file_get_contents('../../production/public/top_picture/' . $image);

	// 	if (empty($content)) {
	// 		show_404();
	// 	}

	// 	header('Content-Type: image/png');
	// 	echo $content;
	// }

	// public function get_job_image()
	// {

	// }

	public function favorites_add()
	{
		$id = $_POST['id'];

		if (!in_array($id, $_SESSION['favorites'])) {
			$_SESSION['favorites'][] = $id;
		}
	}

	public function favorites_delete()
	{

		$id = $_POST['id'];

		foreach ($_SESSION['favorites'] as $key => $value) {
			if ($value == $id) {
				unset($_SESSION['favorites'][$key]);
				break;
			}
		}
	}

	public function favorites_clear()
	{
		$_SESSION['favorites'] = [];
	}

	public function get_lines()
	{
		$data = [];

		if (!empty($_POST['pref'])) {
			$pref = $_POST['pref'];
			$data = $this->lines_model->get_by_pref($pref);
		}

		echo json_encode($data);
	}

	public function get_stations()
	{
		$data = [];

		if (!empty($_POST['line_cd']) && !empty($_POST['pref'])) {

			$line_cd = $_POST['line_cd'];
			$pref = $_POST['pref'];

			$data = $this->stations_model->get_by_line_cd_pref($line_cd, $pref);
		}

		echo json_encode($data);
	}

	private function sendmail($id)
	{
		$_SESSION['complete'] = '';
		redirect('/jobs/' . $id . '/complete');
	}

	private function init_pagination($total_rows, $page, $limit)
	{
		$config['base_url'] = base_url() . $page;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $limit;
		$config['attributes'] = ['class' => 'pagination-item'];
		$config['prev_link'] = '<button class="arrow_before"></button>';
		$config['next_link'] = '<button class="arrow_next"></button>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
	}
}
