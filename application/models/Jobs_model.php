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
                OR job_type LIKE "%' . $keyword . '%"
                OR city LIKE "%' . $keyword . '%"
                OR memo LIKE "%' . $keyword . '%"
            )'
            );
        }

        return $data->limit($limit, $offset)->get($this->table)->result_array();
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

    public function get_all($offset, $limit, $areas = [], $stations = [], $employment_types = [], $salary = [], $job_types = [], $categories = [], $traits = [], $freeword = '')
    {
        $data = $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left');

        if (!empty($areas)) {
            $data->where_in('concat(a_pref, city)', $areas);
        }

        if (!empty($stations)) {
            $data->where_in('concat(line, station)', $stations);
        }

        if (!empty($employment_types)) {
            $this->db->where_in('employment_type', $employment_types);
        }

        if (!empty($salary)) {
            $yearly = $salary['yearly'];
            $hourly = $salary['hourly'];

            $sql = "";

            if (!empty($yearly)) {
                $sql .= '(salary_type = "年収" AND max_salary >= ' . $yearly . ')';
            }

            if (!empty($sql) && !empty($hourly)) {
                $sql .= ' OR ';
            }

            if (!empty($hourly)) {
                $sql .= '(salary_type = "時給" and max_salary >= ' . $hourly . ')';
            }

            if (!empty($yearly) || !empty($hourly)) {
                $this->db->where('(' . $sql . ')');
            }

        }


        if (!empty($job_types)) {
            $this->db->where_in('job_type', $job_types);
        }

        if (!empty($categories)) {
            $this->db->where('category REGEXP "' . $categories . '"');
        }

        if (!empty($traits)) {
            $this->db->where('traits REGEXP "' . $traits . '"');
        }

        if (!empty($freeword)) {
            $this->db->where("
                (business_content LIKE '%$freeword%' OR
                title LIKE '%$freeword%' OR
                body LIKE '%$freeword%' OR
                employment_type LIKE '%$freeword%' OR
                salary_type LIKE '%$freeword%' OR
                min_salary LIKE '%$freeword%' OR
                max_salary LIKE '%$freeword%' OR
                job_type LIKE '%$freeword%' OR
                category LIKE '%$freeword%' OR
                concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                traits LIKE '%$freeword%')
                ");
        }

        $data = $data->where('status', '公開')->order_by('id', 'DESC')->group_by('jobs.id')->limit($limit, $offset)->select('jobs.id as id, lat, lng, business_content, title, category, min_salary, max_salary, has_requirement, top_picture, employment_type, a_pref as pref, city, address, map_address, traits, salary_type, lat, lng, group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") as jobs_stations')->get($this->table)->result_array();

        return $data;
    }

    public function get_all_cnt($areas = [], $stations = [], $employment_types = [], $salary = [], $job_types = [], $categories = [], $traits = [], $freeword = '')
    {
        $data = $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left');

        if (!empty($areas)) {
            $data->where_in('concat(a_pref, city)', $areas);
        }

        if (!empty($stations)) {
            $data->where_in('concat(line, station)', $stations);
        }

        if (!empty($employment_types)) {
            $this->db->where_in('employment_type', $employment_types);
        }

        if (!empty($salary)) {
            $yearly = $salary['yearly'];
            $hourly = $salary['hourly'];

            $sql = "";

            if (!empty($yearly)) {
                $sql .= '(salary_type = "年収" AND min_salary >= ' . $yearly . ')';
            }

            if (!empty($sql) && !empty($hourly)) {
                $sql .= ' OR ';
            }

            if (!empty($hourly)) {
                $sql .= '(salary_type = "時給" and min_salary >= ' . $hourly . ')';
            }

            if (!empty($yearly) || !empty($hourly)) {
                $this->db->where('(' . $sql . ')');
            }

        }


        if (!empty($job_types)) {
            $this->db->where_in('job_type', $job_types);
        }

        if (!empty($categories)) {
            $this->db->where('category REGEXP "' . $categories . '"');
        }

        if (!empty($traits)) {
            $this->db->where('traits REGEXP "' . $traits . '"');
        }

        if (!empty($freeword)) {
            $this->db->where("
                (business_content LIKE '%$freeword%' OR
                title LIKE '%$freeword%' OR
                body LIKE '%$freeword%' OR
                employment_type LIKE '%$freeword%' OR
                salary_type LIKE '%$freeword%' OR
                min_salary LIKE '%$freeword%' OR
                max_salary LIKE '%$freeword%' OR
                job_type LIKE '%$freeword%' OR
                category LIKE '%$freeword%' OR
                concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                traits LIKE '%$freeword%')
                ");
        }

        $data = count($data->where('status', '公開')->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());

        return $data;
    }

    public function get_all_cnt_admin($status, $keyword)
    {

        if (!empty($status)) {
            $this->db->where('status', $status);
        }

        if (!empty($keyword)) {
            $this->db->where("
                (business_content LIKE '%$keyword%' OR
                title LIKE '%$keyword%' OR
                body LIKE '%$keyword%' OR
                employment_type LIKE '%$keyword%' OR
                salary_type LIKE '%$keyword%' OR
                min_salary LIKE '%$keyword%' OR
                max_salary LIKE '%$keyword%' OR
                job_type LIKE '%$keyword%' OR
                category LIKE '%$keyword%' OR
                concat(a_region, a_pref, city, address) LIKE '%$keyword%' OR
                traits LIKE '%$keyword%')
                ");
        }

        $data = count($this->db->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());

        return $data;
    }

    // public function get_by_area($areas)
    // {
    //     return $this->db->where('status', '公開')->where_in('CONCAT(a_pref, city)', $areas)->get($this->table)->result_array();
    // }

    // public function get_by_line_and_stations($line, $stations)
    // {
    //     $data = $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id')
    //         ->where('line', $line)->where_in('station', $stations)->where('status', '公開')
    //         ->select('jobs.id as id, lat, lng, title, category, min_salary, max_salary, top_picture, employment_type, pref, city, map_address')->get($this->table)->result_array();

    //     return !empty($data) ? $data : [];
    // }


    // public function get_by_job_type($job_type)
    // {
    //     return $this->db->where('status', '公開')->where_in('job_type', $job_type)->get($this->table)->result_array();
    // }

    // public function get_by_employment_type($employment_type)
    // {
    //     return $this->db->where('status', '公開')->where_in('employment_type', $employment_type)->get($this->table)->result_array();
    // }

    // public function get_by_category($category)
    // {
    //     return $this->db->where('status', '公開')->where_in('category', $category)->get($this->table)->result_array();
    // }

    // public function get_by_traits($traits)
    // {

    //     foreach ($traits as $trait) {
    //         $this->db->or_like('traits', $trait);
    //     }

    //     return $this->db->where('status', '公開')->get($this->table)->result_array();
    // }

    // public function get_by_freeword($fw)
    // {

    // }

    public function get_new_jobs()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit(10)->get($this->table)->result_array();
    }

    public function get_csv_export()
    {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_by_ids($ids)
    {
        return $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left')->where_in('jobs.id', $ids)->select('jobs.id, a_pref, city, min_salary, max_salary, address, has_requirement, group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") as jobs_stations, category, traits, business_content, title, top_picture, lat, lng')->group_by('jobs.id')->get($this->table)->result_array();


    }

    public function get_deployment()
    {
        return $this->db->where('employment_type', '派遣・在籍出向')->limit(6)->get($this->table)->result_array();
    }

    public function get_direct()
    {
        return $this->db->where('employment_type <>', '派遣・在籍出向')->limit(6)->get($this->table)->result_array();
    }
}