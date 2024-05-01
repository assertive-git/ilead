<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends CI_Controller
{
    public function get_all()
    {
        $data = $this->jobs_model->get_all();
        echo json_encode(['jobs' => $data]);
    }

    public function get()
    {

    }
}
