<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stations_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'stations';
    }

    public function get_all()
    {
        return $this->db->order_by('e_sort')->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->where('station_cd', $id)->order_by('line_cd')->get($this->table)->row_array();
    }
}
