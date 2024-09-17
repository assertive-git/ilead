<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Favorites_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'favorites';
    }

    public function delete($session_id, $id)
    {
        $this->db->where('job_id', $id)->where('session_id', $session_id)->delete($this->table);
    }

    public function clear($session_id)
    {
        $this->db->where('session_id', $session_id)->delete($this->table);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_all($session_id, $offset, $limit)
    {
        return $this->db->where('session_id', $session_id)->join('jobs', 'jobs.id = favorites.job_id', 'left')->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left')->select('jobs.id, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") as jobs_stations, category, traits, business_content, title, top_picture, lat, lng')->limit($limit, $offset)->group_by('jobs.id')->get($this->table)->result_array();
    }

    public function get_all_job_ids($session_id)
    {
        $result = [];

        $data = $this->db->where('session_id', $session_id)->select('GROUP_CONCAT(favorites.job_id SEPARATOR ",") as job_ids')->get($this->table)->row_array();

        if (!empty($data['job_ids'])) {
            $result = explode(',', $data['job_ids']);
        }

        return $result;

    }

    public function get_all_cnt($session_id)
    {
        return count($this->db->where('session_id', $session_id)->join('jobs', 'jobs.id = favorites.job_id', 'left')->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left')->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());
    }
}
