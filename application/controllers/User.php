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
        $this->load->view('login');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => 'Email is Required!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password is Required!'
        ]);

        $email = htmlspecialchars($this->input->post('email', true));
        $password = htmlspecialchars($this->input->post('password', true));

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            // Tarik Data User
            $userLogin = $this->M_User->getDataW('user', ['email' => $email]);
            // Cek Email
            if ($userLogin != null) {
                //Cek Password
                if (password_verify($password, $userLogin['password'])) {
                    $this->session->set_userdata('userEmail', $userLogin['email']);
                    redirect('content');
                } else {
                    $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password is Wrong!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                    redirect(base_url());
                }
            } else {
                $this->session->set_flashdata('message',  '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Email is not Register!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>');
                redirect(base_url());
            }
        }
    }

    public function register()
    {
        $this->load->view('register');
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
            'is_unique' => 'Email Already Registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|max_length[30]', [
            'required' => 'Password is Required!',
            'min_length' => 'Password Min 3 Characters',
            'max_length' => 'Password Max 30 Characters'
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
            'is_active' => 1,
            'date' => time()
        ];

        if ($this->form_validation->run() == false) {
            $this->load->view('register');
        } else {
            $affect = $this->M_User->registration('user', $data);
            if ($affect > 0) {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your Registration Account is Successful.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata('message',  '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Your Registration Account is Failed.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
                $this->load->view('register');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userEmail');
        redirect('user');
    }
}
