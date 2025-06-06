<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Custom_fields_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'custom_fields';
    }

    public function get_all($job_id)
    {
        return $this->db->join('jobs', 'custom_fields.job_id = jobs.id')->where('jobs.id', $job_id)->select('custom_fields.id as id, custom_fields.title, custom_fields.detail, custom_fields.sort_order, custom_fields.created_at as created_at')->order_by('sort_order')->get($this->table)->result_array();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete($this->table);
    }

    public function update_by_date($date, $job_id, $data, $id) {
        $this->db->where('created_at', $date)->where('job_id', $job_id)->where('id', $id)->update($this->table, $data);
    }
}
