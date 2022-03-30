<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Components extends CI_Controller
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
            if ($userData['role_id'] == 1) {
                $data['allUser'] = $this->M_User->getDataAll('user');
                $data['user'] = [
                    'nama' => $userData['nama'],
                    'gambar' => $userData['gambar'],
                    'role_id' => $userData['role_id']
                ];
                $data['title'] = 'My Profile';
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar');
                $this->load->view('content/myProfile', $data);
                $this->load->view('template/footer');
            } else {
                $data['user'] = [
                    'nama' => $userData['nama'],
                    'gambar' => $userData['gambar'],
                    'role_id' => $userData['role_id']
                ];
                $data['title'] = 'My Profile';
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar');
                $this->load->view('content/myProfile', $data);
                $this->load->view('template/footer');
            }
        } else {
            redirect('user');
        }
    }

    public function editDataUser()
    {
        $userEmail = $this->session->userdata('userEmail');
        $userData = $this->M_User->getDataW('user', ['email' => $userEmail]);
        if ($userData['role_id'] == 1) {
            $data['allUser'] = $this->M_User->getDataAll('user');
            $data['user'] = [
                'nama' => $userData['nama'],
                'gambar' => $userData['gambar'],
                'role_id' => $userData['role_id']
            ];
            $data['title'] = 'My Profile';
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('editdatauser', $data);
            $this->load->view('template/footer');
        }
    }
}
