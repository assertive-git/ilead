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

    public function get_all_prefs_lines_stations()
    {

        $sql = "SELECT prefecture, line_name, station_name FROM `stations` LEFT JOIN `lines` ON `lines`.line_cd = stations.line_cd LEFT JOIN prefectures ON prefectures.pref_cd = stations.pref_cd ORDER BY stations.pref_cd";
        return $this->db->query($sql)->result_array();
    }

    public function get_by_line_cd($line_cd)
    {
        return $this->db->where('line_cd', $line_cd)->get('stations')->result_array();
    }
}
