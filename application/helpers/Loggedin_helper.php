<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1); //controller mana yang mau di ambil/url mana
        // pengaturanpresensi

        if ($menu == 'pengaturan') {
            $menu = 'settingadmin';
        }
        //cocokkan dengan tabel user menu dengan user access menu
        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);

        //admin kenapa ke block?
        if ($userAccess->num_rows() < 1) {
            redirect('error/block');
        }
    }
}
