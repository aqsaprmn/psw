<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }
}
