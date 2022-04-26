<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . "/third_party/PHPExcel.php";

class Importdata {

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function importNodalAgency($excel_data, $user_name = 'ADMIN') {
        //$message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {
            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 8) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        /*
                          $txt = "";
                          foreach ($excel_data[$row] as $key => $value) {
                          $txt = $txt."[".$key."]=".$value." ";
                          }
                          $this->CI->load->helper('file');
                          write_file('error.log', $txt);
                         */

                        $agency_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $agency_address = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $agency_email = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];

                        $agency_name = trim($agency_name);

                        if (!empty($agency_name)) {
                            /* Agency Name column is blank */
                            /* $message["status"] = "ERROR";
                              $message["message"] = "Agency Name can't be blank";
                              $error_flag = 1;
                              break; */
                            $agency_address = trim($agency_address);
                            if (empty($agency_address)) {
                                /* Address column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Agency Address can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $agency_email = trim($agency_email);
                            if (empty($agency_email)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Agency Email Id can't be blank";
                                $error_flag = 1;
                                break;
                            }
                        }
                    }
                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */
                        for ($row = 2; $row <= $row_count; $row++) {
                            $agency_name = trim($agency_name);
                            if (empty($agency_name)) {
                                $duplicate_count++;
                                continue;
                            }

                            $agency_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $agency_address = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $agency_email = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $agency_state = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $agency_contactno = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $agency_website = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $agency_description = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                            $agency_contact_person = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];

                            $data = array(
                                'entity_id' => '2',
                                'agency_name' => $agency_name,
                                'agency_address' => $agency_address,
                                'agency_state' => $agency_state,
                                'agency_contactno' => $agency_contactno,
                                'agency_email' => $agency_email,
                                'agency_website' => $agency_website,
                                'agency_description' => $agency_description,
                                'agency_contact_person' => $agency_contact_person,
                                'agency_status' => '1', /* By default consider status as DRAFT */
                                'last_updated_by' => $user_name
                            );
                            $this->CI->load->model('AgencyModel', '', TRUE);
                            /* Check for duplicate agency name */
                            if ($this->CI->AgencyModel->check_duplicate($excel_data[$row]['A'])) {
                                /* Agency name is duplicate; So ignore current record and continue */
                                $duplicate_count++;
                                continue;
                            } else {
                                try {
                                    if ($this->CI->AgencyModel->insert($data)) {
                                        $import_count++;
                                        //redirect('master/nodal_agencies/draft/'.$this->AccountModel->last_id, 'refresh');
                                    } else {
                                        if ($import_count > 0 or $duplicate_count > 0) {
                                            /* Partial Data Imported */
                                            $message["status"] = "PARTIAL";
                                            $message["message"] = array();
                                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->AgencyModel->msg);
                                            $error_flag = 1;
                                        } else {
                                            /* No Data Imported (Error at the first record itself) */
                                            $message["status"] = "ERROR";
                                            $message["message"] = $this->CI->AgencyModel->msg;
                                            $error_flag = 1;
                                        }
                                        break;
                                    }
                                } catch (Exception $e) {
                                    $message["status"] = "ERROR";
                                    $message["message"] = $e->getMessage();
                                    $error_flag = 1;
                                }
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function importInstitute($excel_data, $nodal_agency_id, $user_name = 'ADMIN') {
        //$message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {
            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 20) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        /*
                          $txt = "";
                          foreach ($excel_data[$row] as $key => $value) {
                          $txt = $txt."[".$key."]=".$value." ";
                          }
                          $this->CI->load->helper('file');
                          write_file('error.log', $txt);
                         */

                        $institute_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $institute_category = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $institute_email = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                        $institute_address = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                        $institute_zone = (!isset($excel_data[$row]['K']) || $excel_data[$row]['K'] == NULL) ? "" : $excel_data[$row]['K'];
                        $institute_latitude = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
                        $institute_longitude = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];

                        $institute_name = trim($institute_name);
                        if (!empty($institute_name)) {
                            /* Agency Name column is blank */
                            /* $message["status"] = "ERROR";
                              $message["message"] = "Agency Name can't be blank";
                              $error_flag = 1;
                              break; */
                            if ($nodal_agency_id <= 0) {
                                /* Nodal Agency is not selected */
                                $message["status"] = "ERROR";
                                $message["message"] = "Please select the Regional Centre";
                                $error_flag = 1;
                                break;
                            }
                            $institute_category = trim($institute_category);
                            if (empty($institute_category)) {
                                /* Address column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution Address can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $institute_email = trim($institute_email);
                            if (empty($institute_email)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution Email Id can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $institute_address = trim($institute_address);
                            if (empty($institute_address)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution Address can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $institute_zone = trim($institute_zone);
                            if (empty($institute_zone)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution Zone Id can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $institute_latitude = trim($institute_latitude);
                            if (empty($institute_latitude)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution GPS Latitude can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            $institute_longitude = trim($institute_longitude);
                            if (empty($institute_longitude)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Institution GPS Longitude can't be blank";
                                $error_flag = 1;
                                break;
                            }
                        }
                    }
                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */
                        for ($row = 2; $row <= $row_count; $row++) {
                            $institute_name = trim($institute_name);
                            if (empty($institute_name)) {
                                $duplicate_count++;
                                continue;
                            }

                            $institute_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $institute_category = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $institute_website = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $institute_head = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $institute_email = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $institute_contactno = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $institute_address = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                            $institute_city = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];
                            $institute_pincode = (!isset($excel_data[$row]['I']) || $excel_data[$row]['I'] == NULL) ? "" : $excel_data[$row]['I'];
                            $institute_state = (!isset($excel_data[$row]['J']) || $excel_data[$row]['J'] == NULL) ? "" : $excel_data[$row]['J'];
                            $institute_zone = (!isset($excel_data[$row]['K']) || $excel_data[$row]['K'] == NULL) ? "" : $excel_data[$row]['K'];
                            $institute_bank_acno = (!isset($excel_data[$row]['L']) || $excel_data[$row]['L'] == NULL) ? "" : $excel_data[$row]['L'];
                            $institute_bank_acname = (!isset($excel_data[$row]['M']) || $excel_data[$row]['M'] == NULL) ? "" : $excel_data[$row]['M'];
                            $institute_bank_name = (!isset($excel_data[$row]['N']) || $excel_data[$row]['N'] == NULL) ? "" : $excel_data[$row]['N'];
                            $institute_bank_branch = (!isset($excel_data[$row]['O']) || $excel_data[$row]['O'] == NULL) ? "" : $excel_data[$row]['O'];
                            $institute_bank_ifsc = (!isset($excel_data[$row]['P']) || $excel_data[$row]['P'] == NULL) ? "" : $excel_data[$row]['P'];
                            $institute_bank_actype = (!isset($excel_data[$row]['Q']) || $excel_data[$row]['Q'] == NULL) ? "" : $excel_data[$row]['Q'];
                            $institute_description = (!isset($excel_data[$row]['R']) || $excel_data[$row]['R'] == NULL) ? "" : $excel_data[$row]['R'];
                            $institute_latitude = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
                            $institute_longitude = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];

                            $data = array(
                                'entity_id' => '3',
                                'agency_id' => $nodal_agency_id,
                                'institute_name' => $institute_name,
                                'institute_category' => $institute_category,
                                'institute_website' => $institute_website,
                                'institute_head' => $institute_head,
                                'institute_email' => $institute_email,
                                'institute_contactno' => $institute_contactno,
                                'institute_address' => $institute_address,
                                'institute_city' => $institute_city,
                                'institute_pincode' => $institute_pincode,
                                'institute_state' => $institute_state,
                                'institute_zone' => $institute_zone,
                                'institute_bank_acno' => $institute_bank_acno,
                                'institute_bank_acname' => $institute_bank_acname,
                                'institute_bank_name' => $institute_bank_name,
                                'institute_bank_branch' => $institute_bank_branch,
                                'institute_bank_ifsc' => $institute_bank_ifsc,
                                'institute_bank_actype' => $institute_bank_actype,
                                'institute_description' => $institute_description,
                                'institute_latitude' => $institute_latitude,
                                'institute_longitude' => $institute_longitude,
                                'institute_status' => '3', /* By default consider status as DRAFT */
                                'last_updated_by' => $user_name
                            );
                            $this->CI->load->model('InstituteModel', '', TRUE);
                            /* Check for duplicate institute name */
                            if ($this->CI->InstituteModel->check_duplicate($nodal_agency_id, $excel_data[$row]['A'])) {
                                /* Institute is duplicate; So ignore current record and continue */
                                $duplicate_count++;
                                continue;
                            } else {
                                try {
                                    if ($this->CI->InstituteModel->insert($data)) {
                                        $import_count++;
                                        //redirect('master/nodal_agencies/draft/'.$this->AccountModel->last_id, 'refresh');
                                    } else {
                                        if ($import_count > 0 or $duplicate_count > 0) {
                                            /* Partial Data Imported */
                                            $message["status"] = "PARTIAL";
                                            $message["message"] = array();
                                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->InstituteModel->msg);
                                            $error_flag = 1;
                                        } else {
                                            /* No Data Imported (Error at the first record itself) */
                                            $message["status"] = "ERROR";
                                            $message["message"] = $this->CI->InstituteModel->msg;
                                            $error_flag = 1;
                                        }
                                        break;
                                    }
                                } catch (Exception $e) {
                                    $message["status"] = "ERROR";
                                    $message["message"] = $e->getMessage();
                                    $error_flag = 1;
                                }
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function importDepartment($excel_data, $institute_id, $user_name = 'ADMIN') {
        $message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {

            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 7) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        /*
                          $txt = "";
                          foreach ($excel_data[$row] as $key => $value) {
                          $txt = $txt."[".$key."]=".$value." ";
                          }
                          $this->CI->load->helper('file');
                          write_file('error.log', $txt);
                         */

                        $dept_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $dept_head = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $dept_email = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];

                        if (!empty($dept_name)) {
                            if ($institute_id <= 0) {
                                /* Nodal Agency is not selected */
                                $message["status"] = "ERROR";
                                $message["message"] = "Please select the Parent Institution";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($dept_head)) {
                                /* Address column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Department Head can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($dept_email)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Department Email Id can't be blank";
                                $error_flag = 1;
                                break;
                            }
                        }
                    }
                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */
                        for ($row = 2; $row <= $row_count; $row++) {
                            if (empty($dept_email)) {
                                $duplicate_count++;
                                continue;
                            }

                            $this->CI->load->model('DepartmentModel', '', TRUE);



                            $dept_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $dept_head = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $dept_email = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $dept_website = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $dept_contactno = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $dept_contact_person = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $dept_description = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];

                            $data = array(
                                'entity_id' => '4',
                                'institute_id' => $institute_id,
                                'dept_name' => $dept_name,
                                'dept_head' => $dept_head,
                                'dept_email' => $dept_email,
                                'dept_website' => $dept_website,
                                'dept_contactno' => $dept_contactno,
                                'dept_contact_person' => $dept_contact_person,
                                'dept_description' => $dept_description,
                                'dept_status' => '3', /* By default consider status as DRAFT */
                                'last_updated_by' => $user_name
                            );
                            $this->CI->load->model('DepartmentModel', '', TRUE);
                            /* Check for duplicate institute name */
                            if ($this->CI->DepartmentModel->check_duplicate($institute_id, $excel_data[$row]['A'])) {
                                /* Institute is duplicate; So ignore current record and continue */
                                $duplicate_count++;
                                continue;
                            } else {
                                try {
                                    if ($this->CI->DepartmentModel->insert($data)) {
                                        $import_count++;
                                        //redirect('master/nodal_agencies/draft/'.$this->AccountModel->last_id, 'refresh');
                                    } else {
                                        if ($import_count > 0 or $duplicate_count > 0) {
                                            /* Partial Data Imported */
                                            $message["status"] = "PARTIAL";
                                            $message["message"] = array();
                                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->DepartmentModel->msg);
                                            $error_flag = 1;
                                        } else {
                                            /* No Data Imported (Error at the first record itself) */
                                            $message["status"] = "ERROR";
                                            $message["message"] = $this->CI->DepartmentModel->msg;
                                            $error_flag = 1;
                                        }
                                        break;
                                    }
                                } catch (Exception $e) {
                                    $message["status"] = "ERROR";
                                    $message["message"] = $e->getMessage();
                                    $error_flag = 1;
                                }
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    function get_institute($institute_id) {

        $this->CI->load->model('DepartmentModel', '', TRUE);
        return $this->CI->load->DepartmentModel->get_institute($institute_id);
    }

    public function importEquipment($excel_data, $institute_id, $user_name = 'ADMIN', $dept_name = NULL) {
        $message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        $user_data = $this->CI->session->userdata('user_data');
        $department_id = 0;
        $fac_id = 0;
        $fund_agen_id = 0;
        $project_id = 0;

        if ($excel_data) {
            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 14) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        /*
                          $txt = "";
                          foreach ($excel_data[$row] as $key => $value) {
                          $txt = $txt."[".$key."]=".$value." ";
                          }
                          $this->CI->load->helper('file');
                          write_file('error.log', $txt);
                         */
                        $department_id = 0;
                        $fac_id = 0;
                        $fund_agen_id = 0;
                        $project_id = 0;
                        if ($dept_name) {
                            //$this->array_to_file1($dept_name);
                            $equipment_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $equipment_abbr = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $equipment_location = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $equipment_make = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $equipment_model = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $equipment_srno = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $funding_agency_type = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                            $funding_agencies = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];
                            $equipment_project = (!isset($excel_data[$row]['I']) || $excel_data[$row]['I'] == NULL) ? "" : $excel_data[$row]['I'];

                            $equipment_description = (!isset($excel_data[$row]['J']) || $excel_data[$row]['J'] == NULL) ? "" : $excel_data[$row]['J'];
                            $equipment_dept_lab = $dept_name;
                            $equipment_facility_name = (!isset($excel_data[$row]['L']) || $excel_data[$row]['L'] == NULL) ? "" : $excel_data[$row]['L'];

                            $equipment_rate_hr = (!isset($excel_data[$row]['M']) || $excel_data[$row]['M'] == NULL) ? "0" : $excel_data[$row]['M'];
                            $equipment_website = (!isset($excel_data[$row]['N']) || $excel_data[$row]['N'] == NULL) ? "" : $excel_data[$row]['N'];
                            $equipment_category = (!isset($excel_data[$row]['P']) || $excel_data[$row]['P'] == NULL) ? "" : $excel_data[$row]['P'];
                            $equipment_fov_rate = (!isset($excel_data[$row]['Q']) || $excel_data[$row]['Q'] == NULL) ? "" : $excel_data[$row]['Q'];
                            $equipment_cif_rate = (!isset($excel_data[$row]['R']) || $excel_data[$row]['R'] == NULL) ? "" : $excel_data[$row]['R'];
                            $equipment_other_rate = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
							$supplier = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];
                            $supplier_email_id = (!isset($excel_data[$row]['U']) || $excel_data[$row]['U'] == NULL) ? "" : $excel_data[$row]['U'];
                            $service_provider = (!isset($excel_data[$row]['V']) || $excel_data[$row]['V'] == NULL) ? "" : $excel_data[$row]['V'];
                            $service_provider_email_id = (!isset($excel_data[$row]['W']) || $excel_data[$row]['W'] == NULL) ? "" : $excel_data[$row]['W'];
						} else {

                            $equipment_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $equipment_abbr = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $equipment_location = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $equipment_make = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $equipment_model = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $equipment_srno = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $funding_agency_type = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                            $funding_agencies = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];
                            $equipment_project = (!isset($excel_data[$row]['I']) || $excel_data[$row]['I'] == NULL) ? "" : $excel_data[$row]['I'];

                            $equipment_description = (!isset($excel_data[$row]['J']) || $excel_data[$row]['J'] == NULL) ? "" : $excel_data[$row]['J'];
                            $equipment_dept_lab = (!isset($excel_data[$row]['K']) || $excel_data[$row]['K'] == NULL) ? "" : $excel_data[$row]['K'];
                            $equipment_facility_name = (!isset($excel_data[$row]['L']) || $excel_data[$row]['L'] == NULL) ? "" : $excel_data[$row]['L'];

                            $equipment_rate_hr = (!isset($excel_data[$row]['M']) || $excel_data[$row]['M'] == NULL) ? "0" : $excel_data[$row]['M'];
                            $equipment_website = (!isset($excel_data[$row]['N']) || $excel_data[$row]['N'] == NULL) ? "" : $excel_data[$row]['N'];
                            $equipment_category = (!isset($excel_data[$row]['P']) || $excel_data[$row]['P'] == NULL) ? "" : $excel_data[$row]['P'];
                            $equipment_fov_rate = (!isset($excel_data[$row]['Q']) || $excel_data[$row]['Q'] == NULL) ? "" : $excel_data[$row]['Q'];
                            $equipment_cif_rate = (!isset($excel_data[$row]['R']) || $excel_data[$row]['R'] == NULL) ? "" : $excel_data[$row]['R'];
                            $equipment_other_rate = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
							$supplier = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];
                            $supplier_email_id = (!isset($excel_data[$row]['U']) || $excel_data[$row]['U'] == NULL) ? "" : $excel_data[$row]['U'];
                            $service_provider = (!isset($excel_data[$row]['V']) || $excel_data[$row]['V'] == NULL) ? "" : $excel_data[$row]['V'];
                            $service_provider_email_id  = (!isset($excel_data[$row]['W']) || $excel_data[$row]['W'] == NULL) ? "" : $excel_data[$row]['W'];
						}


                        if (!empty($equipment_name)) {
                            if ($institute_id <= 0) {
                                /* Institute not selected */
                                $message["status"] = "ERROR";
                                $message["message"] = "Please select the Parent Institution";
                                $error_flag = 1;
                                break;
                            }

                            if (!empty($equipment_dept_lab)) {
                                $this->CI->load->model('DepartmentModel', '', TRUE);
                                $this->CI->load->model('FacilityModel', '', TRUE);
                                $department = $this->CI->DepartmentModel->check_dept_name_in_institute($institute_id, $equipment_dept_lab);
                                if (!$department) {
                                    //                                    $message["status"] = "ERROR";
                                    //                                    $message["message"] = "Department Name is Not There in the List";
                                    //                                    $error_flag = 1;
                                    //                                    break;

                                    $data = array(
                                        'dept_name' => $equipment_dept_lab,
                                        'entity_id' => '4',
                                        'institute_id' => $institute_id,
                                        'last_updated_by' => $user_data['user_name']
                                    );
                                    $this->CI->load->model('DepartmentModel', '', TRUE);
                                    $this->CI->DepartmentModel->add_department_in_importing($data);
                                    $department_id = $this->CI->DepartmentModel->get_dept_id_from_dept_name($institute_id, $equipment_dept_lab);
                                    $facility = $this->CI->FacilityModel->check_fac_name_in_institute($department_id, $equipment_facility_name);
                                    if (!$facility) {
                                        $data = array(
                                            'faculty_user_id' => 0,
                                            'dept_id' => $department_id,
                                            'fac_name' => $equipment_facility_name,
                                            'entity_id' => 6
                                        );
                                        $this->CI->load->model('FacilityModel', '', TRUE);
                                        $this->CI->FacilityModel->add_facility_in_importing($data);
                                        $fac_id = $this->CI->FacilityModel->get_fac_id_from_dept_id($equipment_facility_name);
                                    } else {
                                        $fac_id = $this->CI->FacilityModel->get_fac_id_from_dept_id($equipment_facility_name);
                                    }
                                } else {
                                    if (!empty($equipment_facility_name)) {
                                        $department_id = $this->CI->DepartmentModel->get_dept_id_from_dept_name($institute_id, $equipment_dept_lab);
                                        $facility = $this->CI->FacilityModel->check_fac_name_in_institute($department_id, $equipment_facility_name);
                                        if (!$facility) {
                                            $data = array(
                                                'faculty_user_id' => 0,
                                                'dept_id' => $department_id,
                                                'fac_name' => $equipment_facility_name,
                                                'entity_id' => 6
                                            );
                                            $this->CI->load->model('FacilityModel', '', TRUE);
                                            $this->CI->FacilityModel->add_facility_in_importing($data);
                                            $fac_id = $this->CI->FacilityModel->get_fac_id_from_dept_id($equipment_facility_name);
                                        } else {
                                            $fac_id = $this->CI->FacilityModel->get_fac_id_from_dept_id($equipment_facility_name);
                                        }
                                    }
                                }
                            }

                            //$fund_agen_id =NULL;
                            if (!empty($funding_agencies)) {
                                $this->CI->load->model('FundingAgencyModel', '', TRUE);
                                $this->CI->load->model('ProjectModel', '', TRUE);
                                $funding_agency = $this->CI->FundingAgencyModel->check_fund_name_in_funding_agency($funding_agencies);
                                //  if (!$funding_agency) {
                                //      $message["status"] = "ERROR";
                                //      $message["message"] = "Funding Agency Name is Not There in the List";
                                //     $error_flag = 1;
                                //    break;
                                //  } else {
                                if (!empty($equipment_project)) {
                                    $fund_agen_id = $this->CI->FundingAgencyModel->get_fund_agen_id_from_funding_name($funding_agencies);

                                    $project = $this->CI->ProjectModel->check_project_name_in_funding_agency($equipment_project, $fund_agen_id);


                                    if (!$project) {
                                        $message["status"] = "ERROR";
                                        $message["message"] = "Project Name is not there in the list";
                                        $error_flag = 1;
                                        break;
                                    } else {
                                        $project_id = $this->CI->ProjectModel->get_project_id_from_project_name($equipment_project);
                                    }
                                } else {
                                    $fund_agen_id = $this->CI->FundingAgencyModel->get_fund_agen_id_from_funding_name($funding_agencies);
                                }
                                //  }
                            }


                            if (empty($equipment_category)) {
                                /* Equipment Model column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Equipment Category can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            //  if (empty($funding_agencies)) {
                            /* Equipment Model column is blank */
                            //   $message["status"] = "ERROR";
                            //   $message["message"] = "Funding Agency name can't be blank";
                            //   $error_flag = 1;
                            //    break;
                            //  }
                        }
                    }

                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */

                        for ($row = 2; $row <= $row_count; $row++) {
                            $department_id = 0;
                            $fac_id = 0;
                            $fund_agen_id = 0;
                            $project_id = 0;
                            if ($dept_name) {
                                //$this->array_to_file1($dept_name);
                                $equipment_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                                $equipment_abbr = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                                $equipment_location = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                                $equipment_make = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                                $equipment_model = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                                $equipment_srno = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                                $funding_agency_type = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                                $funding_agencies = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];
                                $equipment_project = (!isset($excel_data[$row]['I']) || $excel_data[$row]['I'] == NULL) ? "" : $excel_data[$row]['I'];

                                $equipment_description = (!isset($excel_data[$row]['J']) || $excel_data[$row]['J'] == NULL) ? "" : $excel_data[$row]['J'];
                                $equipment_dept_lab = $dept_name;
                                $equipment_facility_name = (!isset($excel_data[$row]['L']) || $excel_data[$row]['L'] == NULL) ? "" : $excel_data[$row]['L'];

                                $equipment_rate_hr = (!isset($excel_data[$row]['M']) || $excel_data[$row]['M'] == NULL) ? "0" : $excel_data[$row]['M'];
                                $equipment_website = (!isset($excel_data[$row]['N']) || $excel_data[$row]['N'] == NULL) ? "" : $excel_data[$row]['N'];
                                $equipment_category = (!isset($excel_data[$row]['P']) || $excel_data[$row]['P'] == NULL) ? "" : $excel_data[$row]['P'];
                                $equipment_fov_rate = (!isset($excel_data[$row]['Q']) || $excel_data[$row]['Q'] == NULL) ? "" : $excel_data[$row]['Q'];
                                $equipment_cif_rate = (!isset($excel_data[$row]['R']) || $excel_data[$row]['R'] == NULL) ? "" : $excel_data[$row]['R'];
                                $equipment_other_rate = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
								$supplier = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];
                                $supplier_email_id = (!isset($excel_data[$row]['U']) || $excel_data[$row]['U'] == NULL) ? "" : $excel_data[$row]['U'];
                                $service_provider  = (!isset($excel_data[$row]['V']) || $excel_data[$row]['V'] == NULL) ? "" : $excel_data[$row]['V'];
                                $service_provider_email_id = (!isset($excel_data[$row]['W']) || $excel_data[$row]['W'] == NULL) ? "" : $excel_data[$row]['W'];
							} else {
                                $equipment_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                                $equipment_abbr = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                                $equipment_location = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                                $equipment_make = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                                $equipment_model = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                                $equipment_srno = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                                $funding_agency_type = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];
                                $funding_agencies = (!isset($excel_data[$row]['H']) || $excel_data[$row]['H'] == NULL) ? "" : $excel_data[$row]['H'];
                                $equipment_project = (!isset($excel_data[$row]['I']) || $excel_data[$row]['I'] == NULL) ? "" : $excel_data[$row]['I'];

                                $equipment_description = (!isset($excel_data[$row]['J']) || $excel_data[$row]['J'] == NULL) ? "" : $excel_data[$row]['J'];
                                $equipment_dept_lab = (!isset($excel_data[$row]['K']) || $excel_data[$row]['K'] == NULL) ? "" : $excel_data[$row]['K'];
                                $equipment_facility_name = (!isset($excel_data[$row]['L']) || $excel_data[$row]['L'] == NULL) ? "" : $excel_data[$row]['L'];

                                $equipment_rate_hr = (!isset($excel_data[$row]['M']) || $excel_data[$row]['M'] == NULL) ? "0" : $excel_data[$row]['M'];
                                $equipment_website = (!isset($excel_data[$row]['N']) || $excel_data[$row]['N'] == NULL) ? "" : $excel_data[$row]['N'];
                                $equipment_category = (!isset($excel_data[$row]['P']) || $excel_data[$row]['P'] == NULL) ? "" : $excel_data[$row]['P'];
                                $equipment_fov_rate = (!isset($excel_data[$row]['Q']) || $excel_data[$row]['Q'] == NULL) ? "" : $excel_data[$row]['Q'];
                                $equipment_cif_rate = (!isset($excel_data[$row]['R']) || $excel_data[$row]['R'] == NULL) ? "" : $excel_data[$row]['R'];
                                $equipment_other_rate = (!isset($excel_data[$row]['S']) || $excel_data[$row]['S'] == NULL) ? "" : $excel_data[$row]['S'];
								$supplier = (!isset($excel_data[$row]['T']) || $excel_data[$row]['T'] == NULL) ? "" : $excel_data[$row]['T'];
                                $supplier_email_id = (!isset($excel_data[$row]['U']) || $excel_data[$row]['U'] == NULL) ? "" : $excel_data[$row]['U'];
                                $service_provider = (!isset($excel_data[$row]['V']) || $excel_data[$row]['V'] == NULL) ? "" : $excel_data[$row]['V'];
                                $service_provider_email_id = (!isset($excel_data[$row]['W']) || $excel_data[$row]['W'] == NULL) ? "" : $excel_data[$row]['W'];
                            }
                            //                            if (empty($equipment_name)) {
                            //                                $duplicate_count++;
                            //                                continue;
                            //                            }





                            $this->CI->load->model('DepartmentModel', '', TRUE);
                            $this->CI->load->model('FacilityModel', '', TRUE);
                            $this->CI->load->model('SchemeModel', '', TRUE);
                            $this->CI->load->model('FundingAgencyModel', '', TRUE);


                            if (!empty($equipment_dept_lab)) {
                                $department_id = $this->CI->DepartmentModel->get_dept_id_from_dept_name($institute_id, $equipment_dept_lab);
                                //$this->array_to_file1($equipment_facility_id);
                                if (!empty($equipment_facility_name)) {
                                    //$this->array_to_file1($equipment_facility_name);
                                    $fac_id = $this->CI->FacilityModel->get_fac_id_from_dept_id($equipment_facility_name);
                                    // $this->array_to_file1($fac_id);
                                    //$this->array_to_file1($fac_id);
                                }
                            }



                            if (!empty($funding_agencies)) {
                                $this->CI->load->model('FundingAgencyModel', '', TRUE);
                                $this->CI->load->model('ProjectModel', '', TRUE);

                                // $this->array_to_file1($funding_agencies);
                                if (!empty($equipment_project)) {
                                    $fund_agen_id = $this->CI->FundingAgencyModel->get_fund_agen_id_from_funding_name($funding_agencies);
                                    //$this->array_to_file1($fund_agen_id);
                                    $project_id = $this->CI->ProjectModel->get_project_id_from_project_name($equipment_project);
                                } else {
                                    $fund_agen_id = $this->CI->FundingAgencyModel->get_fund_agen_id_from_funding_name($funding_agencies);
                                }
                            }
                            if (empty($equipment_name)) {
                                $duplicate_count++;
                                continue;
                            }
                            $data = array(
                                'entity_id' => '9',
                                'institute_id' => $institute_id,
                                'equipment_name' => $equipment_name,
                                'equipment_abbr' => $equipment_abbr,
                                'equipment_location' => $equipment_location,
                                'equipment_make' => $equipment_make,
                                'equipment_model' => $equipment_model,
                                'equipment_srno' => $equipment_srno,
                                'funding_agency_type' => $funding_agency_type,
                                'funding_agencies' => $funding_agencies,
                                'equipment_agency_id' => $fund_agen_id,
                                'equipment_description' => $equipment_description,
                                'equipment_department_id' => $department_id,
                                'equipment_facility_id' => $fac_id,
                                'equipment_project_id' => $project_id,
                                'equipment_rate' => $equipment_rate_hr,
                                'equipment_website' => $equipment_website,
                                'equipment_category' => $equipment_category,
                                'equipment_status' => '3', /* By default consider status as DRAFT */
                                'equipment_fov_rate' => $equipment_fov_rate,
                                'equipment_cif_rate' => $equipment_cif_rate,
                                'equipment_other_rate' => $equipment_other_rate,
                                'last_updated_by' => $user_name,
				                'supplier' => $supplier,
                                'supplier_email_id' => $supplier_email_id,
                                'service_provider' => $service_provider,
                                'service_provider_email_id' => $service_provider_email_id,
                                'pooling_status' => 0,
                                'created_by' => $user_data['user_id']
                            );
                            $this->CI->load->model('EquipmentModel', '', TRUE);
                            try {
                                if ($this->CI->EquipmentModel->insert($data)) {
                                    $import_count++;
                                } else {
                                    if ($import_count > 0 or $duplicate_count > 0) {
                                        /* Partial Data Imported */
                                        $message["status"] = "PARTIAL";
                                        $message["message"] = array();
                                        $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->DepartmentModel->msg);
                                        $error_flag = 1;
                                    } else {
                                        /* No Data Imported (Error at the first record itself) */
                                        $message["status"] = "ERROR";
                                        $message["message"] = $this->CI->EquipmentModel->msg;
                                        $error_flag = 1;
                                    }
                                    break;
                                }
                            } catch (Exception $e) {
                                $message["status"] = "ERROR";
                                $message["message"] = $e->getMessage();
                                $error_flag = 1;
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                            $admin_mail = $this->CI->config->item('super_admin_email');
                            $this->CI->load->model('InstituteModel', '', TRUE);
                            $this->CI->load->model('SubnodalAdminModel', '', TRUE);
                            $this->CI->load->model('IstemUserModel', '', TRUE);
                            $sub_nodal_email = $this->CI->SubnodalAdminModel->get_sub_nodal_list();
                            $institute_admin_email = $this->CI->InstituteModel->get_institute_admin_email($institute_id);
                            $user_email = $this->CI->IstemUserModel->get_user_email($user_data['user_id']);
                            $cc_list = array();
                            if ($sub_nodal_email) {
                                foreach ($sub_nodal_email as $sub_nodal) {
                                    array_push($cc_list, $sub_nodal["user_email"]);
                                }
                            }
                            if ($institute_admin_email) {
                                array_push($cc_list, $institute_admin_email);
                            }
                            if ($user_email) {
                                array_push($cc_list, $user_email);
                            }
                            $institute_details = $this->CI->InstituteModel->get_details($institute_id);
                            /* Send Notification to Super Admin */
                            $this->CI->load->library('mailer');
                            $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
                            $notif_message = $notif_message . "This Institution : <strong>" . ' ' . $institute_details['institute_name'] . ' ' . "</strong>has added" . ' ' . '<strong>' . $import_count . '</strong>' . ' ' . "equipment(s).<br>";
                            $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                            $notif_message = $notif_message . "<strong>Note : Kindly enable/disable the notification in the profile section, if you do not want it in your email and continue checking the inbox at the I-STEM portal.</strong><br>";
                            $this->mailer->sendmail($admin_mail, 'I-STEM Equipment Addition Notification', $notif_message, $cc_list);
                            //insert into mail//
                            foreach ($cc_list as $cc) {
                                $mail_type = 'New Equipment Added';
                                $this->CI->load->library('logdetails');
                                $ip = $this->CI->logdetails->get_ip();
                                // $mail_from = 'istemstaging@gmail.com';
                                $mail_sub = 'New Equipment Added';
                                $mail_content = $notif_message;
                                $mail_data = array(
                                    'mail_type' => $mail_type,
                                    'mail_from' => $user_email,
                                    'mail_to' => $cc,
                                    'mail_subject' => $mail_sub,
                                    'mail_content' => $mail_content,
                                    'ip' => $ip,
                                    'mail_seen_status' => '0',
                                    'last_updated_by' => $user_data['user_name']
                                );
                                $this->CI->load->model('MailBoxModel', '', TRUE);
                                $this->CI->MailBoxModel->insert($mail_data);
                            }
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_products($supplier_id = "", $excel_data, $user_data) {
        $message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {
            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 6) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        $p_nm = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $p_mk = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $p_md = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                        $p_dr = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                        $p_uom = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                        $p_rate = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                        $p_hsn = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];


                        $data = array(
                            'product_name' => $p_nm,
                            'product_make' => $p_mk,
                            'product_model' => $p_md,
                            'product_description' => $p_dr,
                            'product_uom' => $p_uom,
                            'product_price' => $p_rate,
                            'supplier_id' => $supplier_id,
                            'product_hsn' => $p_hsn
                        );
                        if ($p_nm == '') {
                            $message["status"] = "ERROR";
                            $message["message"] = "Product Name can't be blank";
                            $error_flag = 1;
                            break;
                        }
                        if ($p_mk == '') {
                            $message["status"] = "ERROR";
                            $message["message"] = "Product Make can't be blank";
                            $error_flag = 1;
                            break;
                        }
                        if ($p_md == '') {
                            $message["status"] = "ERROR";
                            $message["message"] = "Product Model can't be blank";
                            $error_flag = 1;
                            break;
                        }
                    }

                    if ($error_flag == 0) {
                        for ($row = 2; $row <= $row_count; $row++) {
                            $p_nm = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $p_mk = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $p_md = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $p_dr = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $p_uom = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $p_rate = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $p_hsn = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];

                            $data = array(
                                'product_name ' => $p_nm,
                                'product_make' => $p_mk,
                                'product_model' => $p_md,
                                'product_description' => $p_dr,
                                'product_uom' => $p_uom,
                                'product_price' => $p_rate,
                                'supplier_id' => $supplier_id,
                                'product_hsn' => $p_hsn
                            );
                            $this->CI->load->model('supplier/ProductModel', 'ProductModel', TRUE);
                            try {

                                $new_prod_id = $this->CI->ProductModel->insert_products($data);
                                if ($new_prod_id) {
                                    $product_code = strtoupper(substr(md5($supplier_id . "PRODUCT_CODE" . $new_prod_id), 0, 6)) . str_pad($new_prod_id, 6, "0", STR_PAD_LEFT) . str_pad($supplier_id, 6, "0", STR_PAD_LEFT);
                                    $update_data = array(
                                        'product_code' => $product_code  //update unique product code
                                    );
                                    $this->CI->ProductModel->insert_prod_code($new_prod_id, $update_data);
                                }
                            } catch (Exception $e) {

                                $message["status"] = "ERROR";
                                $message["message"] = $e->getMessage();
                                break;
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be six columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_product_specifications($supplier_id = "", $product_id = "", $excel_data_for_specifications, $user_data) {
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        $this->CI->load->model('supplier/ProductModel', 'ProductModel', TRUE);
        if ($excel_data_for_specifications) {

            $row_count = count($excel_data_for_specifications);
            $column_count = count($excel_data_for_specifications[1]);

            if ($row_count >= 2) {
                $this->CI->ProductModel->delete_product_specifications($product_id);
                if ($column_count >= 3) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        $header_name = (!isset($excel_data_for_specifications[$row]['A']) || $excel_data_for_specifications[$row]['A'] == NULL) ? "" : $excel_data_for_specifications[$row]['A'];
                        $caption = (!isset($excel_data_for_specifications[$row]['B']) || $excel_data_for_specifications[$row]['B'] == NULL) ? "" : $excel_data_for_specifications[$row]['B'];
                        $value = (!isset($excel_data_for_specifications[$row]['C']) || $excel_data_for_specifications[$row]['C'] == NULL) ? "" : $excel_data_for_specifications[$row]['C'];

                        $data = array(
                            'product_id ' => $product_id,
                            'header_name ' => $header_name,
                            'caption' => $caption,
                            'value' => $value,
                        );
                        try {
                            $this->CI->ProductModel->add_product_specifications($data);
                        } catch (Exception $e) {

                            $message["status"] = "ERROR";
                            $message["message"] = $e->getMessage();
                            break;
                        }
                    }
                    if (!$data) {
                        $message["status"] = "ERROR";
                        $message["message"] = $data;
                    } else {
                        /* Duplicate data */
                        $message["status"] = "SUCCESS";
                        $message["message"] = "Data Imported Successfully...!";
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be three columns";
                }
            } else {
                /* Required row data not available */
                echo "At least one data row required";
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_product_search_tags($supplier_id = "", $product_id = "", $excel_data_for_tags, $user_data) {
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        $this->CI->load->model('supplier/ProductModel', 'ProductModel', TRUE);

        if ($excel_data_for_tags) {
            $row_count = count($excel_data_for_tags);
            $column_count = count($excel_data_for_tags[1]);

            if ($row_count >= 2) {
                $this->CI->ProductModel->delete_product_tags($product_id);
                if ($column_count >= 1) {
                    for ($row = 2; $row <= $row_count; $row++) {

                        $product_tag_name = (!isset($excel_data_for_tags[$row]['A']) || $excel_data_for_tags[$row]['A'] == NULL) ? "" : $excel_data_for_tags[$row]['A'];

                        $data = array(
                            'product_id ' => $product_id,
                            'product_tag_name ' => $product_tag_name,
                        );

                        try {
                            $this->CI->ProductModel->add_product_tags($data);
                        } catch (Exception $e) {

                            $message["status"] = "ERROR";
                            $message["message"] = $e->getMessage();
                            break;
                        }
                    }
                    if ($data) {
                        $message["status"] = "ERROR";
                        $message["message"] = $data;
                    } else {
                        /* Duplicate data */
                        $message["status"] = "SUCCESS";
                        $message["message"] = "Data Imported Successfully...!";
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be three columns";
                }
            } else {
                /* Required row data not available */
                echo "At least one data row required";
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function importSchemes($excel_data, $fund_agen_id, $user_name) {
        $message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {

            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 1) {
                    for ($row = 2; $row <= $row_count; $row++) {

                        $scheme_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                    }
                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */
                        for ($row = 2; $row <= $row_count; $row++) {

                            $this->CI->load->model('SchemeModel', '', TRUE);

                            $scheme_name = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];


                            $data = array(
                                'funding_agency_id' => $fund_agen_id,
                                'scheme_name' => $scheme_name,
                                'last_updated_by' => $user_name
                            );
                            $this->CI->load->model('SchemeModel', '', TRUE);
                            /* Check for duplicate scheme name */
                            if ($this->CI->SchemeModel->check_duplicate($fund_agen_id, $excel_data[$row]['A'])) {
                                /* Scheme is duplicate; So ignore current record and continue */
                                $duplicate_count++;
                                continue;
                            } else {
                                try {
                                    if ($this->CI->SchemeModel->insert_scheme($data)) {
                                        $import_count++;
                                    } else {
                                        if ($import_count > 0 or $duplicate_count > 0) {
                                            /* Partial Data Imported */
                                            $message["status"] = "PARTIAL";
                                            $message["message"] = array();
                                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->SchemeModel->msg);
                                            $error_flag = 1;
                                        } else {
                                            /* No Data Imported (Error at the first record itself) */
                                            $message["status"] = "ERROR";
                                            $message["message"] = $this->CI->SchemeModel->msg;
                                            $error_flag = 1;
                                        }
                                        break;
                                    }
                                } catch (Exception $e) {
                                    $message["status"] = "ERROR";
                                    $message["message"] = $e->getMessage();
                                    $error_flag = 1;
                                }
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be only one columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function importProjects($excel_data, $fund_agen_id, $user_name, $scheme_id, $institute_id) {
        $message = array();
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {

            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 7) {
                    for ($row = 2; $row <= $row_count; $row++) {

                        $ref_no = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $project_name = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $project_cost = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                        $capital_amt = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                        $project_dur_from = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                        $project_dur_to = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                        $investigator = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];


                        if (!empty($project_name)) {
                            if ($scheme_id <= 0) {
                                /* Nodal Agency is not selected */
                                $message["status"] = "ERROR";
                                $message["message"] = "Please select the Scheme";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($ref_no)) {
                                /* Address column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Saction/Reference No. can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($project_name)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Project name can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($project_cost)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Total Project Cost can't be blank";
                                $error_flag = 1;
                                break;
                            }
                            if (empty($capital_amt)) {
                                /* Email Id column is blank */
                                $message["status"] = "ERROR";
                                $message["message"] = "Capital/Equipment Grant out of Total Project Cost can't be blank";
                                $error_flag = 1;
                                break;
                            }
                        }
                    }
                    if ($error_flag == 0) {
                        /* Data Validated */
                        /* Continue to import the data */
                        for ($row = 2; $row <= $row_count; $row++) {
                            //                            if (empty($dept_email)) {
                            //                                $duplicate_count++;
                            //                                continue;
                            //                            }

                            $this->CI->load->model('FundingAgencyModel', '', TRUE);



                            $ref_no = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $project_name = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                            $project_cost = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                            $capital_amt = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                            $project_dur_from = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                            $project_dur_to = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                            $investigator = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];

                            $data = array(
                                'project_name' => $project_name,
                                'project_amount' => $project_cost,
                                'fund_agen_id' => $fund_agen_id,
                                'project_from_date' => date('Y-m-d', strtotime($project_dur_from)),
                                'project_till_date' => date('Y-m-d', strtotime($project_dur_to)),
                                'project_investigator' => $investigator,
                                'capital_cost' => $capital_amt,
                                'last_updated_by' => $user_data['user_name'],
                                'scheme_id' => $scheme_id,
                                'reference_no' => $ref_no,
                                'institute_id' => $institute_id
                            );
                            $this->CI->load->model('FundingAgencyModel', '', TRUE);
                            /* Check for duplicate Project name */
                            if ($this->CI->FundingAgencyModel->check_duplicate($fund_agen_id, $excel_data[$row]['A'])) {
                                /* Project is duplicate; So ignore current record and continue */
                                $duplicate_count++;
                                continue;
                            } else {
                                try {
                                    if ($this->CI->FundingAgencyModel->insert_into_project($data)) {
                                        $import_count++;
                                    } else {
                                        if ($import_count > 0 or $duplicate_count > 0) {
                                            /* Partial Data Imported */
                                            $message["status"] = "PARTIAL";
                                            $message["message"] = array();
                                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->DepartmentModel->msg);
                                            $error_flag = 1;
                                        } else {
                                            /* No Data Imported (Error at the first record itself) */
                                            $message["status"] = "ERROR";
                                            $message["message"] = $this->CI->FundingAgencyModel->msg;
                                            $error_flag = 1;
                                        }
                                        break;
                                    }
                                } catch (Exception $e) {
                                    $message["status"] = "ERROR";
                                    $message["message"] = $e->getMessage();
                                    $error_flag = 1;
                                }
                            }
                        }
                        if ($error_flag == 0) {
                            /* No error */
                            /* Create a insert details message */
                            $message["status"] = "SUCCESS";
                            $message["message"] = array();
                            $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                        }
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_services($supplier_id = "", $excel_data, $user_data) {
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        if ($excel_data) {
            $row_count = count($excel_data);
            $column_count = count($excel_data[1]);
            if ($row_count >= 2) {
                if ($column_count >= 8) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        $sr_nm = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                        $sr_dr = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B'];
                        $sr_pr = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C'];
                        $sr_f = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D'];
                        $sr_uom = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E'];
                        $sr_rate = (!isset($excel_data[$row]['F']) || $excel_data[$row]['F'] == NULL) ? "" : $excel_data[$row]['F'];
                        $sr_sac = (!isset($excel_data[$row]['G']) || $excel_data[$row]['G'] == NULL) ? "" : $excel_data[$row]['G'];

                        $data = array(
                            'service_name ' => $sr_nm,
                            'service_description' => $sr_dr,
                            'service_properties' => $sr_pr,
                            'service_features' => $sr_f,
                            'service_uom' => $sr_uom,
                            'service_rate ' => $sr_rate,
                            'supplier_id' => $supplier_id,
                            'service_sac_code' => $sr_sac
                        );

                        $this->CI->load->model('supplier/ServiceModel', 'ServiceModel', TRUE);
                        try {
                            $new_service_id = $this->CI->ServiceModel->insert_services($data);
                            if ($new_service_id) {
                                $service_code = strtoupper(substr(md5($supplier_id . "SERVICE_CODE" . $new_service_id), 0, 6)) . str_pad($new_service_id, 6, "0", STR_PAD_LEFT) . str_pad($supplier_id, 6, "0", STR_PAD_LEFT);
                                $update_data = array(
                                    'service_code' => $service_code  //update unique service code
                                );
                                $this->CI->ServiceModel->insert_serv_code($new_service_id, $update_data);
                            }
                        } catch (Exception $e) {

                            $message["status"] = "ERROR";
                            $message["message"] = $e->getMessage();
                            break;
                        }
                    }
                    if ($data) {
                        $message["status"] = "ERROR";
                        $message["message"] = $data;
                    } else {
                        //     echo 'dddd'; exit();
                        /* Duplicate data */
                        $message["status"] = "SUCCESS";
                        $message["message"] = "Data Imported Successfully...!";
                    }
                } else {

                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be eight columns";
                }
            } else {
                /* Required row data not available */
                echo "At least one data row required";
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_service_specifications($supplier_id = "", $service_id = "", $excel_data_for_specifications, $user_data) {
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        $this->CI->load->model('supplier/ServiceModel', 'ServiceModel', TRUE);
        if ($excel_data_for_specifications) {

            $row_count = count($excel_data_for_specifications);
            $column_count = count($excel_data_for_specifications[1]);

            if ($row_count >= 2) {
                $this->CI->ServiceModel->delete_service_specifications($service_id);
                if ($column_count >= 3) {
                    for ($row = 2; $row <= $row_count; $row++) {
                        $header_name = (!isset($excel_data_for_specifications[$row]['A']) || $excel_data_for_specifications[$row]['A'] == NULL) ? "" : $excel_data_for_specifications[$row]['A'];
                        $caption = (!isset($excel_data_for_specifications[$row]['B']) || $excel_data_for_specifications[$row]['B'] == NULL) ? "" : $excel_data_for_specifications[$row]['B'];
                        $value = (!isset($excel_data_for_specifications[$row]['C']) || $excel_data_for_specifications[$row]['C'] == NULL) ? "" : $excel_data_for_specifications[$row]['C'];

                        $data = array(
                            'service_id' => $service_id,
                            'header_name' => $header_name,
                            'caption' => $caption,
                            'value' => $value,
                        );

                        //   print_r($data); exit();
                        try {
                            $this->CI->ServiceModel->add_service_specifications($data);
                        } catch (Exception $e) {

                            $message["status"] = "ERROR";
                            $message["message"] = $e->getMessage();
                            break;
                        }
                    }
                    if (!$data) {
                        $message["status"] = "ERROR";
                        $message["message"] = $data;
                    } else {
                        /* Duplicate data */
                        $message["status"] = "SUCCESS";
                        $message["message"] = "Data Imported Successfully...!";
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be three columns";
                }
            } else {
                /* Required row data not available */
                echo "At least one data row required";
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_service_search_tags($supplier_id = "", $service_id = "", $excel_data_for_tags, $user_data) {
        $error_flag = 0;
        $import_count = 0;
        $duplicate_count = 0;
        $this->CI->load->model('supplier/ServiceModel', 'ServiceModel', TRUE);

        if ($excel_data_for_tags) {
            $row_count = count($excel_data_for_tags);
            $column_count = count($excel_data_for_tags[1]);

            if ($row_count >= 2) {
                $this->CI->ServiceModel->delete_service_tags($service_id);
                if ($column_count >= 1) {
                    for ($row = 2; $row <= $row_count; $row++) {

                        $service_tag_name = (!isset($excel_data_for_tags[$row]['A']) || $excel_data_for_tags[$row]['A'] == NULL) ? "" : $excel_data_for_tags[$row]['A'];

                        $data = array(
                            'service_id' => $service_id,
                            'service_tag_name' => $service_tag_name,
                        );

                        try {
                            $this->CI->ServiceModel->add_service_tags($data);
                        } catch (Exception $e) {

                            $message["status"] = "ERROR";
                            $message["message"] = $e->getMessage();
                            break;
                        }
                    }
                    if ($data) {
                        $message["status"] = "ERROR";
                        $message["message"] = $data;
                    } else {
                        /* Duplicate data */
                        $message["status"] = "SUCCESS";
                        $message["message"] = "Data Imported Successfully...!";
                    }
                } else {
                    /* Required column data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "There should be three columns";
                }
            } else {
                /* Required row data not available */
                echo "At least one data row required";
                $message["status"] = "ERROR";
                $message["message"] = "At least one data row required";
            }
        } else {
            $message["status"] = "ERROR";
            $message["message"] = "No data to import";
        }
        return $message;
    }

    public function import_users($excel_data, $institute_id, $institute_name) {
        //$this->load->model('PublicUserModel', '', TRUE);
        $this->CI->load->model('PublicUserModel', '', TRUE);
        $this->CI->load->library('PendingMails');
        $this->CI->load->library('sms');

        if ($institute_name != '') {
            $error_flag = 0;
            $import_count = 0;
            $duplicate_count = 0;
            if ($excel_data) {
                $row_count = count($excel_data);
                $column_count = count($excel_data[1]);
                if ($row_count >= 2) {
                    if ($column_count >= 5) {
                        for ($row = 2; $row <= $row_count; $row++) {
                            $us_sl = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                            $us_fn = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B']; /* First Name */
                            $us_ln = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C']; /* Last Name */
                            $us_mb = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D']; /* Mobile No */
                            $us_em = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E']; /* Email Id */

                            if (!empty($institute_name)) {
                                $us_sl = trim($us_sl);
                                if (empty($us_sl)) {
                                    /* Address column is blank */
                                    $message["status"] = "ERROR";
                                    $message["message"] = "User Salutation can't be blank";
                                    $error_flag = 1;
                                    break;
                                }
                                $us_fn = trim($us_fn);
                                if (empty($us_fn)) {
                                    /* Address column is blank */
                                    $message["status"] = "ERROR";
                                    $message["message"] = "User First Name can't be blank";
                                    $error_flag = 1;
                                    break;
                                }
                                $us_ln = trim($us_ln);
                                if (empty($us_ln)) {
                                    /* Address column is blank */
                                    $message["status"] = "ERROR";
                                    $message["message"] = "User last Name can't be blank";
                                    $error_flag = 1;
                                    break;
                                }
                                $us_mb = trim($us_mb);
                                if (empty($us_mb)) {
                                    /* Address column is blank */
                                    $message["status"] = "ERROR";
                                    $message["message"] = "User contact number can't be blank";
                                    $error_flag = 1;
                                    break;
                                }
                                $us_em = trim($us_em);
                                if (empty($us_em)) {
                                    /* Email Id column is blank */
                                    $message["status"] = "ERROR";
                                    $message["message"] = "User Email Id can't be blank";
                                    $error_flag = 1;
                                    break;
                                }
                            }

                            /**

                              if (isset($user_info) && is_array($user_info)) {
                              try {
                              $sms_content = "From I-STEM Dear Sir/Madam,";
                              $sms_content = $sms_content . "User Registration Successfull";
                              $sms_content = $sms_content . "User name : " . $user_info['user_name'] . "";
                              $sms_content = $sms_content . "Password : " . $user_info['user_password'] . "";
                              $this->sms->sendsms($us_mb, $sms_content);

                              $message["status"] = "SUCCESS";
                              $message["message"] = "Data inserted successful!!";
                              //$this->session->set_flashdata('success_message', $message);
                              //redirect('import/institute/public_users', 'refresh');
                              } catch (Exception $e) {
                              $message["status"] = "SUCCESS";
                              $message["message"] = "User registration submitted<br>You will receive confirmation mail once registration is approved<br>" . "<strong>Notification not sent to ISTEM; Please mail you user details to " + $this->config->item('super_admin_email') + " id</strong>";
                              }
                              } else {
                              /* No Data Imported (Error at the first record itself) */
                            /* 	$message["status"] = "ERROR";
                              $message["message"] = "Could not complete User Registration process";
                              //$this->session->set_flashdata('success_message', $message);
                              } */
                        }

                        if ($error_flag == 0) {
                            /* Data Validated */
                            /* Continue to import the data */
                            for ($row = 2; $row <= $row_count; $row++) {
                                $institute_name = trim($institute_name);
                                if (empty($institute_name)) {
                                    $duplicate_count++;
                                    continue;
                                }

                                $us_sl = (!isset($excel_data[$row]['A']) || $excel_data[$row]['A'] == NULL) ? "" : $excel_data[$row]['A'];
                                $us_fn = (!isset($excel_data[$row]['B']) || $excel_data[$row]['B'] == NULL) ? "" : $excel_data[$row]['B']; /* First Name */
                                $us_ln = (!isset($excel_data[$row]['C']) || $excel_data[$row]['C'] == NULL) ? "" : $excel_data[$row]['C']; /* Last Name */
                                $us_mb = (!isset($excel_data[$row]['D']) || $excel_data[$row]['D'] == NULL) ? "" : $excel_data[$row]['D']; /* Mobile No */
                                $us_em = (!isset($excel_data[$row]['E']) || $excel_data[$row]['E'] == NULL) ? "" : $excel_data[$row]['E']; /* Email Id */

                                $us_an = ""; /* Adhaar No */
                                $us_in = $institute_name; /* User Institute/Organisation */

                                $us_ra = ""; /* Reasearch Area */
                                $in_on = ""; /* Personel number  */
                                $in_ol = ""; /* office landline number  */
                                $in_om = ""; /* Optional mailid  */
                                $in_pr = ""; /* Profile page link */
                                $in_fb = ""; /* facebook profile */
                                $in_tr = ""; /* twitter link */
                                $in_lk = ""; /* linked in  */
                                $in_sk = ""; /* skype id */
                                $in_wt = ""; /* whatsapp */
                                $us_add = ""; /* address */
                                $us_st = ""; /* state */
                                $us_ci = ""; /* city */
                                $us_pn = ""; /* pincode */
                                $us_area = ""; /* research area */
                                $us_expr = ""; /* experience */
                                $us_arex = ""; /* Area Of Expertization */
                                $us_type = ""; /* user type */
                                $us_inst = $institute_name; /* Institute name from dropdown */
                                $us_type = "Academic User"; /* user type */
                                $us_st = ""; /* State */
                                $gstin = ""; /* State */
                                $us_country = "India"; /* COUNTRY */
                                $us_dept = ""; /* department */
                                $us_desi = ""; /* designation */
                                $email_enable_desable_status = '0';


                                /* Check for duplicate agency name */
                                if ($this->CI->PublicUserModel->check_duplicate_email_id($institute_name, $excel_data[$row]['E'])) {
                                    /* Agency name is duplicate; So ignore current record and continue */
                                    $duplicate_count++;
                                    continue;
                                } else {
                                    try {
                                        if ($user_info = $this->CI->PublicUserModel->create_user_id($us_sl, $us_fn, $us_ln, $us_mb, $us_em, $us_in, $us_ra, $us_an, $in_fb, $in_on, $in_om, $in_pr, $in_tr, $in_lk, $in_sk, $in_wt, $in_ol, $us_type, $us_st, $us_add, $us_ci, $us_pn, $gstin, $us_country, $us_dept, $us_desi, $email_enable_desable_status)) {
                                            /*
                                              if (isset($user_info) && is_array($user_info)) {
                                              try {
                                              $sms_content = "From I-STEM Dear Sir/Madam,";
                                              $sms_content = $sms_content . "User Registration Successfull";
                                              $sms_content = $sms_content . "User name : " . $user_info['user_name'] . "";
                                              $sms_content = $sms_content . "Password : " . $user_info['user_password'] . "";
                                              $this->sms->sendsms($us_mb, $sms_content);

                                              $message["status"] = "SUCCESS";
                                              $message["message"] = "Data inserted successful!!";
                                              //$this->session->set_flashdata('success_message', $message);
                                              //redirect('import/institute/public_users', 'refresh');
                                              } catch (Exception $e) {
                                              $message["status"] = "SUCCESS";
                                              $message["message"] = "User registration submitted<br>You will receive confirmation mail once registration is approved<br>" . "<strong>Notification not sent to ISTEM; Please mail you user details to " + $this->config->item('super_admin_email') + " id</strong>";
                                              }
                                              } else {
                                              $message["status"] = "ERROR";
                                              $message["message"] = "Could not complete User Registration process";

                                              } */
                                            $import_count++;
                                        } else {
                                            if ($import_count > 0 or $duplicate_count > 0) {
                                                /* Partial Data Imported */
                                                $message["status"] = "PARTIAL";
                                                $message["message"] = array();
                                                $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate)", $this->CI->PublicUserModel->msg);
                                                $error_flag = 1;
                                            } else {
                                                /* No Data Imported (Error at the first record itself) */
                                                $message["status"] = "ERROR";
                                                $message["message"] = $this->CI->PublicUserModel->msg;
                                                $error_flag = 1;
                                            }
                                            break;
                                        }
                                    } catch (Exception $e) {
                                        $message["status"] = "ERROR";
                                        $message["message"] = $e->getMessage();
                                        $error_flag = 1;
                                    }
                                }
                            }
                            if ($error_flag == 0) {
                                /* No error */
                                /* Create a insert details message */

                                $this->CI->load->library('crypt');
                                $this->CI->load->library('PendingMails');
                                $mail_count = $this->CI->pendingmails->send_pending_mails();

                                $message["status"] = "SUCCESS";
                                $message["message"] = array();
                                $message["message"] = array($import_count . " records imported", $duplicate_count . " records ignored (duplicate/empty)");
                            }
                        }
                    } else {
                        /* Required column data not available */
                        $message["status"] = "ERROR";
                        $message["message"] = "There should be five columns";
                    }
                } else {
                    /* Required row data not available */
                    $message["status"] = "ERROR";
                    $message["message"] = "At least one data row required";
                }
            } else {
                $message["status"] = "ERROR";
                $message["message"] = "No data to import";
            }

            return $message;
        } else {

            $message["status"] = "Error";
            $message["message"] = "You have not selected Institute Name,Please select the Institute Name from drop down!!";
            $this->CI->session->set_flashdata('import_message', $message["message"]);
            redirect('import/institute/public_users', 'refresh');
        }
    }

}

?>
