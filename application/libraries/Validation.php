<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Validation {

    public function __construct() {
        $this->CI = & get_instance();
        $this->msg = "";
        $this->token = "";
    }

    public function user_in() {
        $is_logged = false;
        $this->user_data = $this->CI->session->userdata('user_data');
        if ($this->user_data) {
            if (isset($this->user_data['user_id']) and isset($this->user_data['user_name'])) {
                $is_logged = true;
            }
        }
        return $is_logged;
    }

    public function is_super_admin() {
        $is_super_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "IS") {
                    $is_super_admin = true;
                }
            }
        }
        return $is_super_admin;
    }

    public function is_institute_admin() {
        $is_institute_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "IN") {
                    $is_institute_admin = true;
                }
            }
        }
        return $is_institute_admin;
    }

    public function is_department_admin() {
        $is_department_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "DP") {
                    $is_department_admin = true;
                }
            }
        }
        return $is_department_admin;
    }

    public function is_funding_agency_admin() {
        $is_department_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "FA") {
                    $is_department_admin = true;
                }
            }
        }
        return $is_department_admin;
    }

    public function is_faculty_incharge_admin() {
        $is_faculty_incharge_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "FI") {
                    $is_faculty_incharge_admin = true;
                }
            }
        }
        return $is_faculty_incharge_admin;
    }

    public function is_facility_user() {
        $is_facility_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "FC") {
                    $is_facility_user = true;
                }
            }
        }
        return $is_facility_user;
    }

    public function is_subnodal_admin() {
        $is_subnodal_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "SB") {
                    $is_subnodal_admin = true;
                }
            }
        }
        return $is_subnodal_admin;
    }

    public function is_regional_admin() {
        $is_regional_admin = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "ND") {
                    $is_regional_admin = true;
                }
            }
        }
        return $is_regional_admin;
    }

    public function is_public_user() {
        $is_public_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "PU") {
                    $is_public_user = true;
                }
            }
        }
        return $is_public_user;
    }

    public function is_institute_user() {
        $is_institute_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if (($this->user_data['user_entity'] == "IN") || ($this->user_data['user_entity'] == "DP") || ($this->user_data['user_entity'] == "FC") || ($this->user_data['user_entity'] == "FI") || ($this->user_data['user_entity'] == "OP")) {
                    $is_institute_user = true;
                }
            }
        }
        return $is_institute_user;
    }

    public function gen_token($values = null) {

        $token_string = "";
        //if(!$this->is_logged_in())
        //{
        //   $this->msg = "Invalid login session";
        //  return false;
        //}
        // else 
        //{
        if ($values) {
            if (is_array($values)) {
                foreach ($values as $val) {
                    $token_string = $token_string . $val;
                }
            }
        }


        $user_data = $this->CI->session->userdata('user_data');
        $token_string = $token_string;
        $token_string = md5($token_string);
        // $this->token = password_hash($token_string, PASSWORD_BCRYPT);
        $this->token = $token_string;
        return $this->token;
        // }
    }

    public function ionic_gen_token($values = null) {

        $token_string = "";
        //if(!$this->is_logged_in())
        //{
        //   $this->msg = "Invalid login session";
        //  return false;
        //}
        // else 
        //{
        if ($values) {
            if (is_array($values)) {
                foreach ($values as $val) {
                    $token_string = $token_string . $val;
                }
            }
        }



        $token_string = $token_string;
        $token_string = md5($token_string);
        // $this->token = password_hash($token_string, PASSWORD_BCRYPT);
        $this->token = $token_string;
        return $this->token;
        // }
    }

    public function verify_token($token = null, $values = null) {
        $token_string = "";

        if ($values && $token) {
            if (is_array($values)) {
                foreach ($values as $val) {
                    $token_string = $token_string . $val;
                }
            }
        }
        $user_data = $this->CI->session->userdata('user_data');
        $token_string = $token_string;
        $token_string = md5($token_string);
        if ($token == $token_string)
            return true;
        else
            return false;
    }

    public function get_key() {
        $key = '';
        $user_data = $this->session->userdata('user_data');
        if ($user_data) {
            $key = $code . $user_data['user_name'];
            $key = $code . $user_data['login_time'];
            $key = md5($key);
        }
        return $key;
    }

    public function is_supplier_admin() {
        $is_supplier_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "SA") {
                    $is_supplier_user = true;
                }
            }
        }
        return $is_supplier_user;
    }

    public function is_supplier_executive() {
        $is_supplier_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "SE") {
                    $is_supplier_user = true;
                }
            }
        }
        return $is_supplier_user;
    }

    public function is_branch_admin() {
        $is_supplier_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "BA") {
                    $is_supplier_user = true;
                }
            }
        }
        return $is_supplier_user;
    }

    public function is_branch_executive() {
        $is_supplier_user = false;
        if ($this->is_logged_in()) {
            if (isset($this->user_data['user_entity'])) {
                if ($this->user_data['user_entity'] == "BE") {
                    $is_supplier_user = true;
                }
            }
        }
        return $is_supplier_user;
    }

    public function gen_supplier_token($supplier_id) {
        $branch_profile_token = $this->gen_token(array($supplier_id, 'profile'));
        $sup_profile_token = $this->gen_token(array($supplier_id, 'profile'));
        $active_pro_token = $this->gen_token(array($supplier_id, 'active'));
        $draft_pro_token = $this->gen_token(array($supplier_id, 'draft'));
        $product_profile_token = $this->gen_token(array($supplier_id, 'product'));
        $service_profile_token = $this->gen_token(array($supplier_id, 'service'));
        $master_token = $this->gen_token(array($supplier_id, 'master'));
        $order_token = $this->gen_token(array($supplier_id, 'order'));
        $report_token = $this->gen_token(array($supplier_id, 'report'));



        $crypt_data = array(
            'branch_profile_token' => $branch_profile_token,
            'sup_profile_token' => $sup_profile_token,
            'active_pro_token' => $active_pro_token,
            'draft_pro_token' => $draft_pro_token,
            'product_profile_token' => $product_profile_token,
            'master_token' => $master_token,
            'service_profile_token' => $service_profile_token,
            'order_token' => $order_token,
            'report_token' => $report_token
        );

        return $crypt_data;
    }

    public function gen_branch_token($branch_id) {
        $branch_profile_token = $this->gen_token(array($branch_id, 'profile'));
        $branch_pro_token = $this->gen_token(array($branch_id, 'active'));
        $draft_pro_token = $this->gen_token(array($branch_id, 'draft'));
        $product_profile_token = $this->gen_token(array($branch_id, 'product'));
        $master_token = $this->gen_token(array($branch_id, 'master'));
        $service_profile_token = $this->gen_token(array($branch_id, 'service'));


        $bran_token_data = array(
            'branch_profile_token' => $branch_profile_token,
            'branch_pro_token' => $branch_pro_token,
            'draft_pro_token' => $draft_pro_token,
            'product_profile_token' => $product_profile_token,
            'master_token' => $master_token,
            'service_profile_token' => $service_profile_token
        );

        return $bran_token_data;
    }

}
