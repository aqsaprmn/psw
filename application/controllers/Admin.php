<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['script'] = '<script src="' . base_url('assets') . '/js/demo/chart-area-demo.js"></script><script src="' . base_url('assets') . '/js/demo/chart-pie-demo.js"></script><script src="' . base_url('assets') . '/js/demo/chart-bar-demo.js"></script>';

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('template/footer', $data);
    }

    public function akses()
    {
        $data['title'] = 'Role Akses';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $data['menu'] = $this->M_User->getDataWAll('user_menu', ['id !=' => 1]);

        $data['script'] = '<script src="' . base_url('assets') . '/js/aksesApi.js"></script>';

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('admin/akses', $data);
        $this->load->view('template/footer', $data);
    }

    public function readDataRole()
    {
        $data['role'] = $this->M_User->getDataAll('user_role');

        echo json_encode($data);
    }

    public function addRole()
    {
        $role_name = $this->input->post('role_name');

        $data = [
            'role_name' => $role_name
        ];

        $dataAvai = $this->M_User->cekDataAvai('user_role', ['role_name' => $role_name]);

        if ($role_name == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'role_name',
                'text' => "Nama peran tidak boleh kosong!"
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'role_name',
                'text' => "Nama peran sudah terdaftar!"
            ];
        } else {
            $addData = $this->M_User->insertData('user_role', $data);

            if ($addData > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Nama peran berhasil ditambahkan!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Nama peran gagal ditambahkan!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function deleteRole()
    {
        $id = $this->input->post('id');

        $deleteData = $this->M_User->deletetData('user_role', ['id' => $id]);

        if ($deleteData > 0) {
            $result['msg'] = [
                'status' => true,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Nama peran berhasil dihapus!"
            ];
        } else {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Nama peran gagal dihapus!"
            ];
        }

        echo json_encode($result);
    }

    public function editRole()
    {
        $id = $this->input->post('id');
        $role_name = $this->input->post('role_name');

        $data = [
            'role_name' => $role_name
        ];

        $dataRole = $this->M_User->getDataW('user_role', ['id' => $id]);

        $this->db->where(['id !=' => $id]);
        $dataAvai = $this->M_User->cekDataAvai('user_role', ['role_name' => $role_name]);

        if ($role_name == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'role_name',
                'text' => "Nama peran tidak boleh kosong!"
            ];
        } else if ($role_name == $dataRole['role_name']) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'role_name',
                'text' => "Silahkan ganti nama peran!"
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'role_name',
                'text' => "Nama peran sudah terdaftar!"
            ];
        } else {
            $editData = $this->M_User->editData('user_role', $data, ['id' => $id]);
            if ($editData > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Nama peran berhasil diedit!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Nama peran gagal diedit!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function readIdRole()
    {
        $id = $this->input->post('id');

        $data['role'] = $this->M_User->getDataW('user_role', ['id' => $id]);

        echo json_encode($data);
    }

    public function editAkses()
    {
        $role_id = $this->input->post('role_id');
        $msg = "";
        $menu = $this->M_User->getDataWAll('user_menu', ['id !=' => 1]);
        $dataPenampung = [];
        for ($i = 0; $i < count($menu); $i++) {
            $menu_id = $this->input->post($menu[$i]['id']);
            $dataPenampung[] = $menu_id;
            if (isset($menu_id)) {
                $data = [
                    'role_id' => $role_id,
                    'menu_id' => $menu[$i]['id']
                ];
                if ($menu_id == 'true') {
                    $cek_data_insert = $this->M_User->cekDataAvai('user_access_menu', $data);
                    if ($cek_data_insert < 1) {
                        $insert_data = $this->M_User->insertData('user_access_menu', $data);
                        if ($insert_data > 0) {
                            $msg = "Sukses";
                        } else {
                            $msg = "";
                        }
                    }
                } else {
                    $cek_data_delete = $this->M_User->cekDataAvai('user_access_menu', $data);
                    if ($cek_data_delete > 0) {
                        $delete_data = $this->M_User->deletetData('user_access_menu', $data);
                        if ($delete_data > 0) {
                            $msg = "Sukses";
                        } else {
                            $msg = "";
                        }
                    }
                }
            }
        }

        if ($msg != "") {
            $result['msg'] = [
                'status' => true,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Beri Peran Akses Menu Berhasil!"
            ];
        } else {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Beri Peran Akses Menu Gagal!"
            ];
        }

        echo json_encode($result);
    }
}
