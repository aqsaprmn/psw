<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashApi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }
    public function donatChart()
    {
        $data['barang'] = $this->db->query('SELECT tipe, count(tipe) as total FROM v_br_barang GROUP BY tipe')->result_array();

        echo json_encode($data);
    }
    public function areaChart()
    {
        $date = $_POST['date'];
        $data = explode('-', $date);

        $year = $data[0];
        $month = $data[1];

        $data['barang'] = $this->db->query('SELECT tgl_hilang, count(tipe) as total FROM v_br_barang WHERE month = ' . $month . ' and year = ' . $year . ' GROUP BY day')->result_array();

        echo json_encode($data);
    }
}
