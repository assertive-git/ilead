<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs_stations_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'jobs_stations';
    }

    public function get_all($job_id)
    {
        return $this->db->join('jobs', 'jobs_stations.job_id = jobs.id')->where('jobs.id', $job_id)->select('jobs_stations.id as id, line, station, walking_distance')->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }
}
