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

            $data->where("
                (
                    id LIKE '%$keyword%' OR
                    business_content LIKE '%$keyword%' OR
                    title LIKE '%$keyword%' OR
                    body LIKE '%$keyword%' OR
                    employment_type LIKE '%$keyword%' OR
                    salary_type LIKE '%$keyword%' OR
                    min_salary LIKE '%$keyword%' OR
                    max_salary LIKE '%$keyword%' OR
                    job_type LIKE '%$keyword%' OR
                    category LIKE '%$keyword%' OR
                    closest_bus_stop LIKE '%$keyword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$keyword%' OR
                    traits LIKE '%$keyword%'
                )
            ");
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
                (
                    id LIKE '%$keyword%' OR
                    business_content LIKE '%$keyword%' OR
                    title LIKE '%$keyword%' OR
                    body LIKE '%$keyword%' OR
                    employment_type LIKE '%$keyword%' OR
                    salary_type LIKE '%$keyword%' OR
                    min_salary LIKE '%$keyword%' OR
                    max_salary LIKE '%$keyword%' OR
                    job_type LIKE '%$keyword%' OR
                    category LIKE '%$keyword%' OR
                    closest_bus_stop LIKE '%$keyword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$keyword%' OR
                    traits LIKE '%$keyword%'
                )
            ");
        }

        $data = count($this->db->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());

        return $data;
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
        return $this->db->where('id', $id)->where('status', '公開')->select('jobs.id, body, company_or_store_name, map_address, map_url, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->row_array();
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
                closest_bus_stop LIKE '%$freeword%' OR
                concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                traits LIKE '%$freeword%')
                ");
        }

        $data = $data->where('status', '公開')->order_by('id', 'DESC')->group_by('jobs.id')->limit($limit, $offset)->select('jobs.id as id, lat, lng, business_content, title, employment_type, category, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, has_requirement, top_picture, employment_type, a_pref as pref, city, address, map_address, traits, lat, lng, group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") as jobs_stations')->order_by('employment_type')->get($this->table)->result_array();

        $query = $this->db->last_query();

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
                closest_bus_stop LIKE '%$freeword%' OR
                concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                traits LIKE '%$freeword%')
                ");
        }

        $data = count($data->where('status', '公開')->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());

        return $data;
    }

    public function get_new_jobs()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit(10)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();
    }

    public function get_csv_export()
    {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_by_ids($ids)
    {
        return $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left')->where_in('jobs.id', $ids)->select('jobs.id, a_pref, city, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") as jobs_stations, category, traits, business_content, title, top_picture, lat, lng')->group_by('jobs.id')->get($this->table)->result_array();


    }

    public function get_deployment()
    {
        return $this->db->where('employment_type', '派遣・在籍出向')->limit(6)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();
    }

    public function get_direct()
    {
        return $this->db->where('employment_type <>', '派遣・在籍出向')->limit(6)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", IF(min_salary < 10000, "¥", ""), format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();

    }
}