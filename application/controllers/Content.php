<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Content extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('M_User');
    }

    public function index()
    {
        $userEmail = $this->session->userdata('userEmail');
        //Cek Session ada atau tidak
        if (isset($userEmail)) {
            $userData = $this->M_User->getDataW('user', ['email' => $userEmail]);
            $data['user'] = [
                'nama' => $userData['nama'],
                'gambar' => $userData['gambar']
            ];

            $data['title'] = 'Dashboard';

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('content/dashboard', $data);
            $this->load->view('template/footer');
        } else {
            redirect('user');
        }
    }
}
