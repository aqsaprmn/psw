<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }

    public function index()
    {
        $userData = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);
        if ($userData['role_id'] == 1) {
            $data['title'] = 'Profil Seluruh Pengguna';
        } else {
            $data['title'] = 'Profil Saya';
        }
        $data['user'] = $userData;

        if ($userData['role_id'] == 1) {
            $data['allUser'] = $this->M_User->getDataAll('user');
        }

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('member/myProfile', $data);
        $this->load->view('template/footer');
    }

    public function editUser()
    {
        $userId = $this->uri->segment(3);
        if (isset($userId)) {

            $data['title'] = 'Edit Profile';
            $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

            $dataEditUser = $this->M_User->getDataW('user', ['id' => $userId]);

            $data['editUser'] = $dataEditUser;

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('member/editUser', $data);
            $this->load->view('template/footer');
        } else {

            $data['title'] = 'Edit Profile';
            $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

            $data['editUser'] = $data['user'];

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('member/editUser', $data);
            $this->load->view('template/footer');
        }
    }

    public function editUserGo()
    {

        $userId = $this->input->post('id', true);

        $nama = htmlspecialchars($this->input->post('nama', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $nik = htmlspecialchars($this->input->post('nik', true));
        $alamat = htmlspecialchars($this->input->post('alamat', true));
        $no_telp = htmlspecialchars($this->input->post('hp', true));

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim|max_length[1000]', [
            'required' => 'Nama is Required!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|max_length[255]|valid_email', [
            'required' => 'Email is Required!',
            'valid_email' => 'Email is Not Valid!'
        ]);
        $this->form_validation->set_rules(
            'nik',
            'NIK',
            'trim|max_length[16]'
        );
        $this->form_validation->set_rules(
            'alamat',
            'Alamat',
            'trim|max_length[350]'
        );
        $this->form_validation->set_rules(
            'no_telp',
            'No Telepon',
            'trim|max_length[15]'
        );

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Edit Profile';
            $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

            $data['userId'] = $userId;

            $dataEditUser = $this->M_User->getDataW('user', ['id' => $userId]);

            $data['editUser'] = $dataEditUser;

            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('member/editUser', $data);
            $this->load->view('template/footer');
        } else {

            $dataEditUser = $this->M_User->getDataW('user', ['id' => $userId]);
            $allUser = $this->M_User->getDataAll('user');
            $msg = '';
            if ($email != $dataEditUser['email']) {

                for ($i = 0; $i < count($allUser); $i++) {
                    if ($allUser[$i]['email'] == $email) {
                        $msg = 'Email sudah terdaftar!';
                    }
                }
            }

            if ($nik != $dataEditUser['nik']) {

                for ($i = 0; $i < count($allUser); $i++) {
                    if ($allUser[$i]['nik'] == $nik) {
                        $msg = 'NIK sudah terdaftar!';
                    }
                }
            }

            if ($no_telp != $dataEditUser['no_telp']) {

                for ($i = 0; $i < count($allUser); $i++) {
                    if ($allUser[$i]['no_telp'] == $no_telp) {
                        $msg = 'No Telepon sudah terdaftar!';
                    }
                }
            }

            if ($msg != '') {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $msg . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                redirect('member/editUser/' . $userId);
            } else {
                $upload_image = $_FILES['gambar']['name'];

                if ($upload_image != '') {
                    $config['upload_path'] = './assets/image';
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size'] = 5000;

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('gambar')) {
                        $gambarLama = $dataEditUser['gambar'];
                        if ($gambarLama != 'user.png') {
                            unlink(FCPATH . 'assets/image/' . $gambarLama);
                        }
                        $gambarBaru = $this->upload->data('file_name');
                    } else {
                        $data = ['error' => $this->upload->display_errors()];
                        $userEmail = $this->session->userdata('email');
                        //Cek Session ada atau tidak
                        if (isset($userEmail)) {
                            $data['title'] = 'Edit Profile';
                            $data['user'] = $this->M_User->getDataW('user', ['email' => $userEmail]);

                            $data['userId'] = $userId;

                            $dataEditUser = $this->M_User->getDataW('user', ['id' => $userId]);

                            $data['editUser'] = $dataEditUser;

                            $this->load->view('template/sidebar', $data);
                            $this->load->view('template/topbar');
                            $this->load->view('member/editUser', $data);
                            $this->load->view('template/footer');
                        } else {
                            redirect('user');
                        }
                    }
                } else {
                    $gambarBaru = $dataEditUser['gambar'];
                }

                $where = [
                    'id' => $userId
                ];

                $dataEdit = [
                    'gambar' => $gambarBaru,
                    'nama' => $nama,
                    'email' => $email,
                    'nik' => $nik,
                    'alamat' => $alamat,
                    'no_telp' => $no_telp
                ];

                $queryEdit = $this->M_User->editData('user', $dataEdit, $where);
                if ($queryEdit > 0) {
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Berhasil Merubah Profil!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('member');
                } else {
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Berhasil Merubah Profil!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('member');
                }
            }
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Ganti Password';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $this->session->userdata('email')]);

        $this->form_validation->set_rules('passwordlama', 'Password Baru', 'trim|required|min_length[3]');

        $this->form_validation->set_rules('passwordbaru', 'Password Baru', 'trim|required|min_length[3]');

        $this->form_validation->set_rules('konfpass', 'Konfirmasi Password Baru', 'trim|required|matches[passwordbaru]');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar');
            $this->load->view('member/changepass', $data);
            $this->load->view('template/footer');
        } else {
            $passwordlama = $this->input->post('passwordlama');
            $passwordbaru = $this->input->post('passwordbaru');

            if (!password_verify($passwordlama, $data['user']['password'])) {
                $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password lama tidak valid.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                redirect('member/changepassword');
            } else {
                if ($passwordbaru == $passwordlama) {
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password baru tidak boleh sama dengan yang sebelumnya.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('member/changepassword');
                } else {
                    $this->M_User->editData('user', ['password' => password_hash($passwordbaru, PASSWORD_DEFAULT)], ['email' => $this->session->userdata('email')]);

                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Password berhasil diganti.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('member');
                }
            }
        }
    }
}
