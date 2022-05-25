<?php

function cekLogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('user');
    } else {
        $menuGo = $ci->uri->segment(1);

        $dataMenu = $ci->db->get_where('user_menu', ['menu' => $menuGo])->num_rows();

        if ($dataMenu > 0) {
            $menu = $ci->db->get_where('user_menu', ['menu' => $menuGo])->row_array();
            $cekAkses = $ci->db->get_where('user_access_menu', [
                'role_id' => $ci->session->userdata('role_id'),
                'menu_id' => $menu['id']
            ]);

            if ($cekAkses->num_rows() < 1) {
                redirect('user/aksesblok');
            }
        }
    }
}
