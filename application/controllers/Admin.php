<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        if (empty($_SESSION['logged_in'])) {
            redirect('/admin/login');
        }

        $this->load->view('admin/header');
        $this->load->view('admin/home');

    }

    public function login_get()
    {
        if (!empty($_SESSION['logged_in'])) {
            redirect('/admin');
        }


        $this->load->view('admin/header');
        $this->load->view('admin/login');
    }

    public function login_post()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($username == 'ilead' && $password === '0000') {
                $_SESSION['logged_in'] = true;
                redirect('/admin');
            } else {
                $data['error'] = 'ユーザー名またはパスワードが違います。';
                $this->load->view('admin/header', $data);
                $this->load->view('admin/login');
            }
        }
    }

    public function logout()
    {
        session_destroy();
        redirect('/admin');
    }
}
