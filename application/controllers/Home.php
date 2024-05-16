<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index($page = 'home')
	{

		$data = [];

		if (strpos($page, '.php') !== FALSE || !file_exists(APPPATH . 'views/' . $page . '.php')) {
			show_404();
		}

		if ($page == 'home') {
			$data['new_jobs'] = $this->jobs_model->get_new_jobs();
			$data['news'] = $this->news_model->get_new_news();
		}

		$this->load->view($page, $data);
	}

	public function get_lines_and_stations()
	{
		$lines = $this->lines_model->get_all();
		$stations = $this->stations_model->get_all();

		echo json_encode(['lines' => $lines, 'stations' => $stations]);
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
		$data['jobs'] = $this->jobs_model->get_all();
		$this->load->view('map', $data);
	}

	public function map_post()
	{
		$pref = isset($_POST['pref']) ? $_POST['pref'] : [];
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$line = isset($_POST['line']) ? $_POST['line'] : '';
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_type = isset($_POST['employment_type']) ? $_POST['$employment_type'] : [];
		$job_type = isset($_POST['job_type']) ? $_POST['job_type'] : [];
		$category = isset($_POST['category']) ? $_POST['category'] : [];
		$traits = isset($_POST['traits']) ? implode('|', $_POST['traits']) : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$data['jobs'] = $this->jobs_model->get_by($pref, $areas, $line, $stations, $employment_type, $job_type, $category, $traits, $freeword);

		$this->load->view('map', $data);

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

	public function job_list_get()
	{
		$data['jobs'] = $this->jobs_model->get_all();

		foreach ($data['jobs'] as $key => $job) {
			$data['jobs'][$key]['jobs_stations'] = $this->jobs_stations_model->get_all($job['id']);
		}

		$this->load->view('job_list', $data);

	}

	public function job_list_post()
	{

		$pref = isset($_POST['pref']) ? $_POST['pref'] : [];
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$line = isset($_POST['line']) ? $_POST['line'] : '';
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_type = isset($_POST['employment_type']) ? $_POST['$employment_type'] : [];
		$job_type = isset($_POST['job_type']) ? $_POST['job_type'] : [];
		$category = isset($_POST['category']) ? $_POST['category'] : [];
		$traits = isset($_POST['traits']) ? $_POST['traits'] : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$data['jobs'] = $this->jobs_model->get_by($pref, $areas, $line, $stations, $employment_type, $job_type, $category, $traits, $freeword);

		foreach ($data['jobs'] as $key => $job) {
			$data['jobs'][$key]['jobs_stations'] = $this->jobs_stations_model->get_all($job['id']);
		}

		$this->load->view('job_list', $data);
	}

	public function mypage()
	{
		$data['jobs'] = [];

		if (!empty($_COOKIE['ilead_favorites'])) {
			$ids = explode(',', $_COOKIE['ilead_favorites']);


			if (!empty($ids)) {
				$ids = $_COOKIE['ilead_favorites'];
				$data['jobs'] = $this->jobs_model->get_all_by_favorites($ids);
			}
		}

		$this->load->view('mypage', $data);
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
}
