<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
        $this->load->library('form_validation');
    }

    public function kategori()
    {

        $data['title'] = 'Kategori';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script>";

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('master/kategori');
        $this->load->view('template/footer');
    }

    public function tambahKategori()
    {

        $data['title'] = 'Kategori';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master/tambahKategori');
            $this->load->view('template/footer');
        } else {
            $keterangan = htmlspecialchars($this->input->post('keterangan'));

            $insTblKategori = $this->M_User->insertData('mr_kategori', ['keterangan' =>  $keterangan]);

            if ($insTblKategori > 0) {
                $this->session->set_flashdata('result', 'Berhasil');
                redirect('master/kategori');
            } else {

                $this->session->set_flashdata('result', 'Gagal');
                redirect('master/kategori');
            }
        }
    }
}
