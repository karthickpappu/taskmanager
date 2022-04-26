<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu {

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('MenuModel', '', TRUE);
    }

    public function get_menu_items2($user_entity, $parent_id = 0, $user_full_name = 'Account ') {

        $user_data = $this->CI->session->userdata('user_data');
        $this->CI->load->library('crypt');
        $encrypt_user_name = $this->CI->crypt->encrypt_email(date('dd-mmm-yyyy') . $user_data["user_name"] . date('dd-mmm-yyyy'));
        $enc_user_name = base64_encode($encrypt_user_name);
        $this->CI->load->library('validation');
        $inst_token = $this->CI->validation->gen_token(array($user_data['institute_id'], "IN"));

        if ($user_entity == "IS") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Masters&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/account_types\">Bank Account Types</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_types\">Funding Agency Type</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/usage_types\">Usage Types</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute_categories\">Institution Categories</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance_reason\">Grievance Reason</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/offline_methods\">Offline Payment <br/> Methods</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_status\">Equipment Status</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_zones\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_uom\">Equipment UOM</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/whats_new\">What's New</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_category\">Equipment Category</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts_for_cart\">Alerts for Cart Expiry</a></li>";
            //  $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/research_area\">Research Area</a></li>";
            //  $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/faq\">FAQ</a></li>";



            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';

            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/sub_nodal_admin\">Create Sub admin</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_admin\">Create Regional admin</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_agency\">Funding Agency</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institutes\">Institutions</a></li>";
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/departments\">Departments</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts\">Alerts</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/announcements\">Announcements</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/users\">Users</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/logdetails\">Log Details</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/pendingmails\">Pending Mails</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance\">Grievance</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "AllClusterAdmin/\">All Cluster</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "manual/alerts\">Manual Alerts/Reminders</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "automatic/alerts\">Automatic Alerts/Reminders</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisors\">Supervisor</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_down_config\">Equipment Down Configuration</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institutes\">Institutions</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/departments\">Departments</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/public_users\">Public Users</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";


            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/gst_report\">GST Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/feedback_report\">Feedback Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/schemewise\">Schemewise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/dashboard\">Inst. Progress Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/institutewise_report\">Institutewise Report(supervisor)</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts_report\">Alerts or Reminders Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "istem-dashboard-home\">Comsol Dashboard</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "SB") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Masters&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/account_types\">Bank Account Types</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_types\">Funding Agency Type</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/usage_types\">Usage Types</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute_categories\">Institution Categories</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance_reason\">Grievance Reason</a></li>";
            //  $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/schemes\">Schemes</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/offline_methods\">Offline Payment Methods</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_status\">Equipment Status</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_zones\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_uom\">Equipment UOM</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/whats_new\">What's New</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_category\">Equipment Category</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts_for_cart\">Alerts for Cart Expiry</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';

            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/sub_nodal_admin\">Create Sub admin</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_admin\">Create Regional admin</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_agency\">Funding Agency</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institutes\">Institutions</a></li>";
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/departments\">Departments</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts\">Alerts</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/announcements\">Announcements</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/users\">Users</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/logdetails\">Log Details</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/pendingmails\">Pending Mails</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance\">Grievance</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "All-Cluster-Table/\">All Clusters</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "manual/alerts\">Manual Alerts/Reminders</a></li>";
      $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/equipment_down_config\">Equipment Down Configuration</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institutes\">Institutions</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/departments\">Departments</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/public_users\">Public Users</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/gst_report\">GST Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/feedback_report\">Feedback Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/schemewise\">Schemewise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/dashboard\">Inst. Progress Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/institutewise_report\">Institutewise Report(supervisor)</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/alerts_report\">Alerts or Reminders Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "istem-dashboard-home\">Comsol Dashboard</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "ND") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . $this->get_cluster_sub_menu($user_entity, $role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institutes\">Institutions</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance\">Grievance</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href='#'>Not Accessible</a></li>";
            if ($user_entity != "ND") {
                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";

                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
                $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/dashboard\">Inst. Progress Report</a></li>";
            }

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "IN") {
            /*    $menu_items = '<nav class="navbar navbar-default">';
              $menu_items = $menu_items . '<div class="container-fluid">';
              $menu_items = $menu_items . '<div class="navbar-header">';
              $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
              $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
              $menu_items = $menu_items . '<span class="icon-bar"></span>';
              $menu_items = $menu_items . '<span class="icon-bar"></span>';
              $menu_items = $menu_items . '<span class="icon-bar"></span>';
              $menu_items = $menu_items . '</button>';
              $menu_items = $menu_items . '</div>';
              $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


              $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
              $menu_items = $menu_items . '<li class="dropdown">';
              $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
              $menu_items = $menu_items . '<ul class="dropdown-menu">';

              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institution\">Institution</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/tpdcell\">ETG Digital Catalogue</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/funding_agency\">Funding Agency</a></li>";

              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/departments\">Departments</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/facilities\">Facilities</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculties\">Faculties</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department\">Department</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/faculties\">Faculty Incharge</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/facilities\">Facilities</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipments/active\">Equipment</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance\">Grievance</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications\">Publications</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents\">Patents</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";

              $menu_items = $menu_items . '</ul>';
              $menu_items = $menu_items . '</li>';
              $menu_items = $menu_items . '</ul>';


              $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
              $menu_items = $menu_items . '<li class="dropdown">';
              $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
              $menu_items = $menu_items . '<ul class="dropdown-menu">';
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/departments\">Departments</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";


              $menu_items = $menu_items . '</ul>';
              $menu_items = $menu_items . '</li>';
              $menu_items = $menu_items . '</ul>';
              $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
              $menu_items = $menu_items . '<li class="dropdown">';
              $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
              $menu_items = $menu_items . '<ul class="dropdown-menu">';
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";

              //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/regional_centres\">Regional Zones</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
              //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/gst_report\">GST Report</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/feedback_report\">Feedback Report</a></li>";

              $menu_items = $menu_items . '</ul>';
              $menu_items = $menu_items . '</li>';
              $menu_items = $menu_items . '</ul>';
              $menu_items = $menu_items . '</div>';
              $menu_items = $menu_items . '</div>';
              $menu_items = $menu_items . '</nav>';
             */
            //
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . $this->get_sub_menu2($role, $parent_id);
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institution/institutedetail/" . $user_data['institute_id'] . '/' . $inst_token . "\">" . 'Upload Institution Logo' . "</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institution/upload_logo/" . $user_data['institute_id'] . "\">Upload Institution Logo</a></li>";
            /* $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institution\">Institution</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/funding_agency\">Funding Agency</a></li>"; */

            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/departments\">Departments</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."master/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            /*  $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department\">Department</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/faculties\">Faculty Incharge</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/facilities\">Facilities</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipments/active\">Equipment</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/grievance\">Grievance</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>"; */
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/tpdcell\">ETG Digital Catalogue</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue\">ETG Digital Catalogue</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue\">ETG Digital Catalogue</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            $menu_items = $menu_items . $this->get_integration_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/add\">Submit Inst. Progress Report</a></li>";
            $menu_items = $menu_items . $this->get_event_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/debit_head/\">Debit Head</a></li>";
            //4   $menu_items = $menu_items . $this->get_sub_menu($role, $parent_id);
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects/\">Projects</a></li>";
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "institution/project/list\">My Projects</a></li>";
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "custodian/project/list\">Custodian Projects</a></li>";
            //            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "integration/pu_projects/\">Public User's Projects</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/departments\">Departments</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/public_users\">Public Users</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/gst_report\">GST Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/feedback_report\">Feedback Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/dashboard\">Inst. Progress Report</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/deb_headwise_report\">Debit Headwise Reports</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/statement_of_accounts/report\">Statement Of Accounts(Supervisor Wise)</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
            //
        } else if ($user_entity == "DP") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue\">ETG Digital Catalogue</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/departmentlist\">Department</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/departmentlist/facultyincharge\">Faculty Incharge</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/facility\">Facilities</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/equipment\">Equipment</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . $this->get_cus_sub_menu($role, $parent_id);
            $menu_items = $menu_items . $this->get_event_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/debit_head/\">Debit Head</a></li>";
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";



            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/deb_headwise_report\">Debit Headwise Reports</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/statement_of_accounts/report\">Statement Of Accounts(Supervisor Wise)</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "FI") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/faculties/departmentlist\">Department</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/facilities\">Facilities</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/equipment\">Equipment</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . $this->get_cus_sub_menu($role, $parent_id);
            $menu_items = $menu_items . $this->get_event_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/debit_head/\">Debit Head</a></li>";
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/deb_headwise_report\">Debit Headwise Reports</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/statement_of_accounts/report\">Statement Of Accounts(Supervisor Wise)</a></li>";


            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "FC") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/facilities/departmentlist\">Department</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/facilitylist\">Facilities</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/equipment\">Equipment</a></li>";
            //  $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . $this->get_cus_sub_menu($role, $parent_id);
            $menu_items = $menu_items . $this->get_event_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/debit_head/\">Debit Head</a></li>";
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Upload&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/institute/equipments\">Equipment</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/deb_headwise_report\">Debit Headwise Reports</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/statement_of_accounts/report\">Statement Of Accounts(Supervisor Wise)</a></li>";


            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "OP") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/operators\">Operators/Technologist</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/department/equipment\">Equipment</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/user_query\">User Query</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipments/active\">Equipment</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Reports</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "institution/project/list\">My Projects(Mode 2 Projects)</a></li>";
            $menu_items = $menu_items . $this->get_event_sub_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/debit_head/\">Debit Head</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/deb_headwise_report\">Debit Headwise Reports</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supervisor/statement_of_accounts/report\">Statement Of Accounts(Supervisor Wise)</a></li>";



            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "FA") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';


            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_agency\">Funding Agency</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/funding_schemes\">Schemes</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/fundingagency/projects\">Sanctioned Projects</a></li>";

            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/fundingagency/instituions\">Institutions</a></li>";



            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/fundingagency/equipment\">Equipment</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "investigators_projects/\">Investigators Projects(Mode 2 Projects)</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "All-Cluster-Table/\">All Clusters</a></li>";

            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';



            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">Reports&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Dashboard</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue/etgdashboard\">ETG Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/institute/equipment/pending_service_request\">Service Request</a></li>";

            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "import/regional_centres\">Regional Zones</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/booking_statistics\">Booking Statistics</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/equipmentwise\">Equipmentwise</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/facilities\">Facilities</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculties\">Faculties</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharges\">Facility Incharges</a></li>";
            //$menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."import/institute/department/faculty/facility_incharge/operators\">Operators</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/userwise\">Userwise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/report/schemewise\">Schemewise</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "progressreport/dashboard\">Inst. Progress Report</a></li>";



            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';
        } else if ($user_entity == "PU") {
            $menu_items = '<nav class="navbar navbar-default">';
            $menu_items = $menu_items . '<div class="container-fluid">';
            $menu_items = $menu_items . '<div class="navbar-header">';
            $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false" aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
            $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '<span class="icon-bar"></span>';
            $menu_items = $menu_items . '</button>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';
            $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
            $menu_items = $menu_items . '<li class="dropdown">';
            $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top: 2px;">View/Booking&nbsp;&nbsp;<span class="caret"></span></a>';
            $menu_items = $menu_items . '<ul class="dropdown-menu">';
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/status\">Booking Requests</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/submitpatent\">Submit Patents</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/sumitpublication\">Submit Publications</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/projectreport\">Submit Project Report</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "publications/\">Publications</a></li>";
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "patents/\">Patents</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "projects\">Projects</a></li>";
            $menu_items = $menu_items . $this->get_public_user_menu($role, $parent_id);
            $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "digitalcatalogue\">ETG Digital Catalogue</a></li>";
            //$menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/tpdcell\">TPD Cell</a></li>";
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</li>';
            $menu_items = $menu_items . '</ul>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</div>';
            $menu_items = $menu_items . '</nav>';

            /*
              $menu_items = "<div id=\"main-nav\" class=\"stellarnav\">";
              $menu_items = $menu_items . "<ul>";
              $menu_items = $menu_items . "<li><a href=\"\">View/Booking</a>";
              $menu_items = $menu_items . "<ul>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/status\">Booking Requests</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/submitpatent\">Submit Patents</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/sumitpublication\">Submit Publications</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/projectreport\">Submit Project Report</a></li>";
              $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequest/tpdcell\">TPD Cell</a></li>";
              $menu_items = $menu_items . "</ul>";
              $menu_items = $menu_items . "<li><a href=\"#\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>";

              $menu_items = $menu_items . "<li></li>";

              $menu_items = $menu_items . "</div>";
             */
        } else {
            $menu_items = "<div id=\"main-nav\" class=\"stellarnav\">";
            $menu_items = $menu_items . "<ul>";
            // $menu_items = $menu_items . "<li><a href=\"\">View/Booking</a>";
            $menu_items = $menu_items . "<ul>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequesr/status\">Booking Requests</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequesr/submitpatent\">Submit Patents</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequesr/sumitpublication\">Submit Publications</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequesr/projectreport\">Submit Project Report</a></li>";
            // $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/bookingrequesr/tpdcell\">TPD Cell</a></li>";
            $menu_items = $menu_items . "<li></li>";
            $menu_items = $menu_items . "</div>";
        }
        return $menu_items;
    }

    public function get_menu_items($role, $parent_id = 0, $user_full_name = 'Account ') {
        $menu = $this->get_menu_items2($role, $parent_id, $user_full_name);
        return $menu;
        /*
          $menu_items = "<div class=\"navbar navbar-default\" role=\"navigation\">";
          $menu_items = $menu_items."<div class=\"navbar-header\">";
          $menu_items = $menu_items."<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">";
          $menu_items = $menu_items."<span class=\"sr-only\">Toggle navigation</span>";
          $menu_items = $menu_items."<span class=\"icon-bar\"></span>";
          $menu_items = $menu_items."<span class=\"icon-bar\"></span>";
          $menu_items = $menu_items."<span class=\"icon-bar\"></span>";
          $menu_items = $menu_items."</button>";
          $menu_items = $menu_items."<a class=\"navbar-brand\" href=\"".$this->CI->config->item('base_url')."home"."\">".$this->CI->config->item('app_name')."</a>";
          $menu_items = $menu_items."</div>";
          $menu_items = $menu_items."<div class=\"navbar-collapse collapse\">";
          $menu_items = $menu_items."<ul class=\"nav navbar-nav\">";
          $menu_items = $menu_items.$this->get_menu($role, $parent_id);
          $menu_items = $menu_items."</ul>";

          $menu_items = $menu_items."<ul class=\"nav navbar-nav navbar-right\">";
          $menu_items = $menu_items."<li><a href=\"#\">".$user_full_name."<span class=\"caret\"></span></a>";
          //$menu_items = $menu_items."<li><a href=\"#\"><div style=\"background-image:url('".$this->CI->config->item('base_url')."images/login.png'); background-size: 24px 24px; background-repeat: no-repeat; height:24px; width:24px; margin: 0 auto; float:left; \"></div>Account <span class=\"caret\"></span></a>";
          $menu_items = $menu_items."<ul class=\"dropdown-menu\">";
          $menu_items = $menu_items."<li><a href=\"#\">Profile</a></li>";
          $menu_items = $menu_items."<li><a href=\"#\">Change Password</a></li>";
          $menu_items = $menu_items."<li class=\"divider\"></li>";
          $menu_items = $menu_items."<li><a href=\"".$this->CI->config->item('base_url')."logout\">Logout</a></li>";
          $menu_items = $menu_items."</ul>";
          $menu_items = $menu_items."</div></div>";
          return $menu_items; */
    }

    public function get_menu($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_sub_menu($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_sub_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_sub_menu2($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_cust_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_dropdown2($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_sub_menu2($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_integration_sub_menu($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_integration_sub_menu($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_cust_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_integration_sub_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_cus_sub_menu($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_cus_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_cus_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_cus_sub_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_public_user_menu($role, $parent_id) {

        $menu_items = '';
        $result = $this->CI->MenuModel->get_pu_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_pu_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_public_user_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_event_sub_menu($role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_event_menu_items($parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_event_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_event_sub_menu($role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_cluster_sub_menu($user_entity, $role, $parent_id) {
        $menu_items = '';
        $result = $this->CI->MenuModel->get_cluster_menu_items($user_entity, $role, $parent_id);
        if ($result) {
            foreach ($result as $row) {
                $submenu_result = $this->CI->MenuModel->is_cluster_dropdown($row->menu_id);
                $is_sub_menu = false;
                if ($submenu_result) {
                    $submenu_row = $submenu_result[0];
                    if ($submenu_row->sub_menus > 0)
                        $is_sub_menu = true;
                }
                if ($is_sub_menu) {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "<span class=\"caret\"></a>";
                    $menu_items = $menu_items . "<ul class=\"dropdown-menu\">";
                    $menu_items = $menu_items . $this->get_cluster_sub_menu($user_entity, $role, $row->menu_id);
                    $menu_items = $menu_items . "</ul></li>";
                } else {
                    $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . $row->menu_link . "\">" . $row->menu_name . "</a></li>";
                }
            }
        }
        return $menu_items;
    }

    public function get_supplier_admin_menu($role, $parent_id = 0) {

        $menu_items = '<nav class="navbar navbar-default">';
        $menu_items = $menu_items . '<div class="container-fluid">';
        $menu_items = $menu_items . '<div class="navbar-header">';
        $menu_items = $menu_items . '<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar_pu" aria-expanded="false"
    aria-controls="navbar_pu" style="background-color:white;padding:8px;">';
        $menu_items = $menu_items . '<span class="sr-only">Toggle navigation</span>';
        $menu_items = $menu_items . '<span class="icon-bar"></span>';
        $menu_items = $menu_items . '<span class="icon-bar"></span>';
        $menu_items = $menu_items . '<span class="icon-bar"></span>';
        $menu_items = $menu_items . '</button>';
        $menu_items = $menu_items . '</div>';
        $menu_items = $menu_items . '<div id="navbar_pu" class="navbar-collapse collapse" style="margin-top:3px">';
        $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
        $menu_items = $menu_items . '<li class="dropdown">';
        $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
    style="padding-top: 2px;">Masters&nbsp;&nbsp;<span class="caret"></span></a>';
        $menu_items = $menu_items . '<ul class="dropdown-menu">';
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/product_category\">Product Category</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/currency/list\">Currency</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/tax/list\">Tax Reference</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/region/list\">Region</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/country/list\">Country</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/stock_status_master/list\">Stock Status Master</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/supplier/delivery/status/master/list\">Supplier Delivery Status</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/service/delivery/status/master/list\">Service Provider Delivery Status</a></li>";
        $menu_items = $menu_items . '</ul>';
        $menu_items = $menu_items . '</li>';
        $menu_items = $menu_items . '</ul>';
        $menu_items = $menu_items . '<ul class="nav navbar-nav navbar-left" role="navigation">';
        $menu_items = $menu_items . '<li class="dropdown">';
        $menu_items = $menu_items . '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
    style="padding-top: 2px;">Create/View&nbsp;&nbsp;<span class="caret"></span></a>';
        $menu_items = $menu_items . '<ul class="dropdown-menu">';
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "master/supplier\">Supplier and Services</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "supplier/requested_users\">Request for conversion</a></li>";
        $menu_items = $menu_items . "<li><a href=\"" . $this->CI->config->item('base_url') . "disabled/supplier/service_provider/list\">Disable Supplier/Service Provider List</a></li>";
        $menu_items = $menu_items . '</ul>';
        $menu_items = $menu_items . '</li>';
        $menu_items = $menu_items . '</ul>';
        $menu_items = $menu_items . '</div>';
        $menu_items = $menu_items . '</div>';
        return $menu_items;
    }

}
