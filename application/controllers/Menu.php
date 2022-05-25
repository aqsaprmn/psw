<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }

    public function index()
    {
        $data['title'] = 'Judul Menu';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['script'] = "<script src='" . base_url('assets') . "/js/apiMenu.js'></script>";
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('menu/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function addMenu()
    {
        $data['title'] = 'Menu';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['menu'] = $this->M_User->getDataAll('user_menu');

        $data['script'] = "<script src='" . base_url('assets') . "/js/apiMenu.js'></script>";
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('menu/addMenu', $data);
        $this->load->view('template/footer', $data);
    }

    public function addSubMenu()
    {
        $data['title'] = 'Sub Menu';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $this->db->where(['sub_menu_active' => 1]);
        $data['menu'] = $this->M_User->getDataAll('user_menu_go');

        $data['script'] = "<script src='" . base_url('assets') . "/js/apiMenu.js'></script>";
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('menu/addSubMenu', $data);
        $this->load->view('template/footer', $data);
    }
}
