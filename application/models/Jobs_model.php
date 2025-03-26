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
        $data = $this->db->order_by('jobs.id', 'DESC');
        $data->join('custom_fields', 'custom_fields.job_id = jobs.id', 'left');
        $data->group_by('jobs.id');


        if (!empty($_POST['status'])) {
            $status = $_POST['status'];

            $data->where('status', $status);
        }

        if (!empty($_POST['keyword'])) {
            $keyword = $_POST['keyword'];

            $data->where("
                (
                    jobs.id LIKE '%$keyword%' OR
                    business_content LIKE '%$keyword%' OR
                    jobs.title LIKE '%$keyword%' OR
                    body LIKE '%$keyword%' OR
                    employment_type LIKE '%$keyword%' OR
                    salary_type LIKE '%$keyword%' OR
                    min_salary LIKE '%$keyword%' OR
                    max_salary LIKE '%$keyword%' OR
                    job_type LIKE '%$keyword%' OR
                    category LIKE '%$keyword%' OR
                    closest_bus_stop LIKE '%$keyword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$keyword%' OR
                    traits LIKE '%$keyword%' OR
                    memo LIKE '%$keyword%' OR
                    company_or_store_name LIKE '%$keyword%' OR
                    custom_fields.title LIKE '%$keyword%' OR
                    custom_fields.detail LIKE '%$keyword%'
                )
            ");
        }

        $data->select("jobs.id, jobs.title, employment_type, city, jobs.updated_at, jobs.created_at, jobs.status, jobs.memo");

        return $data->limit($limit, $offset)->get($this->table)->result_array();
    }

    public function get_all_cnt_admin($status, $keyword)
    {

        $data = $this->db->join('custom_fields', 'custom_fields.job_id = jobs.id', 'left');
        $data->group_by('jobs.id');

        if (!empty($status)) {
            $this->db->where('status', $status);
        }

        if (!empty($keyword)) {
            $this->db->where("
                (
                    jobs.id LIKE '%$keyword%' OR
                    business_content LIKE '%$keyword%' OR
                    jobs.title LIKE '%$keyword%' OR
                    body LIKE '%$keyword%' OR
                    employment_type LIKE '%$keyword%' OR
                    salary_type LIKE '%$keyword%' OR
                    min_salary LIKE '%$keyword%' OR
                    max_salary LIKE '%$keyword%' OR
                    job_type LIKE '%$keyword%' OR
                    category LIKE '%$keyword%' OR
                    closest_bus_stop LIKE '%$keyword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$keyword%' OR
                    traits LIKE '%$keyword%' OR
                    memo LIKE '%$keyword%' OR
                    company_or_store_name LIKE '%$keyword%' OR
                    custom_fields.title LIKE '%$keyword%' OR
                    custom_fields.detail LIKE '%$keyword%'
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
        return $this->db->where('id', $id)->select('jobs.id, updated_at, body, company_or_store_name, map_address, map_url, employment_type, job_type, a_region, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, IF(min_salary = 0, "", min_salary) as min_salary, IF(max_salary = 0, "", max_salary) as max_salary, salary_type, closest_bus_stop, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng, gfj_working_hours, gfj_listing_start_date, gfj_listing_end_date, gfj, gfj_employment_type, tantosha, status')->get($this->table)->row_array();
    }

    public function get($id)
    {
        return $this->db->where('id', $id)->where('status', '公開')->select('jobs.id, title, body, memo, company_or_store_name, map_address, map_url, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, closest_bus_stop, address, has_requirement, category, traits, business_content, title, top_picture, gfj, gfj_working_hours, gfj_listing_start_date, gfj_employment_type, IF(min_salary = 0, "", min_salary) as min_salary, IF(max_salary = 0, "", max_salary) as max_salary, lat, lng')->get($this->table)->row_array();
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

        $data = $this->db;
        $data->join('custom_fields', 'custom_fields.job_id = jobs.id', 'left');

        if (!empty($areas)) {
            $data->where_in('concat(a_pref, city)', $areas);
        }

        if (!empty($stations)) {
            $stations = str_replace(["(", ")"], ["\\\\(", "\\\\)"], implode('|', $stations));
            $data->having('jobs_stations REGEXP "' . $stations . '"');
        }

        if (!empty($employment_types)) {
            $data->where_in('employment_type', $employment_types);
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
                $data->where('(' . $sql . ')');
            }
        }


        if (!empty($job_types)) {
            $data->where_in('job_type', $job_types);
        }

        if (!empty($categories)) {
            $data->where('category REGEXP "' . $categories . '"');
        }

        if (!empty($traits)) {
            $data->where('traits REGEXP "' . $traits . '"');
        }

        if (!empty($freeword)) {
            $data->where("
                (
                    jobs.id LIKE '%$freeword%' OR
                    business_content LIKE '%$freeword%' OR
                    jobs.title LIKE '%$freeword%' OR
                    body LIKE '%$freeword%' OR
                    employment_type LIKE '%$freeword%' OR
                    salary_type LIKE '%$freeword%' OR
                    min_salary LIKE '%$freeword%' OR
                    max_salary LIKE '%$freeword%' OR
                    job_type LIKE '%$freeword%' OR
                    category LIKE '%$freeword%' OR
                    closest_bus_stop LIKE '%$freeword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                    traits LIKE '%$freeword%' OR
                    company_or_store_name LIKE '%$freeword%' OR
                    custom_fields.title LIKE '%$freeword%' OR
                    custom_fields.detail LIKE '%$freeword%'
                )
                ");
        }

        $data = $data->where('status', '公開')->order_by('id', 'DESC')->group_by('jobs.id, lat, lng, business_content, title, employment_type, category, salary, has_requirement, top_picture, employment_type, pref, city, closest_bus_stop, address, map_address, traits')->limit($limit, $offset)->select('jobs.id as id, lat, lng, business_content, jobs.title, employment_type, category, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, has_requirement, top_picture, employment_type, a_pref as pref, city, closest_bus_stop, address, map_address, traits, lat, lng, (select group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") from jobs_stations where jobs.id = jobs_stations.job_id) as jobs_stations')->order_by('employment_type')->get($this->table)->result_array();

        return $data;
    }

    public function get_all_cnt($areas = [], $stations = [], $employment_types = [], $salary = [], $job_types = [], $categories = [], $traits = [], $freeword = '')
    {
        $data = $this->db;
        $data->join('custom_fields', 'custom_fields.job_id = jobs.id', 'left');
        $data->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left');

        if (!empty($areas)) {
            $data->where_in('concat(a_pref, city)', $areas);
        }

        if (!empty($stations)) {
            $stations = str_replace(["(", ")", "_"], ["\\\\(", "\\\\)", ""], implode('|', $stations));
            $data->where('concat(jobs_stations.pref, jobs_stations.line, jobs_stations.station) REGEXP "' . $stations . '"');
        }

        if (!empty($employment_types)) {
            $data->where_in('employment_type', $employment_types);
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
                $data->where('(' . $sql . ')');
            }

        }


        if (!empty($job_types)) {
            $data->where_in('job_type', $job_types);
        }

        if (!empty($categories)) {
            $data->where('category REGEXP "' . $categories . '"');
        }

        if (!empty($traits)) {
            $data->where('traits REGEXP "' . $traits . '"');
        }

        if (!empty($freeword)) {
            $data->where("
                (
                    jobs.id LIKE '%$freeword%' OR
                    business_content LIKE '%$freeword%' OR
                    jobs.title LIKE '%$freeword%' OR
                    body LIKE '%$freeword%' OR
                    employment_type LIKE '%$freeword%' OR
                    salary_type LIKE '%$freeword%' OR
                    min_salary LIKE '%$freeword%' OR
                    max_salary LIKE '%$freeword%' OR
                    job_type LIKE '%$freeword%' OR
                    category LIKE '%$freeword%' OR
                    closest_bus_stop LIKE '%$freeword%' OR
                    concat(a_region, a_pref, city, address) LIKE '%$freeword%' OR
                    traits LIKE '%$freeword%' OR
                    company_or_store_name LIKE '%$freeword%' OR
                    custom_fields.title LIKE '%$freeword%' OR
                    custom_fields.detail LIKE '%$freeword%'
                )
                ");
        }

        $data = count($data->where('status', '公開')->select('jobs.id')->group_by('jobs.id')->get($this->table)->result_array());

        return $data;
    }

    public function get_feed_indeed()
    {
        $data = $this->db->where('status', '公開')->order_by('id', 'DESC')
            ->group_by('jobs.id, lat, lng, business_content, title, employment_type, category, salary, has_requirement, top_picture, employment_type, a_pref, city')
            ->select('CONCAT("IL", jobs.id) as referencenumber, jobs.id as requisitionid, CONCAT("' . base_url() . '", "jobs/", jobs.id) as url, "アイリード株式会社" as company, title, category, concat(format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, has_requirement as experience, top_picture as imageUrls, employment_type, concat(a_pref, city, address) as streetaddress, a_pref as state, city, "JP" as country, "info@ilead-hr.co.jp" as email, (select group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") from jobs_stations where jobs.id = jobs_stations.job_id LIMIT 1) as station, body as description, created_at as date')->order_by('employment_type')->get($this->table)->result_array();

        return $data;
    }

    public function get_feed_kyuujin_box()
    {
        $data = $this->db->where('status', '公開')->order_by('id', 'DESC')
            ->group_by('jobs.id, lat, lng, business_content, title, employment_type, category, salary, has_requirement, top_picture, employment_type, a_pref, city, address')
            ->select('jobs.id as referencenumber, company_or_store_name as company, "アイリード株式会社" as agency, CONCAT("' . base_url() . '", "jobs/", jobs.id) as url, title, category, concat(format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, has_requirement as experience, top_picture as imageUrls, employment_type, a_pref as state, city, address, (select group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") from jobs_stations where jobs.id = jobs_stations.job_id) as station, body as description, (SELECT detail from custom_fields WHERE job_id = jobs.id AND title = "勤務時間") as workingHours, (SELECT detail from custom_fields WHERE job_id = jobs.id AND title = "待遇・福利厚生") as benefits, created_at as postDate')->order_by('employment_type')->get($this->table)->result_array();

        return $data;
    }

    public function get_feed_stanby()
    {
        $data = $this->db->where('status', '公開')->order_by('id', 'DESC')
            ->group_by('jobs.id, lat, lng, business_content, title, employment_type, category, salary, has_requirement, top_picture, employment_type, a_pref, city, address')
            ->select('jobs.id as referencenumber, CONCAT("' . base_url() . '", "jobs/", jobs.id) as url, title, employment_type as jobType, category, concat(format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, has_requirement as experience, top_picture as imageurls, employment_type, a_pref as state, address as city, (select group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") from jobs_stations where jobs.id = jobs_stations.job_id) as station, body as description, "内定時までに開示します" as benefits, "内定時までに開示します" as insurance, "内定時までに開示します" as preventsmoke, "内定時までに開示します" as timeshift, "内定時までに開示します" as contractperiod, "非公開" as company, "内定時までに開示します" as holiday, created_at as postDate')->order_by('employment_type')->get($this->table)->result_array();

        return $data;
    }

    public function get_new_jobs()
    {
        return $this->db->where('status', '公開')->order_by('id', 'desc')->limit(10)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();
    }

    public function get_csv_export()
    {
        return $this->db->order_by('id', 'desc')->get($this->table)->result_array();
    }

    public function get_by_ids($ids)
    {
        return $this->db->join('jobs_stations', 'jobs_stations.job_id = jobs.id', 'left')->where_in('jobs.id', $ids)->select('jobs.id, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, (select group_concat(concat(line, station, " ", "徒歩", walking_distance, "分") SEPARATOR "<br>") from jobs_stations where jobs.id = jobs_stations.job_id) as jobs_stations, category, traits, business_content, title, top_picture, lat, lng')->group_by('jobs.id, lat, lng, business_content, title, employment_type, category, salary, has_requirement, top_picture, employment_type, pref, city, closest_bus_stop, address, map_address, traits')->get($this->table)->result_array();


    }

    public function get_deployment()
    {
        return $this->db->where('employment_type', '派遣・在籍出向')->limit(6)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();
    }

    public function get_direct()
    {
        return $this->db->where('employment_type <>', '派遣・在籍出向')->limit(6)->select('jobs.id, body, company_or_store_name, employment_type, job_type, a_pref, city, concat("【", salary_type, "】", format_number(min_salary), IF(max_salary <> 0, concat("～", format_number(max_salary)), "")) as salary, address, has_requirement, category, traits, business_content, title, top_picture, lat, lng')->get($this->table)->result_array();

    }

    public function exists($job_id)
    {
        $result = $this->db->where('id', $job_id)->get($this->table)->row_array();
        return !empty($result);
    }
}