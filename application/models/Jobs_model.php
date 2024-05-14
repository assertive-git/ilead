<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'jobs';
    }

    public function get_all_admin()
    {
        $data = $this->db->order_by('id', 'DESC');


        if (!empty($_POST['status'])) {
            $status = $_POST['status'];

            $data->where('status', $status);
        }

        if (!empty($_POST['keyword'])) {
            $keyword = $_POST['keyword'];

            $data->where('
            (id LIKE "%' . $keyword . '%" 
                OR title LIKE "%' . $keyword . '%"
                OR job_type LIKE "%' . $keyword . '%"
                OR city LIKE "%' . $keyword . '%"
                OR memo LIKE "%' . $keyword . '%"
            )'
            );
        }

        $limit = !empty($_POST['limit']) && is_numeric($_POST['limit']) ? $_POST['limit'] : 20;

        return $data->limit($limit)->get($this->table)->result_array();
    }

    public function get_all()
    {
        return $this->db->order_by('id', 'DESC')->where('status', '公開')->get($this->table)->result_array();
    }

    public function get_all_by_favorites($ids) {
        return $this->db->where_in('id', $ids)->order_by('id', 'DESC')->where('status', '公開')->get($this->table)->result_array();
    }

    private function get_count()
    {
        return count($this->db->get($this->table)->result_array());
    }

    public function get_admin($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->where('status', '公開')->get($this->table)->row_array();
    }

    public function get_keys()
    {
        return array_keys($this->db->get($this->table)->row_array());
    }

    public function get_multiple($ids)
    {
        return $this->db->where_in('id', $ids)->get($this->table)->result_array();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function delete_multiple($ids)
    {
        return $this->db->where_in('id', $ids)->delete($this->table);
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function update_multiple($ids, $data)
    {
        return $this->db->where_in('id', $ids)->update($this->table, $data);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function search()
    {
        return [];
    }

    public function get_by_area($areas)
    {
        return $this->db->where('status', '公開')->where_in('CONCAT(a_pref, city)', $areas)->get($this->table)->result_array();
    }

    public function get_by_line_and_stations($line, $stations)
    {
        $data = $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id')
            ->where('line', $line)->where_in('station', $stations)->where('status', '公開')
            ->select('jobs.id as id, lat, lng, title, category, min_salary, max_salary, top_picture, employment_type, pref, city, map_address')->get($this->table)->result_array();

        return !empty($data) ? $data : [];
    }


    public function get_by_job_type($job_type)
    {
        return $this->db->where('status', '公開')->where_in('job_type', $job_type)->get($this->table)->result_array();
    }

    public function get_by_employment_type($employment_type)
    {
        return $this->db->where('status', '公開')->where_in('employment_type', $employment_type)->get($this->table)->result_array();
    }

    public function get_by_category($category)
    {
        return $this->db->where('status', '公開')->where_in('category', $category)->get($this->table)->result_array();
    }

    public function get_by_traits($traits)
    {

        foreach ($traits as $trait) {
            $this->db->or_like('traits', $trait);
        }

        return $this->db->where('status', '公開')->get($this->table)->result_array();
    }

    public function get_by_freeword($fw)
    {
        return $this->db->where("
        (business_content LIKE '%$fw%' OR
        title LIKE '%$fw%' OR
        body LIKE '%$fw%' OR
        employment_type LIKE '%$fw%' OR
        salary_type LIKE '%$fw%' OR
        min_salary LIKE '%$fw%' OR
        max_salary LIKE '%$fw%' OR
        job_type LIKE '%$fw%' OR
        category LIKE '%$fw%' OR
        a_region LIKE '%$fw%' OR
        a_pref LIKE '%$fw%' OR
        city LIKE '%$fw%' OR
        address LIKE '%$fw%' OR
        traits LIKE '%$fw%')
        ")->where('status', '公開')->get($this->table)->result_array();
    }

    public function get_new_jobs()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit(10)->get($this->table)->result_array();
    }

    public function get_csv_export()
    {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_by_ids($ids) {
        return $this->db->where_in('id', $ids)->get($this->table)->result_array();
    }
}