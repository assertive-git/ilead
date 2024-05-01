<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'news';
    }

    public function get_all_admin()
    {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_all()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_admin($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function get($id)
    {
        return $this->db->where('status', '公開')->where('id', $id)->get($this->table)->row_array();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function get_new_news()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit(4)->get($this->table)->result_array();
    }
}
