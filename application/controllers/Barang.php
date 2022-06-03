<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
        $this->load->library('form_validation');
    }

    public function barangHilang()
    {
        $data['title'] = 'Barang Hilang Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script><script src=' " . base_url('assets') . "/js/apiBarang.js'></script>";

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/baranghilang');
        $this->load->view('template/footer');
    }

    public function tambahBarangHilang()
    {
        $data['title'] = 'Barang Hilang Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('barang/tambahbaranghilang');
            $this->load->view('template/footer', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $kategori = htmlspecialchars($this->input->post('kategori', true));
            $tanggal = htmlspecialchars($this->input->post('tanggal', true));
            $keterangan = htmlspecialchars($this->input->post('keterangan'), true);

            $config['upload_path'] = './assets/baranghilang';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar1')) {
                $upGambar1 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('barang/errorupload', $error);
                die;
            }

            if ($this->upload->do_upload('gambar2')) {
                $upGambar2 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('barang/errorupload', $error);
                die;
            }

            $kdBarangLast = $this->M_User->getDataAllDescLim('br_barang_hilang', 'id', 'Desc', 1);

            if (empty($kdBarangLast)) {
                $kdBrNow = 'BRH' . date("dmY") . '-1';
            } else {
                $kdBrNow = explode('-', $kdBarangLast[0]['kd_brh']);

                $kdBrNow = $kdBrNow[1] + 1;

                $kdBrNow = 'BRH' . date("dmY") . '-' . $kdBrNow;
            }

            $data1 = [
                'kd_brh' => $kdBrNow,
                'nama_brh' => $nama,
                'kategori' => $kategori,
                'tgl_hilang' => $tanggal,
                'gambar1' => $upGambar1,
                'gambar2' => $upGambar2,
                'keterangan' => $keterangan,
                'status' => 'Y'
            ];

            $data2 = [
                'user_id' => $data['user']['id'],
                'kd_br' => $kdBrNow
            ];

            $addTblBrh = $this->M_User->insertData('br_barang_hilang', $data1);
            if ($addTblBrh > 0) {
                $addTblPengBr = $this->M_User->insertData('br_barang_pengguna', $data2);
                if ($addTblPengBr > 0) {
                    $this->session->set_flashdata('result',  'Berhasil');
                    redirect('barang/barangHilang');
                } else {
                    $this->session->set_flashdata('result',  'Gagal');
                    redirect('barang/barangHilang');
                }
            } else {
                $this->session->set_flashdata('result',  'Gagal');
                redirect('barang/barangHilang');
            }
        }
    }

    public function barangHilangAll()
    {
        $id = $this->input->post('id', true);
        $key = htmlspecialchars(trim($this->input->post('keyword', true)));

        if ($key != '') {
            $query = "SELECT
                    br_barang_hilang.kd_brh as kode,
                    br_barang_hilang.nama_brh as nama_barang,
                    br_barang_hilang.kategori,
                    br_barang_hilang.tgl_hilang as tanggal_hilang,
                    br_barang_hilang.gambar1,
                    br_barang_hilang.gambar2,
                    br_barang_hilang.keterangan,
                    br_barang_hilang.status,
                    user.nama as nama_pemilik,
                    user.email,
                    user.gambar,
                    user.alamat,
                    user.no_telp
                    FROM br_barang_hilang
                    INNER JOIN br_barang_pengguna
                    ON
                    br_barang_hilang.kd_brh = br_barang_pengguna.kd_br
                    INNER JOIN user
                    ON
                    br_barang_pengguna.user_id = user.id
                    WHERE 
                    user.id = " . $id . "
                    AND
                    br_barang_hilang.nama_brh LIKE '%" . $key . "%'
                    OR
                    br_barang_hilang.kategori LIKE '%" . $key . "%'
                    OR
                    br_barang_hilang.tgl_hilang LIKE '%" . $key . "%';";
        } else {
            $query = "SELECT
                br_barang_hilang.kd_brh as kode,
                br_barang_hilang.nama_brh as nama_barang,
                br_barang_hilang.kategori,
                br_barang_hilang.tgl_hilang as tanggal_hilang,
                br_barang_hilang.gambar1,
                br_barang_hilang.gambar2,
                br_barang_hilang.keterangan,
                br_barang_hilang.status,
                user.nama as nama_pemilik,
                user.email,
                user.gambar,
                user.alamat,
                user.no_telp
                FROM br_barang_hilang
                INNER JOIN br_barang_pengguna
                ON
                br_barang_hilang.kd_brh = br_barang_pengguna.kd_br
                INNER JOIN user
                ON
                br_barang_pengguna.user_id = user.id
                WHERE
                user.id = " . $id . ";";
        }

        $data['barangHilang'] = $this->db->query($query)->result_array();

        echo json_encode($data);
    }

    public function barangHilangDelete()
    {
        $kode = $this->input->post('kode', true);

        $brhDelete = $this->M_User->deletetData('br_barang_hilang', ['kd_brh' => $kode]);
        $brpDelete = $this->M_User->deletetData('br_barang_pengguna', ['kd_br' => $kode]);

        if ($brpDelete > 0) {
            if ($brhDelete > 0) {
                $data['msg'] = [
                    'text' => "Barang dengan kode " . $kode . " Berhasil Dihapus",
                    'icon' => "success"
                ];
            } else {
                $data['msg'] = [
                    'text' => "Barang dengan kode " . $kode . " Gagal Dihapus Di Table 'br_barang_hilang'",
                    'icon' => "warning"
                ];
            }
        } else {
            $data['msg'] = [
                'text' => "Barang dengan kode " . $kode . " Gagal Dihapus Di Table 'br_barang_hilang' & 'br_barang_pengguna'",
                'icon' => "warning"
            ];
        }

        echo json_encode($data);
    }

    public function barangHilangEdit($kode)
    {
        $data['title'] = 'Barang Hilang Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script>";

        $data['barang'] = $this->M_User->getDataW('br_barang_hilang', ['kd_brh' => $kode]);
        $tanggal = strtotime($data['barang']['tgl_hilang']);

        // $tanggal = explode(' ', $data['barang']['tgl_hilang']);

        // $tanggalDate = explode('-', $tanggal[0]);

        // $tgl_hilang = "";
        // for ($i = count($tanggalDate) - 1; $i >= 0; $i--) {
        //     if ($i != 0) {
        //         $tgl_hilang .= $tanggalDate[$i] . '-';
        //     } else {
        //         $tgl_hilang .= $tanggalDate[$i];
        //     }
        // }

        // $tgl_hilang .= " " . $tanggal[1];

        $data['tgl_hilang'] = ['tgl' => $tanggal];
        $data['kode'] = ['kode' => $kode];

        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('barang/baranghilangedit', $data);
            $this->load->view('template/footer', $data);
        } else {
            // Ambil data barang
            $brh = $this->M_User->getDataW('br_barang_hilang', ['kd_brh' => $kode]);

            //Tangkap data Post
            $nama = htmlspecialchars(trim($this->input->post('nama', true)));
            $kategori = $this->input->post('kategori', true);
            $tanggal = $this->input->post('tanggal', true);
            $keterangan = htmlspecialchars(trim($this->input->post('keterangan', true)));
            $status = $this->input->post('status');

            //Tangkap data upload gambar
            $gambar1 = $_FILES['gambar1']['name'];
            $gambar2 = $_FILES['gambar2']['name'];

            //Periksa apakah data yang dirubah sama dengan data lain atau tidak , karena tidak boleh sama dalam 1 user
            $cekDataBrh = $this->M_User->cekDataAvai('br_barang_hilang', ['kd_brh!=' > $kode, 'nama_brh' => $nama, 'keterangan' => $keterangan]);

            if ($cekDataBrh > 0) {
                $cekDataBrp = $this->M_User->cekDataAvai('br_barang_pengguna', ['user_id' => $data['user']['id'], 'kd_br' => $kode]);
                if ($cekDataBrp > 0) {
                    $this->session->set_flashdata('failed', '');
                    redirect('barang/barangHilang');
                }
            }

            //Upload gambar
            $config['upload_path'] = './assets/baranghilang';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if ($gambar1 != "") {
                if ($this->upload->do_upload('gambar1')) {
                    unlink(FCPATH . 'assets/baranghilang/' . $brh['gambar1']);
                    $upGambar1 = $this->upload->data('file_name');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('barang/errorupload', $error);
                    die;
                }
            } else {
                $upGambar1 = $brh['gambar1'];
            }

            if ($gambar2 != '') {
                if ($this->upload->do_upload('gambar2')) {
                    unlink(FCPATH . 'assets/baranghilang/' . $brh['gambar2']);
                    $upGambar2 = $this->upload->data('file_name');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('barang/errorupload', $error);
                    die;
                }
            } else {
                $upGambar2 = $brh['gambar2'];
            }

            $data = [
                'nama_brh' => $nama,
                'kategori' => $kategori,
                'tgl_hilang' => $tanggal,
                'gambar1' => $upGambar1,
                'gambar2' => $upGambar2,
                'keterangan' => $keterangan,
                'status' => $status
            ];

            //proses update data barang ke database
            $editTblBrh = $this->M_User->editData('br_barang_hilang', $data, ['kd_brh' => $kode]);
            if ($editTblBrh > 0) {
                $this->session->set_flashdata('result',  'Berhasil');
                redirect('barang/barangHilang');
            } else {
                $this->session->set_flashdata('result',  'Gagal');
                redirect('barang/barangHilang');
            }
        }
    }

    public function barangTemuan()
    {
        $data['title'] = 'Barang Temuan Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script><script src=' " . base_url('assets') . "/js/apiBarang.js'></script>";

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/barangtemuan');
        $this->load->view('template/footer');
    }

    public function tambahBarangTemuan()
    {
        $data['title'] = 'Barang Temuan Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('barang/tambahbarangtemuan');
            $this->load->view('template/footer', $data);
        } else {
            $nama = htmlspecialchars($this->input->post('nama', true));
            $kategori = htmlspecialchars($this->input->post('kategori', true));
            $tanggal = htmlspecialchars($this->input->post('tanggal', true));
            $keterangan = htmlspecialchars($this->input->post('keterangan'), true);

            $config['upload_path'] = './assets/barangtemu';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar1')) {
                $upGambar1 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar', $data);
                $this->load->view('barang/tambahbarangtemuan');
                $this->load->view('template/footer');
            }

            if ($this->upload->do_upload('gambar2')) {
                $upGambar2 = $this->upload->data('file_name');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('template/sidebar', $data);
                $this->load->view('template/topbar', $data);
                $this->load->view('barang/tambahbarangtemuan');
                $this->load->view('template/footer');
            }

            $kdBarangLast = $this->M_User->getDataAllDescLim('br_barang_temuan', 'id', 'Desc', 1);

            if (empty($kdBarangLast)) {
                $kdBrNow = 'BRT' . date("dmY") . '-1';
            } else {
                $kdBrNow = explode('-', $kdBarangLast[0]['kd_brt']);

                $kdBrNow = $kdBrNow[1] + 1;

                $kdBrNow = 'BRT' . date("dmY") . '-' . $kdBrNow;
            }

            $data1 = [
                'kd_brt' => $kdBrNow,
                'nama_brt' => $nama,
                'kategori' => $kategori,
                'tgl_temu' => $tanggal,
                'gambar1' => $upGambar1,
                'gambar2' => $upGambar2,
                'keterangan' => $keterangan,
                'status' => 'Y'
            ];

            $data2 = [
                'user_id' => $data['user']['id'],
                'kd_br' => $kdBrNow
            ];

            $addTblBrt = $this->M_User->insertData('br_barang_temuan', $data1);
            if ($addTblBrt > 0) {
                $addTblPengBr = $this->M_User->insertData('br_barang_pengguna', $data2);
                if ($addTblPengBr > 0) {
                    $this->session->set_flashdata('result',  'Berhasil');
                    redirect('barang/barangTemuan');
                } else {
                    $this->session->set_flashdata('result',  'Gagal');
                    redirect('barang/barangTemuan');
                }
            } else {
                $this->session->set_flashdata('result',  'Gagal');
                redirect('barang/barangTemuan');
            }
        }
    }

    public function barangTemuanAll()
    {
        $id = $this->input->post('id', true);
        $key = htmlspecialchars(trim($this->input->post('keyword', true)));

        if ($key != '') {
            $query = "SELECT
                    br_barang_temuan.kd_brt as kode,
                    br_barang_temuan.nama_brt as nama_barang,
                    br_barang_temuan.kategori,
                    br_barang_temuan.tgl_temu as tanggal_temuan,
                    br_barang_temuan.gambar1,
                    br_barang_temuan.gambar2,
                    br_barang_temuan.keterangan,
                    br_barang_temuan.status,
                    user.nama as nama_pemilik,
                    user.email,
                    user.gambar,
                    user.alamat,
                    user.no_telp
                    FROM br_barang_temuan
                    INNER JOIN br_barang_pengguna
                    ON
                    br_barang_temuan.kd_brt = br_barang_pengguna.kd_br
                    INNER JOIN user
                    ON
                    br_barang_pengguna.user_id = user.id
                    WHERE 
                    user.id = " . $id . "
                    AND
                    br_barang_temuan.nama_brt LIKE '%" . $key . "%'
                    OR
                    br_barang_temuan.kategori LIKE '%" . $key . "%'
                    OR
                    br_barang_temuan.tgl_temu LIKE '%" . $key . "%';";
        } else {
            $query = "SELECT
                br_barang_temuan.kd_brt as kode,
                br_barang_temuan.nama_brt as nama_barang,
                br_barang_temuan.kategori,
                br_barang_temuan.tgl_temu as tanggal_temuan,
                br_barang_temuan.gambar1,
                br_barang_temuan.gambar2,
                br_barang_temuan.keterangan,
                br_barang_temuan.status,
                user.id as id_user,
                user.nama as nama_pemilik,
                user.email,
                user.gambar,
                user.alamat,
                user.no_telp
                FROM br_barang_temuan
                INNER JOIN br_barang_pengguna
                ON
                br_barang_temuan.kd_brt = br_barang_pengguna.kd_br
                INNER JOIN user
                ON
                br_barang_pengguna.user_id = user.id
                WHERE
                user.id = " . $id . ";";
        }

        $data['barangTemuan'] = $this->db->query($query)->result_array();

        echo json_encode($data);
    }

    public function barangTemuanDelete()
    {
        $kode = $this->input->post('kode', true);

        $brhDelete = $this->M_User->deletetData('br_barang_temuan', ['kd_brt' => $kode]);
        $brpDelete = $this->M_User->deletetData('br_barang_pengguna', ['kd_br' => $kode]);

        if ($brpDelete > 0) {
            if ($brhDelete > 0) {
                $data['msg'] = [
                    'text' => "Barang dengan kode " . $kode . " Berhasil Dihapus",
                    'icon' => "success"
                ];
            } else {
                $data['msg'] = [
                    'text' => "Barang dengan kode " . $kode . " Gagal Dihapus Di Table 'br_barang_temuan'",
                    'icon' => "warning"
                ];
            }
        } else {
            $data['msg'] = [
                'text' => "Barang dengan kode " . $kode . " Gagal Dihapus Di Table 'br_barang_temuan' & 'br_barang_pengguna'",
                'icon' => "warning"
            ];
        }

        echo json_encode($data);
    }

    public function barangTemuanEdit($kode)
    {
        $data['title'] = 'Barang Temuan Anda';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['kategori'] = $this->M_User->getDataAll('mr_kategori');

        $data['script'] = "<script src=' " . base_url('assets') . "/js/flash.js'></script>";

        $data['barang'] = $this->M_User->getDataW('br_barang_temuan', ['kd_brt' => $kode]);
        $tanggal = strtotime($data['barang']['tgl_temu']);

        $data['tgl_temu'] = ['tgl' => $tanggal];
        $data['kode'] = ['kode' => $kode];

        $this->form_validation->set_rules('nama', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('barang/barangtemuanedit', $data);
            $this->load->view('template/footer', $data);
        } else {
            // Ambil data barang
            $brt = $this->M_User->getDataW('br_barang_temuan', ['kd_brt' => $kode]);

            //Tangkap data Post
            $nama = htmlspecialchars($this->input->post('nama', true));
            $kategori = $this->input->post('kategori', true);
            $tanggal = $this->input->post('tanggal', true);
            $keterangan = htmlspecialchars($this->input->post('keterangan', true));
            $status = $this->input->post('status');

            //Tangkap data upload gambar
            $gambar1 = $_FILES['gambar1']['name'];
            $gambar2 = $_FILES['gambar2']['name'];

            //Periksa apakah data yang dirubah sama dengan data lain atau tidak , karena tidak boleh sama dalam 1 user
            $cekDataBrt = $this->M_User->cekDataAvai('br_barang_temuan', ['kd_brt!=' > $kode, 'nama_brt' => $nama, 'keterangan' => $keterangan]);

            if ($cekDataBrt > 0) {
                $cekDataBrp = $this->M_User->cekDataAvai('br_barang_pengguna', ['user_id' => $data['user']['id'], 'kd_br' => $kode]);
                if ($cekDataBrp > 0) {
                    $this->session->set_flashdata('failed', '');
                    redirect('barang/barangTemuan');
                }
            }

            //Upload gambar
            $config['upload_path'] = './assets/barangtemu';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 5000;

            $this->load->library('upload', $config);

            if ($gambar1 != "") {
                if ($this->upload->do_upload('gambar1')) {
                    unlink(FCPATH . 'assets/barangtemu/' . $brt['gambar1']);
                    $upGambar1 = $this->upload->data('file_name');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('barang/errorupload', $error);
                    die;
                }
            } else {
                $upGambar1 = $brt['gambar1'];
            }

            if ($gambar2 != '') {
                if ($this->upload->do_upload('gambar2')) {
                    unlink(FCPATH . 'assets/barangtemu/' . $brt['gambar2']);
                    $upGambar2 = $this->upload->data('file_name');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $this->load->view('barang/errorupload', $error);
                    die;
                }
            } else {
                $upGambar2 = $brt['gambar2'];
            }

            $data = [
                'nama_brt' => $nama,
                'kategori' => $kategori,
                'tgl_temu' => $tanggal,
                'gambar1' => $upGambar1,
                'gambar2' => $upGambar2,
                'keterangan' => $keterangan,
                'status' => $status
            ];

            //proses update data barang ke database
            $editTblBrt = $this->M_User->editData('br_barang_temuan', $data, ['kd_brt' => $kode]);
            if ($editTblBrt > 0) {
                $this->session->set_flashdata('result',  'Berhasil');
                redirect('barang/barangTemuan');
            } else {
                $this->session->set_flashdata('result',  'Gagal');
                redirect('barang/barangTemuan');
            }
        }
    }

    public function daftarBarangHilang()
    {
        $data['title'] = 'Daftar Barang Hilang';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('barang/daftarbaranghilang', $data);
        $this->load->view('template/footer');
    }

    public function daftarBarangHilangAll()
    {
        $this->M_User->getDataAll(
            ''
        );
    }
}
