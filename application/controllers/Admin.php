    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    /**
     * Class Admin
     */
    class Admin extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            is_logged_in();
            $this->load->model('Admin_model', 'am');
            $this->load->model('History_model', 'hm');
        }

        public function index($id=null)
        {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->am->getuser();
            $data['asesor'] = $this->am->getAsesor();
            $data['tahun'] = $this->am->getTahun();
            $data['validasi'] = $this->am->getValidasi();
            $data['hasilvalidasi'] = $this->am->getHasilValidasi();



            $sessionid = $this->session->userdata('id');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer',$data);
        }

        public function role()
        {
            $data['title'] = 'Role';
            $data['user'] = $this->am->getuser();

            $data['role'] = $this->db->get('user_role')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        }

        public function roleAccess($role_id)
        {
            $data['title'] = 'Role Access';
            $data['user'] = $this->am->getuser();
            $data['role'] = $this->db->get_where('user_role',['id' => $role_id])->row_array();

            $this->db->where('id !=',  1);
            $data['menu'] = $this->db->get('user_menu')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/roleaccess', $data);
            $this->load->view('templates/footer');
        }

        public function changeaccess()
        {
            $menu_id = $this->input->post('menuId');
            $role_id = $this->input->post('roleId');

            $data = array(
                'role_id' => $role_id,
                'menu_id' => $menu_id
            );

            $result = $this->db->get_where('user_access_menu', $data);

            if ($result->num_rows() < 1) {
                $this->db->insert('user_access_menu', $data);

            }else{
                $this->db->delete('user_access_menu', $data);

            }

            $this->session->set_flashdata('message',
                '<div class="alert alert-success" role="alert">
                       Access Change !!!
                 </div>');
        }




    }

