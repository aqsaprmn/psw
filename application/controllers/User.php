<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('M_User');
    }

    public function index()
    {
        $data['script'] = "<script src=' " . base_url('assets') . "/js/login.js'></script>";
        $data['title'] = "Login";
        $this->load->view('header_front', $data);
        $this->load->view('login');
        $this->load->view('footer_front', $data);
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email is Required!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password is Required!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['script'] = "<script src=' " . base_url('assets') . "/js/login.js'></script>";
            $data['title'] = "Login";
            $this->load->view('header_front', $data);
            $this->load->view('login');
            $this->load->view('footer_front', $data);
        } else {
            $this->go();
        }
    }

    private function go()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));
        // Tarik Data User
        $userLogin = $this->M_User->getDataW('user', ['email' => $email]);
        // Cek Email
        if ($userLogin) {
            //Cek Password
            if (password_verify($password, $userLogin['password'])) {
                if ($userLogin['is_active'] == 1) {
                    $userData = [
                        'email' => $userLogin['email'],
                        'role_id' => $userLogin['role_id']
                    ];
                    $this->session->set_userdata($userData);
                    if ($userLogin['role_id'] == 1) {
                        redirect(base_url('admin'));
                    } else {
                        redirect(base_url('member'));
                    }
                } else {
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Akun belum diaktifasi.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect(base_url());
            }
        } else {
            $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email tidak terdaftar!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect(base_url());
        }
    }

    public function register()
    {
        $data['script'] = "<script src=' " . base_url('assets') . "/js/login.js'></script>";
        $data['title'] = "Pendaftaran";
        $this->load->view('header_front', $data);
        $this->load->view('register');
        $this->load->view('footer_front', $data);
    }

    public function registration()
    {
        $nama = htmlspecialchars($this->input->post('name', true));
        $email = htmlspecialchars($this->input->post('email', true));
        $password1 = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim', [
            'required' => 'Name is Required!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required' => 'Email is Required!',
            'is_unique' => 'Email Already Registered!',
            'valid_email' => 'Email is Not Valid!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]', [
            'required' => 'Password is Required!',
            'min_length' => 'Password Min 3 Characters'
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]', [
            'required' => 'Repeat Password is Required!',
            'matches' => 'Password Doesn\'t Match'
        ]);

        $data = [
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password1, PASSWORD_DEFAULT),
            'gambar' => 'user.png',
            'role_id' => 2,
            'is_active' => 0,
            'date' => time()
        ];

        $token = base64_encode(random_bytes(32));

        $user_token = [
            'email' => $email,
            'token' => $token,
            'date' => time()
        ];

        if ($this->form_validation->run() == false) {
            $data['script'] = "<script src=' " . base_url('assets') . "/js/login.js'></script>";
            $data['title'] = "Pendaftaran";
            $this->load->view('header_front', $data);
            $this->load->view('register');
            $this->load->view('footer_front', $data);
        } else {
            $affect = $this->M_User->registration('user', $data);
            $token_ins = $this->M_User->insertData('user_token', $user_token);

            if ($affect > 0 && $token_ins > 0) {
                $this->sendMail($token, 'aktifasi');
                $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pendaftaran akun sukses. Silahkan aktifasi akun melalui email sebelum 24 jam!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                redirect('user');
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your Registration Account is Failed.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/register');
            }
        }
    }

    private function sendMail($token, $hal)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.google.com',
            'smtp_user' => 'aqshaprogramming@gmail.com',
            'smtp_pass' => 'aqsha2310',
            'smtp_port' => 465,
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_mailtype("html");
        $this->email->from('aqshaprogramming@gmail.com', 'Aqsha Programming');
        $this->email->to($this->input->post('email'));

        if ($hal == 'aktifasi') {

            $body = 'Klik link berikut ini untuk mengaktifkan akun anda : <a href="' . base_url() . 'user/aktifasi?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Aktifasi</a>';

            $this->email->subject('Aktifasi Akun Aplikasi Barang Hilang');
            $this->email->message($body);

            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        } else if ('reset') {
            $body = 'Klik link berikut ini untuk reset password akun anda : <a href="' . base_url() . 'user/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>';

            $this->email->subject('Reset Password Akun Aplikasi Barang Hilang');
            $this->email->message($body);

            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        } else {
            redirect('user/register');
        }
    }

    public function aktifasi()
    {
        $email = htmlspecialchars($this->input->get('email'));
        $token = $this->input->get('token');

        $user = $this->M_User->getDataW('user', ['email' => $email]);

        if ($user) {
            $user_token  = $this->M_User->getDataW('user_token', ['email' => $email, 'token' => $token]);

            if ($user_token) {
                if (time() - $user_token['date'] <= (60 * 60 * 24)) {
                    $this->M_User->deletetData('user_token', ['email' => $email, 'token' => $token]);

                    $this->M_User->editData('user', ['is_active' => 1], ['email' => $email]);

                    $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ' . $email . ' berhasil diaktifasi. Silahkan login.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('user');
                } else {
                    $this->M_User->deletetData('user_token', ['email' => $email, 'token' => $token]);

                    $this->M_User->deletetData('user', ['email' => $email]);

                    $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Aktifasi 
                    ' . $email . ' lebih dari 24 jam. Silahkan daftar ulang.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('user/register');
                }
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal aktivasi akun.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/register');
            }
        } else {
            $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email salah atau tidak terdaftar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('user/register');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email harus diisi!',
            'valid_email' => 'Email tidak valid!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Lupa Password";
            $this->load->view('header_front');
            $this->load->view('forgot_password');
            $this->load->view('footer_front');
        } else {
            $email = $this->input->post('email');

            $user = $this->M_User->getDataW('user', ['email' => $email]);

            if ($user) {
                if ($user['is_active'] == 1) {
                    $token = base64_encode(random_bytes(32));

                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'date' => time()
                    ];

                    $token_ins = $this->M_User->insertData('user_token', $user_token);

                    if ($token_ins > 0) {
                        $this->sendMail($token, 'reset');
                        $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Reset Password sukses. Silahkan kunjungi email anda sebelum 24 jam!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');

                        redirect('user');
                    } else {
                        $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Reset Password Gagal
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                        redirect('user/forgotpassword');
                    }
                } else {
                    $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ' . $email . ' belum diaktifasi.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                    redirect('user/forgotpassword');
                }
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email salah atau tidak terdaftar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->M_User->getDataW('user', ['email' => $email]);

        if ($user) {
            $user_token  = $this->M_User->getDataW('user_token', ['email' => $email, 'token' => $token]);

            if ($user_token) {
                $this->session->set_userdata(['reset_passmail' => $email, 'reset_token' => $token]);
                $this->gantiPassword($token);
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Gagal aktivasi akun. Token tidak valid!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/register');
            }
        } else {
            $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email salah atau tidak terdaftar.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('user/register');
        }
    }

    public function gantiPassword()
    {
        if (!$this->session->userdata('reset_passmail') || !$this->session->userdata('reset_token')) {
            redirect('user');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|matches[password2]|min_length[3]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['script'] = "<script src=' " . base_url('assets') . "/js/login.js'></script>";
            $data['title'] = "Reset Password";
            $this->load->view('header_front', $data);
            $this->load->view('reset_password');
            $this->load->view('footer_front', $data);
        } else {
            $tokenDel = $this->M_User->deletetData('user_token', ['email' => $this->session->userdata('reset_passmail'), 'token' => $this->session->userdata('reset_token')]);

            if ($tokenDel > 0) {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $userUpd = $this->M_User->editData('user', ['password' => $password], ['email' => $this->session->userdata('reset_passmail')]);
                if ($userUpd > 0) {
                    $this->session->unset_userdata(['reset_passmail', 'reset_token']);
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Reset Password berhasil. Silahkan login!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('user');
                } else {
                    $this->session->unset_userdata(['reset_passmail', 'reset_token']);
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Reset Password Gagal, Email tidak valid. Silahkan reset password ulang!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect('user/forgotpassword');
                }
            } else {
                $this->session->unset_userdata(['reset_passmail', 'reset_token']);
                $this->session->set_flashdata('message',  '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Reset Password gagal, Token tidak valid. Silahkan reset password ulang!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect('user/forgotpassword');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Anda telah keluar!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
        redirect('user');
    }

    public function aksesblok()
    {
        $userEmail = $this->session->userdata('email');
        $data['title'] = 'Akses - Blok';
        $data['user'] = $this->M_User->getDataW('user', ['email' => $userEmail]);

        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar');
        $this->load->view('block', $data);
        $this->load->view('template/footer', $data);
    }
}
