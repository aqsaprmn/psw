<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuApi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekLogin();
        $this->load->model('M_User');
    }

    public function index()
    {
        $roleId = $this->input->post('id');

        $data['menu'] = $this->M_User->getDataWAll('user_menu', ['id !=' => 1]);

        $data['akses'] = $this->M_User->getDataWAll('user_access_menu', ['role_id' => $roleId, 'menu_id !=' => 1]);

        echo json_encode($data);
    }

    public function readMenuGo()
    {
        $this->db->where(['menu_id !=' => 1]);

        $query = "SELECT 
                        user_menu_go.id AS id_menu_go,
                        user_menu.id AS id_menu,
                        user_menu.menu,
                        user_menu_go.title,
                        user_menu_go.url,
                        user_menu_go.icon,
                        user_menu_go.is_active,
                        user_menu_go.sub_menu_active
                  FROM user_menu_go 
                  INNER JOIN user_menu 
                  ON
                  user_menu_go.menu_id = user_menu.id";

        $dataMenu['menu'] = $this->db->query($query)->result_array();

        echo json_encode($dataMenu);
    }

    public function readTitleMenuGo()
    {
        $this->db->where(['id !=' => 1]);
        $dataMenu['menu'] = $this->db->get('user_menu')->result_array();
        echo json_encode($dataMenu);
    }

    public function readSubMenuGo()
    {
        $this->db->where(['menu_id !=' => 1]);

        $query = "SELECT 
                        user_sub_menu_go.id AS id_sub_menu_go,
                        user_menu_go.id AS id_menu_go,
                        user_menu_go.title AS title_menu,
                        user_sub_menu_go.title AS title_sub_menu,
                        user_sub_menu_go.url,
                        user_sub_menu_go.icon,
                        user_sub_menu_go.is_active
                  FROM user_sub_menu_go 
                  LEFT OUTER JOIN user_menu_go 
                  ON
                  user_sub_menu_go.menu_go_id = user_menu_go.id";

        $dataMenu['menu'] = $this->db->query($query)->result_array();

        echo json_encode($dataMenu);
    }

    public function addMenuGo()
    {
        $menu_id = $this->input->post('id_menu');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $sub_menu_active = $this->input->post('sub_menu_active');

        ($is_active == "on") ? $is_active = 1 : $is_active = 0;
        ($sub_menu_active == "on") ? $sub_menu_active = 1 : $sub_menu_active = 0;

        $data = [
            'menu_id' => $menu_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,
            'sub_menu_active' => $sub_menu_active,
        ];

        $dataAvai = $this->M_User->cekDataAvai('user_menu_go', ['menu_id' => $menu_id, 'title' => $title]);

        if ($title == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama menu tidak boleh kosong!"
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama menu dengan judul menu tersebut sudah terdaftar!"
            ];
        } else {
            $aff = $this->M_User->insertData('user_menu_go', $data);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Menu Berhasil ditambahkan!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Menu Gagal ditambahkan!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function addSubMenuGo()
    {
        $menu_go_id = $this->input->post('id_menu');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        ($is_active == "on") ? $is_active = 1 : $is_active = 0;

        $data = [
            'menu_go_id' => $menu_go_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        ];

        $dataAvai = $this->M_User->cekDataAvai('user_menu_go', ['menu_id' => $menu_go_id, 'title' => $title]);

        if ($title == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama sub menu tidak boleh kosong!"
            ];
        } else if ($url == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'url',
                'text' => "Url tidak boleh kosong!"
            ];
        } else if ($icon == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'icon',
                'text' => "Icon tidak boleh kosong!"
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama sub menu dengan menu tersebut sudah terdaftar!"
            ];
        } else {
            $aff = $this->M_User->insertData('user_sub_menu_go', $data);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Sub Menu Berhasil ditambahkan!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Sub Menu Gagal ditambahkan!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function addTitleMenuGo()
    {
        $menu = $this->input->post('menu');
        $data = [
            'menu' => $menu
        ];
        $dataAvai = $this->M_User->cekDataAvai('user_menu', $data);

        if ($menu == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'menu',
                'text' => "Judul menu tidak boleh kosong!"
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'menu',
                'text' => "Judul menu sudah terdaftar!"
            ];
        } else {
            $aff = $this->M_User->insertData('user_menu', $data);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Judul Menu Berhasil ditambahkan!"
                ];
                // $this->session->set_flashdata('message',  '
                //     <div class="alert alert-success fade show" role="alert">
                //         ' . $result['msg']['text'] . '
                //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //             <span aria-hidden="true">&times;</span>
                //         </button>
                //     </div>');
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Judul Menu Gagal ditambahkan!"
                ];
                // $this->session->set_flashdata('message',  '
                //     <div class="alert alert-danger fade show" role="alert">
                //         ' . $result['msg']['text'] . '

                //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //             <span aria-hidden="true">&times;</span>
                //         </button>
                //     </div>');
            }
        }

        echo json_encode($result);
    }

    public function editMenuGo()
    {
        $id = $this->input->post('id');
        $menu_id = $this->input->post('id_menu');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');
        $sub_menu_active = $this->input->post('sub_menu_active');

        ($is_active == "on") ? $is_active = 1 : $is_active = 0;
        ($sub_menu_active == "on") ? $sub_menu_active = 1 : $sub_menu_active = 0;

        $data = [
            'menu_id' => $menu_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active,
            'sub_menu_active' => $sub_menu_active,
        ];

        $cekMenu = $this->M_User->getDataW('user_menu_go', ['id' => $id]);

        if ($title == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama menu tidak boleh kosong!"
            ];
        } else if ($title != $cekMenu['title']) {
            $cekData = $this->M_User->cekDataAvai('user_menu_go', ['title' => $title, 'menu_id' => $menu_id]);
            if ($cekData > 0) {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'input',
                    'nama' => 'title',
                    'text' => "Nama menu dengan judul menu tersebut sudah terdaftar!"
                ];
            } else {
                $aff = $this->M_User->editData('user_menu_go', $data, ['id' => $id]);
                if ($aff > 0) {
                    $result['msg'] = [
                        'status' => true,
                        'tipe' => 'message',
                        'nama' => '',
                        'text' => "Menu Berhasil diedit!"
                    ];
                } else {
                    $result['msg'] = [
                        'status' => false,
                        'tipe' => 'message',
                        'nama' => '',
                        'text' => "Menu Gagal diedit!"
                    ];
                }
            }
        } else {
            $aff = $this->M_User->editData('user_menu_go', $data, ['id' => $id]);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Menu Berhasil diedit!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Menu Gagal diedit!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function editSubMenuGo()
    {
        $id = $this->input->post('id');
        $menu_go_id = $this->input->post('id_menu');
        $title = $this->input->post('title');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active = $this->input->post('is_active');

        ($is_active == "on") ? $is_active = 1 : $is_active = 0;

        $data = [
            'menu_go_id' => $menu_go_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $is_active
        ];

        $cekMenu = $this->M_User->getDataW('user_sub_menu_go', ['id' => $id]);

        if ($title == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'title',
                'text' => "Nama sub menu tidak boleh kosong!"
            ];
        } else if ($url == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'url',
                'text' => "Url tidak boleh kosong!"
            ];
        } else if ($icon == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'icon',
                'text' => "Icon tidak boleh kosong!"
            ];
        } else if ($title != $cekMenu['title']) {
            $cekData = $this->M_User->cekDataAvai('user_sub_menu_go', ['title' => $title, 'menu_go_id' => $menu_go_id]);
            if ($cekData > 0) {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'input',
                    'nama' => 'title',
                    'text' => "Nama sub menu dengan judul menu tersebut sudah terdaftar!"
                ];
            } else {
                $aff = $this->M_User->editData('user_sub_menu_go', $data, ['id' => $id]);
                if ($aff > 0) {
                    $result['msg'] = [
                        'status' => true,
                        'tipe' => 'message',
                        'nama' => '',
                        'text' => "Sub menu Berhasil diedit!"
                    ];
                } else {
                    $result['msg'] = [
                        'status' => false,
                        'tipe' => 'message',
                        'nama' => '',
                        'text' => "Sub menu Gagal diedit!"
                    ];
                }
            }
        } else {
            $aff = $this->M_User->editData('user_sub_menu_go', $data, ['id' => $id]);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Sub menu Berhasil diedit!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Sub menu Gagal diedit!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function editTitleMenuGo()
    {
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $data = [
            'menu' => $menu
        ];

        $cekMenu = $this->M_User->getDataW('user_menu', ['id' => $id]);

        $dataAvai = $this->M_User->cekDataAvai('user_menu', $data);

        if ($menu == "") {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'menu',
                'text' => "Judul menu tidak boleh kosong!"
            ];
        } else if ($menu == $cekMenu['menu']) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'menu',
                'text' => "Silahkan ubah judul menu."
            ];
        } else if ($dataAvai > 0) {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'input',
                'nama' => 'menu',
                'text' => "Judul menu sudah ada!"
            ];
        } else {
            $aff = $this->M_User->editData('user_menu', $data, ['id' => $id]);
            if ($aff > 0) {
                $result['msg'] = [
                    'status' => true,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Judul Menu Berhasil diedit!"
                ];
            } else {
                $result['msg'] = [
                    'status' => false,
                    'tipe' => 'message',
                    'nama' => '',
                    'text' => "Judul Menu Gagal diedit!"
                ];
            }
        }

        echo json_encode($result);
    }

    public function deleteMenuGo()
    {
        $id = $this->input->post('id');

        $deleteMenu = $this->M_User->deletetData('user_menu_go', ['id' => $id]);

        if ($deleteMenu > 0) {
            $result['msg'] = [
                'status' => true,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Menu berhasil dihapus!"
            ];
        } else {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Menu gagal dihapus!"
            ];
        }

        echo json_encode($result);
    }

    public function deleteSubMenuGo()
    {
        $id = $this->input->post('id');

        $deleteMenu = $this->M_User->deletetData('user_sub_menu_go', ['id' => $id]);

        if ($deleteMenu > 0) {
            $result['msg'] = [
                'status' => true,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Sub Menu berhasil dihapus!"
            ];
        } else {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Sub Menu gagal dihapus!"
            ];
        }

        echo json_encode($result);
    }

    public function deleteTitleMenuGo()
    {
        $id = $this->input->post('id');

        $deleteMenu = $this->M_User->deletetData('user_menu', ['id' => $id]);

        if ($deleteMenu > 0) {
            $result['msg'] = [
                'status' => true,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Judul Menu berhasil dihapus!"
            ];
            // $this->session->set_flashdata('message',  '
            //         <div class="alert alert-success fade show" role="alert">
            //             ' . $result['msg']['text'] . '
            //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //                 <span aria-hidden="true">&times;</span>
            //             </button>
            //         </div>');
        } else {
            $result['msg'] = [
                'status' => false,
                'tipe' => 'message',
                'nama' => '',
                'text' => "Judul Menu gagal dihapus!"
            ];
            // $this->session->set_flashdata('message',  '
            //         <div class="alert alert-danger fade show" role="alert">
            //             ' . $result['msg']['text'] . '
            //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //                 <span aria-hidden="true">&times;</span>
            //             </button>
            //         </div>');
        }

        echo json_encode($result);
    }

    public function readIdMenu()
    {
        $id = $this->input->post('id');

        $data['menu'] = $this->M_User->getDataW('user_menu', ['id' => $id]);

        echo json_encode($data);
    }

    public function readIdMenuGo()
    {
        $id = $this->input->post('id');

        $data['menu'] = $this->M_User->getDataW('user_menu_go', ['id' => $id]);

        echo json_encode($data);
    }

    public function readIdSubMenuGo()
    {
        $id = $this->input->post('id');

        $data['menu'] = $this->M_User->getDataW('user_sub_menu_go', ['id' => $id]);

        echo json_encode($data);
    }
}
