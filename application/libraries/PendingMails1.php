<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PendingMails {

    public function __construct() {
        $this->CI = & get_instance();
        $this->msg = "";
        $this->token = "";
    }

    public function send_pending_mails() {

        $this->CI->load->model('MailAlertModel', '', TRUE);
        $pending_mails = $this->CI->MailAlertModel->get_pending_mails();
        $notif_message = ' ';
        // $this->array_to_file($pending_mails);
        $this->CI->load->library('crypt');
        $count = 0;
        $attachments = NULL;
        foreach ($pending_mails as $row) {
            $count++;
            $id = $row["id"];

            $dec_user_id = $this->CI->crypt->decrypt_email($row["user_id"]);

            $dec_email_id = $this->CI->crypt->decrypt_email($row["email_id"]);

            $dec_password = $this->CI->crypt->decrypt_email($row["user_password"]);
            $dec_entity_code = $this->CI->crypt->decrypt_email($row["ref_entity_code"]);
            $dec_entity_ref_id = $this->CI->crypt->decrypt_email($row["ref_entity_id"]);

            $subject = ' ';
            if ($dec_entity_code == 'IN') {

                $this->CI->load->model('InstituteModel', '', TRUE);
                $this->CI->load->model('IstemUserModel', '', TRUE);

                $user_name = $this->CI->InstituteModel->get_user_name($dec_user_id);
                $institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                $institute_id = $this->CI->InstituteModel->get_institute_id($institute_name);
                $institute_data = $this->CI->InstituteModel->get_institutelist($institute_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation - ' . $institute_name;

                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";

                $notif_message = $notif_message . "<h2>Institution Registration Confirmation</h2><br>";
                $notif_message = $notif_message . "Name : <strong>" . $institute_name . "</strong><br>";

                $notif_message = $notif_message . "<h3>Below are the login details</h3><br>";
                $notif_message = $notif_message . "Username : <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from = $this->CI->config->item('super_admin_email');
                $mail_sub = 'Institute Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
                
                
                
                
                
                
                
                
                
            } 
            else if ($dec_entity_code == 'BV') {
                
                
                
                $this->CI->load->model('InstituteModel', '', TRUE);
                $this->CI->load->model('IstemUserModel', '', TRUE);

                $user_name = $this->CI->InstituteModel->get_user_name($dec_user_id);
                $institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                $institute_id = $this->CI->InstituteModel->get_institute_id($institute_name);
                $institute_data = $this->CI->InstituteModel->get_institutelist($institute_id);
                
                //sending mail for billdesk
                $subject = 'ISTEM Bank ECS Form - ' . $institute_name;

                $payment_institute_id = $institute_id + 2000;
                $notif_message = " ";
                $notif_message = $notif_message . "<h2>ISTEM Bank ECS Form - " . $institute_name."</h2><br>";
                $notif_message = $notif_message . "Name : <strong>" . $institute_name . "</strong><br>";

                
                $notif_message = $notif_message . "Institution id : <strong>" . $payment_institute_id . "</strong><br>";
                
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                
                $this->CI->load->helper('directory');
                $this->CI->load->library('crypt');
     
                $key = $this->CI->crypt->hash_password($institute_id);
                $attachments = directory_map('./document/bankecsform/' . $key . '/');
                
                
                
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Bank ECS Form';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                
                
                $mail_to = $this->CI->config->item('billdesk_email');
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from = $this->CI->config->item('super_admin_email');
                $mail_sub = 'Bank ECS Form';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
                
            }
            
            else if ($dec_entity_code == 'PU') {
                $this->CI->load->model('PublicUserModel', '', TRUE);


                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);

                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation';
                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";

                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $sss = array(
                    'unm' => $user_name,
                    'usl' => $user_saluation
                );
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from=$this->CI->config->item('super_admin_email');
                $mail_sub = 'User Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $mail_to,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'EX') {
                $user_data = $this->CI->session->userdata('user_data');
                $first_name = $user_data['first_name'];
                $last_name = $user_data['last_name'];
                $user_name = $user_data['user_name'];
                $this->CI->load->model('PublicUserModel', '', TRUE);



                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Expert Registration Confirmation';
                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";
                $notif_message = $notif_message . "<strong>S/he can enable and disable as an Expert on the portal as per their availability. S/he needs to mention their research area (Keyword(s) only) while registering as an expert.</strong><br>";

                $notif_message = $notif_message . "Name : <strong>" . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";

                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $sss = array(
                    'unm' => $user_name
                );
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from=$this->CI->config->item('super_admin_email');
                $mail_sub = 'Expert Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $mail_to,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'RQ') {
                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingModel', '', TRUE);

                $eq_name = $this->CI->BookingModel->get_eq_id($dec_entity_ref_id);
                $req_date = $this->CI->BookingModel->get_req_date($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Booking Request';
                $notif_message = "<h3>ISTEM Booking Request</h3><br>";
                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $req_date . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
            } else if ($dec_entity_code == 'CR') {




                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $eq_name = $this->CI->BookingRequestModel->get_eq_id($dec_entity_ref_id);
                $conf_date = $this->CI->BookingRequestModel->get_req_date($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                
                $user_id = $dec_user_id;
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING CONFIRMATION';
                $notif_message = "<h3>BOOKING CONFIRM</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $conf_date . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
            
                
               $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Booking';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                
                    $mail_from = $this->CI->UserModel->get_user_email($user_id);
                
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                //$mail_from = $this->CI->config->item('super_admin_email');;
                $mail_sub = $subject;
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
                        
            } else if ($dec_entity_code == 'RR') {




                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $eq_name = $this->CI->BookingRequestModel->get_eq_name_forrejected($dec_entity_ref_id);
                $rej_date = $this->CI->BookingRequestModel->get_rej_date($dec_entity_ref_id);
                $reason = $this->CI->BookingRequestModel->get_reason_rejection($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING REJECTION';
                $notif_message = "<h3>BOOKING REJECTION</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $rej_date . "</strong><br>";
                $notif_message = $notif_message . "Reason: <strong>" . $reason . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                
                
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Booking';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                
                    $mail_from = $this->CI->UserModel->get_user_email($user_id);
                
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                //$mail_from = $this->CI->config->item('super_admin_email');;
                $mail_sub = $subject;
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'RC') {

                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $booking_data = $this->CI->BookingRequestModel->get_booking_data($dec_entity_ref_id);
                $contact_data = $this->CI->PublicUserModel->get_user_details($booking_data["public_user_id"]);


                $request_id = $contact_data["user_name"] . '_' . $booking_data["request_id"];
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING || Clarification Required';
                $notif_message = "<h3>BOOKING Clarification</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Request id: <strong>" . $request_id . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $booking_data["equipment_name"] . "</strong><br>";

                $notif_message = $notif_message . "Reason: <strong>" . $reason . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                
                
                 $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Booking';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                
                    $mail_from = $this->CI->UserModel->get_user_email($user_id);
                
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                //$mail_from = $this->CI->config->item('super_admin_email');;
                $mail_sub = $subject;
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            }
            else if ($dec_entity_code == 'PT') {

                
                
                $this->CI->load->model('BookingRequestModel', '', TRUE);
                $booking_list = $this->CI->BookingRequestModel->get_service_request_status_on_confirmation_id($dec_entity_ref_id);

                $payment_id = 'ISTEM_'.$booking_list["request_id"] .$booking_list["confirmation_id"] .'_' . $booking_data["payment_id"];
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING || Payment Done';
                $notif_message = "<h3> Payment</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Request id: <strong>" . $booking_list["puusername"].$booking_list["request_id"] . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $booking_data["equipment_name"] . "</strong><br>";

                $notif_message = $notif_message . "Transaction Id: <strong>" . $payment_id . "</strong><br>";
                $notif_message = $notif_message . "Total Cost: <strong>" . $TxnAmount . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                
                
                
                
                
                
                 $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Booking';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                
                    $mail_from = $this->CI->config->item('super_admin_email');
                
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                //$mail_from = $this->CI->config->item('super_admin_email');;
                $mail_sub = $subject;
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            }
            
            
            else if ($dec_entity_code == '') {
                $this->CI->load->model('PublicUserModel', '', TRUE);


                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation';
                $notif_message = "<h4><pre>Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA), and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.

 

To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.

 

1.       Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.

2.       Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities. Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.

3.       Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge, Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)

4.       Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge. Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).

5.       Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).

6.       Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.

7.       Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users, and fulfil the request (execute the job) AFTER receiving information of payment (if any).

8.       Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work). Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.

9.       Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair), Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.
</pre></h4><br>";

                $notif_message = "<h3>Your I-STEM login details</h3><br>";
                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";

                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                $sss = array(
                    'unm' => $user_name,
                    'usl' => $user_saluation
                );
            }



            try {

                $this->CI->load->library('mailer');
                $this->CI->load->library('crypt');

                $this->CI->mailer->sendmail($dec_email_id, $subject, $notif_message,$attachments);

                $update_condition = array(
                    'id' => $id
                );
                $update_data = array(
                    'email_status' => '1'
                );
                $institute_details = $this->CI->MailAlertModel->update_email_status($update_data, $update_condition);
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        }
        return $count;
    }
public function send_selected_pending_mail($sel_id_array) {

        $this->CI->load->model('MailAlertModel', '', TRUE);
        $pending_mails = $this->CI->MailAlertModel->get_selected_pending_mails($sel_id_array);
        $notif_message = ' ';
        // $this->array_to_file($pending_mails);
        $this->CI->load->library('crypt');
        $count = 0;
        foreach ($pending_mails as $row) {
            $count++;
            $id = $row["id"];

            $dec_user_id = $this->CI->crypt->decrypt_email($row["user_id"]);

            $dec_email_id = $this->CI->crypt->decrypt_email($row["email_id"]);

            $dec_password = $this->CI->crypt->decrypt_email($row["user_password"]);
            $dec_entity_code = $this->CI->crypt->decrypt_email($row["ref_entity_code"]);
            $dec_entity_ref_id = $this->CI->crypt->decrypt_email($row["ref_entity_id"]);

            $subject = ' ';
            if ($dec_entity_code == 'IN') {

                $this->CI->load->model('InstituteModel', '', TRUE);
                $this->CI->load->model('IstemUserModel', '', TRUE);

                $user_name = $this->CI->InstituteModel->get_user_name($dec_user_id);
                $institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation - ' . $institute_name;

                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";

                $notif_message = $notif_message . "<h2>Institution Registration Confirmation</h2><br>";
                $notif_message = $notif_message . "Name : <strong>" . $institute_name . "</strong><br>";

                $notif_message = $notif_message . "<h3>Below are the login details</h3><br>";
                $notif_message = $notif_message . "Username : <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from=$this->CI->config->item('super_admin_email');
               // $mail_from = $this->CI->config->item('super_admin_email');;
                $mail_sub = 'Institute Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $dec_email_id,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'PU') {
                $this->CI->load->model('PublicUserModel', '', TRUE);


                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);

                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation';
                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";

                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $sss = array(
                    'unm' => $user_name,
                    'usl' => $user_saluation
                );
                $user_data = $this->CI->session->userdata('user_data');
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from=$this->CI->config->item('super_admin_email');
                $mail_sub = 'User Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $mail_to,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'EX') {
                $user_data = $this->CI->session->userdata('user_data');
                $first_name = $user_data['first_name'];
                $last_name = $user_data['last_name'];
                $user_name = $user_data['user_name'];
                $this->CI->load->model('PublicUserModel', '', TRUE);



                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Expert Registration Confirmation';
                $notif_message = "<strong>Dear Sir/Madam,</strong><br>";
                $notif_message = $notif_message . "<P><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On 
                            behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA),
                            and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.</h5></P>";
                $notif_message = $notif_message . "<p><h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . "     " . "To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status 
                            (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.</h5></p>";
                $notif_message = $notif_message . "<h5>1.&nbsp;&nbsp;Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after "
                        . "the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.</h5>";
                $notif_message = $notif_message . "<p><h5>2.&nbsp;&nbsp;Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities."
                        . " Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per "
                        . "the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.</h5>";
                $notif_message = $notif_message . "<p><h5>3.&nbsp;&nbsp;Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. "
                        . "Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge,"
                        . " Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)</h5>";
                $notif_message = $notif_message . "<p><h5>4.&nbsp;&nbsp;Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge."
                        . " Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>5.&nbsp;&nbsp;Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the "
                        . "login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).</h5>";
                $notif_message = $notif_message . "<p><h5>6.&nbsp;&nbsp;Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.</h5>";
                $notif_message = $notif_message . "<p><h5>7.&nbsp;&nbsp;Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users,"
                        . " and fulfil the request (execute the job) AFTER receiving information of payment (if any).</h5>";
                $notif_message = $notif_message . "<p><h5>8.&nbsp;&nbsp;Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work)."
                        . " Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.</h5>";
                $notif_message = $notif_message . "<p><h5>9.&nbsp;&nbsp; Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair),"
                        . " Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.</h5>";
                $notif_message = $notif_message . "<strong>S/he can enable and disable as an Expert on the portal as per their availability. S/he needs to mention their research area (Keyword(s) only) while registering as an expert.</strong><br>";

                $notif_message = $notif_message . "Name : <strong>" . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";

                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";

                $notif_message = $notif_message . "<h3>Please call the Nodal Centre / National Coordinator at the Toll Free Number: 1800-425-3281 if you have any question, need clarification or other"
                        . " support in using the Portal.</h3><br>";
                $notif_message = $notif_message . "<strong>Thank you.</strong><br>";
                $notif_message = $notif_message . "<strong>Regards,</strong><br>";
                $notif_message = $notif_message . "<strong>National Coordinator</strong><br>";
                $notif_message = $notif_message . "<strong>I-STEM Team</strong><br>";
                $notif_message = $notif_message . "<strong>Indian Institute of Science, Bangalore</strong>";
                $sss = array(
                    'unm' => $user_name
                );
                $this->CI->load->model('MailBoxModel', '', TRUE);
                $mail_type = 'Registration';
                $user_entity = $user_data['user_entity'];
                $user_id = $user_data['user_id'];
                $this->CI->load->model('UserModel', '', TRUE);
                if ($user_entity == 'PU') {
                    $mail_to = $this->CI->UserModel->get_user_email_using_public_user_id($user_id);
                } else {
                    $mail_to = $this->CI->UserModel->get_user_email($user_id);
                }
                $this->CI->load->library('logdetails');
                $ip = $this->CI->logdetails->get_ip();
                $mail_from=$this->CI->config->item('super_admin_email');
                $mail_sub = 'Expert Registration';
                $mail_content = $notif_message;
                $mail_data = array(
                    'mail_type' => $mail_type,
                    'mail_from' => $mail_from,
                    'mail_to' => $mail_to,
                    'mail_subject' => $mail_sub,
                    'mail_content' => $mail_content,
                    'ip' => $ip,
                    'mail_seen_status' => '0',
                    'last_updated_by' => $user_data['user_name']
                );
                $this->CI->MailBoxModel->insert($mail_data);
            } else if ($dec_entity_code == 'RQ') {
                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingModel', '', TRUE);

                $eq_name = $this->CI->BookingModel->get_eq_id($dec_entity_ref_id);
                $req_date = $this->CI->BookingModel->get_req_date($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Booking Request';
                $notif_message = "<h3>ISTEM Booking Request</h3><br>";
                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $req_date . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
            } else if ($dec_entity_code == 'CR') {




                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $eq_name = $this->CI->BookingRequestModel->get_eq_id($dec_entity_ref_id);
                $conf_date = $this->CI->BookingRequestModel->get_req_date($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING CONFIRMATION';
                $notif_message = "<h3>BOOKING CONFIRM</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $conf_date . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                
                
            } else if ($dec_entity_code == 'RR') {




                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $eq_name = $this->CI->BookingRequestModel->get_eq_name_forrejected($dec_entity_ref_id);
                $rej_date = $this->CI->BookingRequestModel->get_rej_date($dec_entity_ref_id);
                $reason = $this->CI->BookingRequestModel->get_reason_rejection($dec_entity_ref_id);
                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING REJECTION';
                $notif_message = "<h3>BOOKING REJECTION</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $eq_name . "</strong><br>";
                $notif_message = $notif_message . "Booking Date: <strong>" . $rej_date . "</strong><br>";
                $notif_message = $notif_message . "Reason: <strong>" . $reason . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
            } else if ($dec_entity_code == 'RR') {

                $this->CI->load->model('PublicUserModel', '', TRUE);
                $this->CI->load->model('BookingRequestModel', '', TRUE);

                $booking_data = $this->CI->BookingRequestModel->get_booking_data($dec_entity_ref_id);
                $contact_data = $this->CI->PublicUserModel->get_user_details($booking_data["public_user_id"]);


                $request_id = $contact_data["user_name"] . '_' . $booking_data["request_id"];
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'BOOKING || Clarification Required';
                $notif_message = "<h3>BOOKING Clarification</h3><br>";
                // $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                // $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "Request id: <strong>" . $request_id . "</strong><br>";
                $notif_message = $notif_message . "Equipment Name: <strong>" . $booking_data["equipment_name"] . "</strong><br>";

                $notif_message = $notif_message . "Reason: <strong>" . $reason . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
            } else if ($dec_entity_code == '') {
                $this->CI->load->model('PublicUserModel', '', TRUE);


                $user_name = $this->CI->PublicUserModel->get_user_name($dec_user_id);
                $first_name = $this->CI->PublicUserModel->get_first_name($dec_user_id);
                $last_name = $this->CI->PublicUserModel->get_last_name($dec_user_id);
                $user_saluation = $this->CI->PublicUserModel->get_user_saluation($dec_user_id);
                //$institute_name = $this->CI->InstituteModel->get_institute_name($dec_entity_ref_id);
                //send mail
                $subject = 'ISTEM Registration Confirmation';
                $notif_message = "<h4><pre>Thank you for registering with One Nation One Portal for Linking Researchers and Resources, i.e., the Indian Science Technology and Engineering facilities Map (I-STEM). On behalf of the Citizens of India, the I-STEM Team, in association with Office of the Principal Scientific Adviser (PSA), and the Prime Minister Office (PMO), welcomes you and your team to the unique portal which is built to serve the scientific fraternity in a transparent and efficient manner.

 

To log in to the I-STEM portal, please choose the appropriate login credentials. Then, Create the content about your institution/department/Equipment/Project Status (or /Update/Edit content that has already been uploaded). Being in the highest position of “User hierarchy”, you will be able to create and manage following types of user accounts.

 

1.       Institute Representative(s): The Registrar/Principal/Director may create login credential and assign to his/her Representative(s) the responsibilities of looking after the activities of the Institution through Portal, such as, managing Booking Request, Equipment Health monitoring and gathering Usage Statistics, dealing with Grievances, etc. The login credential will be sent through email from the Portal.

2.       Funding Agency(ies),: Funding Agency means the Govt. Agency (DST, DRDO, DBT, etc.) that has provided the grants for procuring eqpt./facilities. Your Institution/Organisation/Institution is requested to FIRST identify and create the funding agency for a GIVEN eqpt. and then upload the details for THAT equipment in specified format (i.e., Excel sheet) as per the guidelines provided on the page itself. In case funds have been provided by YOUR INSTITUTION, please identify the funding agency as “Institution”.

3.       Department(s) and its admin(s): ONLY the Registrar/Principal/Director or his/her Representative has the authority to identify and create login for a Department Admin. Once the Admin of a Department is identified his login credential will be sent from the portal through email. The Admin would be able to create the login credentials for Faculty-in-charge, Faculty Coordinator, Facility(ies) and Operator(s)/Technologist(s)

4.       Faculty In-charge of facility (ies): ONLY the Department Head or his/her Representative/Admin may identify and create login for the Faculty-in-charge. Once the Faculty-in-charge gets the login credential through email from the portal, and then s/he can then create the login credentials for Facility Coordinator (s), Facility(ies), and Operator(s)/Technologist(s).

5.       Facility Coordinator(s): ONLY the Faculty-in-charge or his/her Representative/Admin may identify and create the login for the Facility Coordinator. Once Facility Coordinator gets the login credential through email from the portal, can then create the login credentials for Facility(ies) and Operator(s)/Technologist(s).

6.       Facility(ies): All those in the hierarchy identified above may “create and enter data” for Department(s) and Facility (ies) established in an Institution, as per the guidelines provided on the page.

7.       Operator(s)/Technologist(s): S/he can add the Equipment and maintain the equipment booking calendar, approve requests (to use eqpt.) received from Internal/External Users, and fulfil the request (execute the job) AFTER receiving information of payment (if any).

8.       Public User(s) may register themselves to the portal (as explained on the portal) and send a request to book ANY equipment listed on the portal (that is needed for their R&D work). Once the relevant Equipment Technologist/Operator(s) approve their request, Users may plan to make a payment requested by the Equipment Technologist/Operator(s); the Users may then visit the Institute as per the schedule provided to them.

9.       Funding Agency Admin: Funding Agencies of the GoI may also create login credentials for different Section-in-charge to look after the status of the equipment funded by the Agencies, e.g., as eqpt. health (Up/Down/Under repair), Usage statistics. Through the I-STEM Portals, Section-in-charge may also request the PI of the project (under which a given eqpt. has been procured) to submit the Project Technical Report that may be due, etc. The login credential will sent to all the section incharge through the portal.
</pre></h4><br>";

                $notif_message = "<h3>Your I-STEM login details</h3><br>";
                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";

                $notif_message = $notif_message . "Name : <strong>" . $user_saluation . " " . $first_name . " " . $last_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Username: <strong>" . $user_name . "</strong><br>";
                $notif_message = $notif_message . "I-STEM Password : <strong>" . $dec_password . "</strong><br>";
                $notif_message = $notif_message . "URL : " . $this->CI->config->item('base_url') . "<br>";
                // $notif_message = $notif_message . "URL : " . $this->config->item('base_url') . "<br>";
                $sss = array(
                    'unm' => $user_name,
                    'usl' => $user_saluation
                );
            }



            try {

                $this->CI->load->library('mailer');
                $this->CI->load->library('crypt');

                $this->CI->mailer->sendmail($dec_email_id, $subject, $notif_message);

                $update_condition = array(
                    'id' => $id
                );
                $update_data = array(
                    'email_status' => '1'
                );
                $institute_details = $this->CI->MailAlertModel->update_email_status($update_data, $update_condition);
            } catch (Exception $e) {
                $err_msg = $e->getMessage();
            }
        }
        return $count;
    }

}
