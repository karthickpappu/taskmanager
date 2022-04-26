<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Suppliercount {

    public function __construct() {
        $this->CI = & get_instance();
        // $this->CI->InstituteModel->get_user_name($dec_user_id);
        $this->CI->load->model('supplier/SupplierEnquiryResponseModel', 'SupplierEnquiryResponseModel', TRUE);
        $this->CI->load->model('supplier/ServiceEnquiryResponseModel', 'ServiceEnquiryResponseModel', TRUE);
        $this->CI->load->model('supplier/SupplierOrdersListModel', 'SupplierOrdersListModel', TRUE);
        $this->CI->load->model('supplier/ServiceOrdersListModel', 'ServiceOrdersListModel', TRUE);
    }

    public function get_enquiry_count($role_id, $user_data) {

        $equi_count = '';
        $supplier_id = $user_data['supplier_id'];
        $branch_id = $user_data['branch_id'];
        if ($role_id == '41') {
            if ($user_data['user_entity'] == 'SA' || $user_data['user_entity'] == 'SE') {
                $equi_count = $this->CI->SupplierEnquiryResponseModel->get_count_for_enqui_list_supp($supplier_id);
            } elseif ($user_data['user_entity'] == 'BA' || $user_data['user_entity'] == 'BE') {
                $equi_count = $this->CI->SupplierEnquiryResponseModel->get_count_for_enqui_list($branch_id);
            }
        }
        if ($role_id == '42') {
            if ($user_data['user_entity'] == 'SA' || $user_data['user_entity'] == 'SE') {
                $equi_count = $this->CI->ServiceEnquiryResponseModel->get_count_for_enqui_list_for_supplier_admin($supplier_id);
            } elseif ($user_data['user_entity'] == 'BA' || $user_data['user_entity'] == 'BE') {
                $equi_count = $this->CI->ServiceEnquiryResponseModel->get_count_for_enqui_list_for_branch_admin($branch_id);
            }
        }
        return $equi_count;
    }

    public function get_order_count($role_id, $user_data) {

        $order_count = '';
        $supplier_id = $user_data['supplier_id'];
        $branch_id = $user_data['branch_id'];
        if ($role_id == '41') {
            if ($user_data['user_entity'] == 'SA' || $user_data['user_entity'] == 'SE') {
                $rele_status = $this->CI->SupplierOrdersListModel->get_count_for_relea_status($branch_id = NULL, $supplier_id);
                $reje_status = $this->CI->SupplierOrdersListModel->get_count_for_reje_status($branch_id = NULL, $supplier_id);
                $pay_pen_status = $this->CI->SupplierOrdersListModel->get_count_for_pay_pend_status($branch_id = NULL, $supplier_id);
                $off_status = $this->CI->SupplierOrdersListModel->get_count_for_offl_status($branch_id = NULL, $supplier_id);
                $appr_offl_status = $this->CI->SupplierOrdersListModel->get_count_for_appr_offl_status($branch_id = NULL, $supplier_id);
                $pay_done_status = $this->CI->SupplierOrdersListModel->get_count_for_pay_done_status($branch_id = NULL, $supplier_id);
                $canl_status = $this->CI->SupplierOrdersListModel->get_count_for_can_status($branch_id = NULL, $supplier_id);
                $sum = array($rele_status, $reje_status, $pay_pen_status, $off_status, $appr_offl_status, $pay_done_status, $canl_status);

                $sum1 = array_sum($sum);
                $order_count = array('rele_status' => $rele_status,
                    'reje_status' => $reje_status,
                    'pay_pen_status' => $pay_pen_status,
                    'off_status' => $off_status,
                    'appr_offl_status' => $appr_offl_status,
                    'pay_done_status' => $pay_done_status,
                    'canl_status' => $canl_status,
                    'sum1' => $sum1
                );
            }
            if ($user_data['user_entity'] == 'BA' || $user_data['user_entity'] == 'BE') {
                $rele_status = $this->CI->SupplierOrdersListModel->get_count_for_relea_status($branch_id, $supplier_id);
                $reje_status = $this->CI->SupplierOrdersListModel->get_count_for_reje_status($branch_id, $supplier_id);
                $pay_pen_status = $this->CI->SupplierOrdersListModel->get_count_for_pay_pend_status($branch_id, $supplier_id);
                $off_status = $this->CI->SupplierOrdersListModel->get_count_for_offl_status($branch_id, $supplier_id);
                $appr_offl_status = $this->CI->SupplierOrdersListModel->get_count_for_appr_offl_status($branch_id, $supplier_id);
                $pay_done_status = $this->CI->SupplierOrdersListModel->get_count_for_pay_done_status($branch_id, $supplier_id);
                $canl_status = $this->CI->SupplierOrdersListModel->get_count_for_can_status($branch_id, $supplier_id);
                $sum = array($rele_status, $reje_status, $pay_pen_status, $off_status, $appr_offl_status, $pay_done_status, $canl_status);

                $sum1 = array_sum($sum);
                $order_count = array('rele_status' => $rele_status,
                    'reje_status' => $reje_status,
                    'pay_pen_status' => $pay_pen_status,
                    'off_status' => $off_status,
                    'appr_offl_status' => $appr_offl_status,
                    'pay_done_status' => $pay_done_status,
                    'canl_status' => $canl_status,
                    'sum1' => $sum1
                );
            }
        }
        if ($role_id == '42') {
            if ($user_data['user_entity'] == 'SA' || $user_data['user_entity'] == 'SE') {
                $rele_status = $this->CI->ServiceOrdersListModel->get_count_for_relea_status($branch_id = NULL, $supplier_id);
                $reje_status = $this->CI->ServiceOrdersListModel->get_count_for_reje_status($branch_id = NULL, $supplier_id);
                $pay_pen_status = $this->CI->ServiceOrdersListModel->get_count_for_pay_pend_status($branch_id = NULL, $supplier_id);
                $off_status = $this->CI->ServiceOrdersListModel->get_count_for_offl_status($branch_id = NULL, $supplier_id);
                $appr_offl_status = $this->CI->ServiceOrdersListModel->get_count_for_appr_offl_status($branch_id = NULL, $supplier_id);
                $pay_done_status = $this->CI->ServiceOrdersListModel->get_count_for_pay_done_status($branch_id = NULL, $supplier_id);
                $canl_status = $this->CI->ServiceOrdersListModel->get_count_for_can_status($branch_id = NULL, $supplier_id);
                $sum = array($rele_status['count'], $reje_status['count'], $pay_pen_status['count'], $off_status['count'], $appr_offl_status['count'], $pay_done_status['count'], $canl_status['count']);
                $sum1 = array_sum($sum);
                $order_count = array('rele_status' => $rele_status,
                    'reje_status' => $reje_status,
                    'pay_pen_status' => $pay_pen_status,
                    'off_status' => $off_status,
                    'appr_offl_status' => $appr_offl_status,
                    'pay_done_status' => $pay_done_status,
                    'canl_status' => $canl_status,
                    'sum1' => $sum1
                );
            }
            if ($user_data['user_entity'] == 'BA' || $user_data['user_entity'] == 'BE') {
                $rele_status = $this->CI->ServiceOrdersListModel->get_count_for_relea_status($branch_id, $supplier_id);
                $reje_status = $this->CI->ServiceOrdersListModel->get_count_for_reje_status($branch_id, $supplier_id);
                $pay_pen_status = $this->CI->ServiceOrdersListModel->get_count_for_pay_pend_status($branch_id, $supplier_id);
                $off_status = $this->CI->ServiceOrdersListModel->get_count_for_offl_status($branch_id, $supplier_id);
                $appr_offl_status = $this->CI->ServiceOrdersListModel->get_count_for_appr_offl_status($branch_id, $supplier_id);
                $pay_done_status = $this->CI->ServiceOrdersListModel->get_count_for_pay_done_status($branch_id, $supplier_id);
                $canl_status = $this->CI->ServiceOrdersListModel->get_count_for_can_status($branch_id, $supplier_id);
                $sum = array($rele_status['count'], $reje_status['count'], $pay_pen_status['count'], $off_status['count'], $appr_offl_status['count'], $pay_done_status['count'], $canl_status['count']);
                $sum1 = array_sum($sum);
                $order_count = array('rele_status' => $rele_status,
                    'reje_status' => $reje_status,
                    'pay_pen_status' => $pay_pen_status,
                    'off_status' => $off_status,
                    'appr_offl_status' => $appr_offl_status,
                    'pay_done_status' => $pay_done_status,
                    'canl_status' => $canl_status,
                    'sum1' => $sum1
                );
            }
        }
        return $order_count;
    }

}

?>
