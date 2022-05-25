<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }

    public function barangHilang()
    {
        $data['title'] = 'Barang Hilang Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/baranghilang');
        $this->load->view('template/footer');
    }

    public function barangTemuan()
    {
        $data['title'] = 'Barang Temuan Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/barangtemuan');
        $this->load->view('template/footer');
    }
}
