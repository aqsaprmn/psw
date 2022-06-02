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

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script><script src=' " . base_url('assets') . "/js/apiMaster.js'></script>";

        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('master/kategori', $data);
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
            $keterangan = htmlspecialchars(trim($this->input->post('keterangan', true)));

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

    public function kategoriAll()
    {
        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        echo json_encode($data);
    }

    public function deleteKategori()
    {
        $id = $this->input->post('id');

        $kateDelete = $this->M_User->deletetData('mr_kategori', ['id' => $id]);

        if ($kateDelete > 0) {
            $data['msg'] = [
                'text' => "Kategori dengan ID " . $id . " Berhasil Dihapus",
                'icon' => "success"
            ];
        } else {
            $data['msg'] = [
                'text' => "Barang dengan ID " . $id . " Gagal Dihapus Di Table 'br_barang_hilang'",
                'icon' => "warning"
            ];
        }

        echo json_encode($data);
    }

    public function editKategori($id)
    {
        $data['title'] = 'Kategori';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['kate'] = $this->M_User->getDataW('mr_kategori', ['id' => $id]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('master/editKategori', $data);
            $this->load->view('template/footer');
        } else {
            $keterangan = htmlspecialchars(trim($this->input->post('keterangan', true)));

            $cekKate = $this->M_User->cekDataAvai('mr_kategori', ['id!=' => $id, 'keterangan' => $keterangan]);

            if ($cekKate > 0) {
                $this->session->set_flashdata('result', 'Gagal');
                redirect('master/kategori');
            }

            $editTblKategori = $this->M_User->editData('mr_kategori', ['keterangan' => $keterangan], ['id' => $id]);

            if ($editTblKategori > 0) {
                $this->session->set_flashdata('result', 'Berhasil');
                redirect('master/kategori');
            } else {
                $this->session->set_flashdata('result', 'Gagal');
                redirect('master/kategori');
            }
        }
    }
}
