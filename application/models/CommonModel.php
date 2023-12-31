<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CommonModel extends CI_Model
{

    public $datetime = '';
    public function __construct()
    {
        parent::__construct();
        $this->datetime = date('Y-m-d H:i:s');
    }
    public function validatelogin($email, $password)
    {
        $enc_key = PASSWORD_ENC_KEY;
        $query = "SELECT id, name, email FROM admin WHERE email = ? AND status = 1 AND aes_decrypt(password, ?) = ?";
        $res = $this->db->query($query, ["$email", "$enc_key", "$password"]);
        if ($res->num_rows() > 0) {
            $response = ['success' => 1, 'data' => $res->row_array()];
        } else {
            $response = ['success' => 0, 'message' => 'Invalid credientials'];
        }
        return $response;
    }

    public function pdfListData()
    {
        try {
            $adminId = $_SESSION['id'];
            $query = "SELECT pdf.id, agreement_title, agreement_data, pdf.status, final_status, pdf.created_by, DATE_FORMAT(pdf.created_date, '%d, %b %Y') created_date, ad.id admin_id, IF(? = pdf.created_by, 1, 0) show_action, ad.name, (SELECT COUNT(1) FROM pdf_master_version WHERE pdf_id = pdf.id) total_versions FROM pdf_master pdf LEFT JOIN admin ad ON pdf.created_by = ad.id";
            $res = $this->db->query($query, ["$adminId"]);
            if ($res->num_rows() > 0) {
                $response = ['success' => 1, 'data' => $res->result_array()];
            } else {
                $response = ['success' => 0, 'message' => 'No list data found'];
            }
        } catch (Exception $e) {
            $response = ['success' => 0, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function pdfSaveData($title, $agreement)
    {
        try {
            $adminId = $_SESSION['id'];
            $query = "INSERT INTO pdf_master(agreement_title, agreement_data, created_by, created_date, updated_by, updated_date) VALUES(?,?,?,?,?,?)";
            $res = $this->db->query($query, ["{$title}", "{$agreement}", "$adminId", "{$this->datetime}", "$adminId", "{$this->datetime}"]);
            if ($res) {
                $response = ['success' => 1, 'message' => "Data saved"];
                $this->pdfUpdateData($title, $agreement, 'Initial Version', $this->db->insert_id());
            } else {
                $response = ['success' => 0, 'message' => 'Failed to save data'];
            }
        } catch (Exception $e) {
            $response = ['success' => 0, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function pdfUpdateData($title, $agreement, $adminComment, $pdfId)
    {
        try {
            $adminId = $_SESSION['id'];
            $query = "INSERT INTO pdf_master_version(pdf_id, agreement_title, agreement_data, admin_comment, created_by, created_date, updated_by, updated_date) VALUES(?,?,?,?,?,?,?,?)";
            $res = $this->db->query($query, [$pdfId, "{$title}", "{$agreement}", "{$adminComment}", "$adminId", "{$this->datetime}", "$adminId", "{$this->datetime}"]);
            if ($res) {
                $response = ['success' => 1, 'message' => "Data saved"];
            } else {
                $response = ['success' => 0, 'message' => 'Failed to save data'];
            }
        } catch (Exception $e) {
            $response = ['success' => 0, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function pdfListVersionData($pdfId)
    {
        try {
            $adminId = $_SESSION['id'];
            $query = "SELECT pdf.id, agreement_title, agreement_data, admin_comment, pdf.status, pdf.created_by, DATE_FORMAT(pdf.created_date, '%d, %b %Y') created_date, ad.id admin_id, IF(? = pdf.created_by, 1, 0) show_action, ad.name FROM pdf_master_version pdf LEFT JOIN admin ad ON pdf.created_by = ad.id WHERE pdf.pdf_id=?";
            $res = $this->db->query($query, [$adminId, "$pdfId"]);
            if ($res->num_rows() > 0) {
                $response = ['success' => 1, 'data' => $res->result_array()];
            } else {
                $response = ['success' => 0, 'message' => 'No list data found'];
            }
        } catch (Exception $e) {
            $response = ['success' => 0, 'message' => $e->getMessage()];
        }
        return $response;
    }

    public function pdfVersionData($pdfId)
    {
        try {
            $adminId = $_SESSION['id'];
            $query = "SELECT pdf.id, agreement_title, agreement_data, admin_comment, pdf.status, pdf.created_by, DATE_FORMAT(pdf.created_date, '%d, %b %Y') created_date, ad.id admin_id, IF(? = pdf.created_by, 1, 0) show_action, ad.name FROM pdf_master_version pdf LEFT JOIN admin ad ON pdf.created_by = ad.id WHERE pdf.pdf_id=?";
            $res = $this->db->query($query, [$adminId, "$pdfId"]);
            if ($res->num_rows() > 0) {
                $response = ['success' => 1, 'data' => $res->result_array()];
            } else {
                $response = ['success' => 0, 'message' => 'No list data found'];
            }
        } catch (Exception $e) {
            $response = ['success' => 0, 'message' => $e->getMessage()];
        }
        return $response;
    }
}
