<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public $errorResponse = [];

    public function __construct()
    {
        parent::__construct();

        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            // $this->load->view('login');
            header('Location:' . base_url());
        }

        $this->errorResponse = [
            'success' => 0,
            'message' => '',
        ];
    }

    public function index()
    {

    }

    public function dashboard()
    {
        $this->load->view('dashboard');
    }

    public function pdfList()
    {
        $this->load->view('pdfList');
    }

    public function pdfListData()
    {
        $this->load->model('CommonModel', 'common');
        $res = $this->common->pdfListData();
        echo json_encode($res);
    }

    public function saveData()
    {
        if ($this->input->is_ajax_request()) {
            $title = $this->input->post('agreement_title');
            $agreement = $this->input->post('agreement');
            $this->load->model('CommonModel', 'common');
            $res = $this->common->pdfSaveData($title, $agreement);
            echo json_encode($res);
        }
    }

    public function updatePdfStatus()
    {
        if ($this->input->is_ajax_request()) {
            $status = $this->input->post('status');
            $id = $this->input->post('id');
            try {
                $res = $this->db->set('status', $status)->where('id', $id)->update('pdf_master');
                if ($res) {
                    $response = ['success' => 1, 'message' => 'Status updated'];
                } else {
                    $response = ['success' => 0, 'message' => 'Failed to update data'];
                }
            } catch (Exception $e) {
                $response = ['success' => 0, 'message' => $e->getMessage()];
            }
            echo json_encode($response);
        }
    }

    public function updatePdfFinalStatus()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            try {
                $res = $this->db->set('final_status', 1)->where('id', $id)->update('pdf_master');
                if ($res) {
                    $response = ['success' => 1, 'message' => 'Final Status updated'];
                } else {
                    $response = ['success' => 0, 'message' => 'Failed to update data'];
                }
            } catch (Exception $e) {
                $response = ['success' => 0, 'message' => $e->getMessage()];
            }
            echo json_encode($response);
        }
    }

    public function viewPdf($id)
    {
        $this->load->view('viewPdf', ['pdfId' => $id]);
    }

    public function pdfData()
    {
        if ($this->input->is_ajax_request()) {
            $pdfId = $this->input->post('pdfId');
            try {
                $res = $this->db->from('pdf_master')->where('id', $pdfId)->get()->row_array();
                if ($res) {
                    $response = ['success' => 1, 'data' => $res];
                } else {
                    $response = ['success' => 0, 'message' => 'No data found'];
                }
            } catch (Exception $e) {
                $response = ['success' => 0, 'message' => $e->getMessage()];
            }
            echo json_encode($response);
        }
    }

    public function updateData()
    {
        if ($this->input->is_ajax_request()) {
            $title = $this->input->post('agreement_title');
            $agreement = $this->input->post('agreement');
            $adminComment = $this->input->post('admin_comment');
            $pdfId = $this->input->post('pdfId');
            $this->load->model('CommonModel', 'common');
            $res = $this->common->pdfUpdateData($title, $agreement, $adminComment, $pdfId);
            echo json_encode($res);
        }
    }

    public function pdfVersionList($pdfId)
    {
        $this->load->view('pdfVersionList', ['pdfId' => $pdfId]);
    }

    public function pdfListVersionData()
    {
        if ($this->input->is_ajax_request()) {
            $pdfId = $this->input->post('pdfId');
            $this->load->model('CommonModel', 'common');
            $res = $this->common->pdfListVersionData($pdfId);
            echo json_encode($res);
        }
    }

    public function viewPdfVersion($pdfId)
    {
        $this->load->view('viewPdfVersion', ['pdfId' => $pdfId]);
    }

    public function pdfVersionData()
    {
        if ($this->input->is_ajax_request()) {
            $pdfId = $this->input->post('pdfId');
            try {
                $res = $this->db->from('pdf_master_version')->where('id', $pdfId)->get()->row_array();
                if ($res) {
                    $response = ['success' => 1, 'data' => $res];
                } else {
                    $response = ['success' => 0, 'message' => 'No data found'];
                }
            } catch (Exception $e) {
                $response = ['success' => 0, 'message' => $e->getMessage()];
            }
            echo json_encode($response);
        }
    }

    public function updateMainPdf()
    {
        if ($this->input->is_ajax_request()) {
            $pdfId = $this->input->post('pdfId');
            $adminId = $_SESSION['id'];
            try {
                $res = $this->db->from('pdf_master_version')->where('id', $pdfId)->get()->row_array();
                if ($res) {
                    $final_status = $this->db->select('final_status')->from('pdf_master')->where('id', $res['pdf_id'])->get()->row_array();
                    if($final_status['final_status'] == 1) {
                        ['success' => 0, 'message' => 'Failed to update data'];
                        echo json_encode($this->errorResponse);
                        exit();
                    }
                    $this->db->set(['agreement_title' => $res['agreement_title'], 'agreement_data' => $res['agreement_data'], 'updated_by' => $adminId, 'updated_date' => date('Y-m-d H:i:s')])->where('id', $res['pdf_id'])->update('pdf_master');
                    $response = ['success' => 1, 'message' => 'Version data copied into main pdf agreement', 'pdfId' => $res['pdf_id']];
                } else {
                    $response = ['success' => 0, 'message' => 'No data found'];
                }
            } catch (Exception $e) {
                $response = ['success' => 0, 'message' => $e->getMessage()];
            }
            echo json_encode($response);
        }
    }
}
