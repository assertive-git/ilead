<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->router->fetch_method() != 'job_list_get') {
			if (isset($_SESSION['search_sess'])) {
				unset($_SESSION['search_sess']);
			}
		}
	}

	public function index($page = 'home')
	{
		$data = [];

		if (strpos($page, '.php') !== FALSE || !file_exists(APPPATH . 'views/' . $page . '.php')) {
			show_404();
		}

		if ($page == 'home') {
			$data['total_jobs'] = $this->jobs_model->get_all_cnt();
			$data['new_jobs'] = $this->jobs_model->get_new_jobs();
			$data['direct'] = $this->jobs_model->get_direct();
			$data['deployment'] = $this->jobs_model->get_deployment();
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
		$areas = isset($_POST['areas']) ? $_POST['areas'] : [];
		$stations = isset($_POST['stations']) ? $_POST['stations'] : [];
		$employment_types = isset($_POST['employment_types']) ? $_POST['employment_types'] : [];
		$salary = isset($_POST['salary']) ? $_POST['salary'] : [];
		$job_types = isset($_POST['job_types']) ? $_POST['job_types'] : [];
		$categories = isset($_POST['categories']) ? implode('|', $_POST['categories']) : [];
		$traits = isset($_POST['traits']) ? implode('|', $_POST['traits']) : [];
		$freeword = isset($_POST['freeword']) ? $_POST['freeword'] : '';

		$data['jobs'] = $this->jobs_model->get_all($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

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

		$_SESSION['search_sess']['areas'] = $areas;
		$_SESSION['search_sess']['stations'] = $stations;
		$_SESSION['search_sess']['employment_types'] = $employment_types;
		$_SESSION['search_sess']['salary'] = $salary;
		$_SESSION['search_sess']['job_types'] = $job_types;
		$_SESSION['search_sess']['categories'] = $categories;
		$_SESSION['search_sess']['traits'] = $traits;


		$limit = 10;
		$offset = (1 * $limit) - $limit;
		$data['jobs'] = $this->jobs_model->get_all($offset, $limit, $areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$data['current_index_start'] = 1;
		$data['current_index_end'] = $limit;

		$data['total_jobs'] = $this->jobs_model->get_all_cnt($areas, $stations, $employment_types, $salary, $job_types, $categories, $traits, $freeword);

		$this->init_pagination($data['total_jobs'], 'job_list', $limit);

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
		if (isset($_SESSION['complete'])) {
			unset($_SESSION['complete']);
		} else {
			redirect('/jobs/' . $id . '/entry');
		}
	}

	public function favorites()
	{
		$data['jobs'] = [];

		if (!empty($_SESSION['favorites'])) {
			$ids = $_SESSION['favorites'];
			$data['jobs'] = $this->jobs_model->get_by_ids($ids);
		}

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
