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

    public function get_all_admin($offset, $limit)
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
                OR body LIKE "%' . $keyword . '%"
            )'
            );
        }

        return $data->limit($limit, $offset)->get($this->table)->result_array();
    }

    public function get_all_cnt_admin($status, $keyword)
    {

        if (!empty($status)) {
            $this->db->where('status', $status);
        }

        if (!empty($keyword)) {
            $this->db->where("
                title LIKE '%$keyword%' OR
                body LIKE '%$keyword%'
                ");
        }

        $data = count($this->db->select('news.id')->group_by('news.id')->get($this->table)->result_array());

        return $data;
    }

    public function get_all($offset, $limit)
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit($limit, $offset)->get($this->table)->result_array();
    }

    public function get_all_cnt()
    {
        return count($this->db->where('status', '公開')->order_by('id', 'desc')->get($this->table)->result_array());
    }

    public function get_admin($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row_array();
    }

    public function get($id)
    {
        return $this->db->where('status', '公開')->where('id', $id)->select('id, title, body, created_at, (select max(id) FROM news where id < tmpNews.id) as prev_id, (select min(id) FROM news where id > tmpNews.id) as next_id')->get('news as tmpNews')->row_array();
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
