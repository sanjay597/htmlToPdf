<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public $errorResponse = [];

    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            $this->load->view('login');
            return;
            // header('Location'. base_url('login'));
        }
        $this->errorResponse = [
            'success' => 0,
            'message' => '',
        ];
    }

    public function index()
    {
        
    }

    public function login()
    {
        if (!$this->input->is_ajax_request()) {
            $this->errorResponse['message'] = 'Invalid request';
            echo json_encode($this->errorResponse);
            exit();
        }

        if (empty($this->input->post('email'))) {
            echo json_encode(['success' => 0, 'message' => 'Email can\'t be empty']);
            exit();
        }
        if (empty($this->input->post('password'))) {
            echo json_encode(['success' => 0, 'message' => 'Password can\'t be empty']);
            exit();
        }
        //validate login
        $this->load->model('CommonModel', 'common');
        $validate_login = $this->common->validatelogin($this->input->post('email'), $this->input->post('password'));
        if ($validate_login['success'] == 0) {
            echo json_encode($validate_login);
            exit();
        }
        $_SESSION['id'] = $validate_login['data']['id'];
        $_SESSION['name'] = $validate_login['data']['name'];
        $validate_login['data']['dashboard_page'] = 'admin/dashboard';
        echo json_encode($validate_login);
        exit();
    }
}
