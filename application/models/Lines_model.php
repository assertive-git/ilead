<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lines_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'lines';
    }

    public function get_all()
    {
        return $this->db->order_by('e_sort')->get($this->table)->result_array();
    }

    public function get($id)
    {
        return $this->db->where('line_cd', $id)->get($this->table)->result_array();
    }

    public function get_by_pref($pref)
    {
        $data =  $this->db->select('lines.line_cd, lines.line_name')->distinct()->join('stations', 'stations.line_cd = lines.line_cd')->join('prefectures', 'prefectures.pref_cd = stations.pref_cd', 'left')->where('prefecture', $pref)->get('lines')->result_array();

        return $data;
    }
}
