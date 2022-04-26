<?php
//include("/var/www/html/Alerts/db.php");
require_once '/var/www/html/application/Alerts/db.php';

function check_db() {
  $db_conn = new DB_CONNECT();
  $db_conn->connect();
  if($db_conn->connected == 0)
  {
    exit(0);
  }
}

function verify_contact_users() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query = 'select user_email,user_id from public_users where phone_verified=0 and user_status=1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function verify_emailid_users() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query = 'select user_email,user_contactno,user_id from public_users where email_verified=0 and user_status=1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function verify_email_and_cont_users() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select user_email,user_contactno,user_id';
  $query .= ' from public_users';
  $query .= ' where email_verified=0';
  $query .= ' and phone_verified=0';
  $query .= ' and user_status=1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function alerts_complete_user_profile() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select pu.user_email,pu.user_id';
  $query .= ' from public_users as pu';
  $query .= ' where (pu.user_firstname = "" OR pu.user_email = "" OR pu.user_contactno = "" OR pu.user_research_area = ""
  OR pu.user_country = "" OR pu.state = "" OR pu.facebook_profile = "" OR pu.twitter_link = ""
  OR pu.linked_in = "" OR pu.skype_id = "" OR pu.whatsapp_no = "")';
  $query .= ' and pu.user_status=1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function alerts_institute_approval() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select COUNT(i.institute_id) as institute_count';
  $query .= ' from institutes as i';
  $query .= ' where i.institute_status = 3';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row['institute_count']; // Inside while loop
  }
  return $res;
}

function get_institute_name() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select institute_name';
  $query .= ' from institutes as i';
  $query .= ' where i.institute_status = 3';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function alerts_fund_agen_approval() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select COUNT(f.fund_agen_id) as fund_count';
  $query .= ' from funding_agency as f';
  $query .= " where f.fund_type LIKE '%External Funding%'";
  $query .= ' and f.status = 0';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row['fund_count']; // Inside while loop
  }
  return $res;
}

function get_funding_agency_name() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select f.fund_agen_name';
  $query .= ' from funding_agency as f';
  $query .= " where f.fund_type LIKE '%External Funding%'";
  $query .= ' and f.status = 0';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function alerts_equipment_approval() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select COUNT(e.equipment_id) as eq_count,i.institute_name';
  $query .= ' from equipments as e';
  $query .= ' join institutes as i on i.institute_id = e.institute_id';
  $query .= ' where e.equipment_status = 3';
  $query .= ' and i.institute_status = 1';
  $query .= ' group by i.institute_name';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_institute_id() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select institute_id,institute_email,institute_name';
  $query .= ' from institutes';
  $query .= ' where institute_status = 1';
  $query .= ' group by institute_id,institute_email,institute_name';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_institute_email($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  =  ' select ist.user_email,ist.user_id';
  $query .= ' from istem_users as ist';
  $query .= ' join users_entity_mapping as uem on uem.user_id = ist.user_id';
  $query .= ' join institutes as i on i.institute_id = uem.entity_ref_id';
  $query .= " where i.institute_id = '{$institute_id}'";
  $query .= ' and ist.user_status = 1';
  $query .= " OR (uem.user_role = 'Institute Admin User'";
  $query .= " AND uem.user_role = 'Institute Representative')";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function check_institute_gst_exists($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select i.institute_id';
  $query .= ' from institutes as i';
  $query .= ' where NOT EXISTS (SELECT *';
  $query .= ' FROM  institute_gst_percentage as gst';
  $query .= ' where gst.institute_id = i.institute_id)';
  $query .= " and  i.institute_id = '{$institute_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_dept_id_based_on_institute($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select d.dept_id';
  $query .= ' from departments as d';
  $query .= ' join institutes as i on d.institute_id = i.institute_id';
  $query .= ' left join equipments as eq on eq.equipment_department_id = d.dept_id';
  $query .= " where  i.institute_id = '{$institute_id}'";
  $query .= ' group by d.dept_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_equipment_id_based_on_institute($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  =  ' select e.equipment_id,i.institute_id,i.institute_email,dp.dept_id,fc.fac_id,u.user_id';
  $query .= ' from equipments as e';
  $query .= ' left join departments as dp on dp.dept_id=e.equipment_department_id';
  $query .= ' left join facilities as fc on fc.fac_id = e.equipment_facility_id';
  $query .= ' join institutes as i on i.institute_id=e.institute_id';
  $query .= ' join users_entity_mapping as eam on eam.entity_ref_id = i.institute_id';
  $query .= ' join istem_users as u on u.user_id = eam.user_id';
  $query .= ' left join states as s on i.institute_state = s.state_name';
  $query .= ' left join sample_list as sl on e.equipment_id = sl.equipment_id';
  $query .= ' where e.equipment_status = 1';
  $query .= " and i.institute_id  ='{$institute_id}'";
  $query .= ' group by e.equipment_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_usage_type_for_equipment($equipment_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select ust.usage_type';
  $query .= ' from equipments as eq';
  $query .= ' left join equipment_usage_types as ust on 1=1';
  $query .= ' left join equipment_usage_rates as eqr on ust.usage_type=eqr.usage_type and eqr.equipment_id=eq.equipment_id';
  $query .= " where eq.equipment_id  = '{$equipment_id}'";
  //$query .= " group by eq.equipment" ;
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function check_usage_rate($type,$equipment_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select COUNT(eqr.usage_rate_id) as eq_count , eq.equipment_name';
  $query .= ' from equipments as eq';
  $query .= ' left join equipment_usage_rates as eqr on eqr.equipment_id=eq.equipment_id';
  $query .= " where eq.equipment_id = '{$equipment_id}'";
  $query .= " and eqr.usage_type IN ('" . implode("', '", $type) . "')";
  $query .= " and eqr.usage_rate IN ('','0')";
  //$query .= " group by eqr.usage_rate_id";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_allocated_list_public_user() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select COUNT(bc.confirmation_id) as eq_cnt,p.user_email,p.user_id';
  $query .= ' from booking_request as br';
  $query .= ' left join booking_confirmation as bc on bc.request_id = br.request_id';
  $query .= ' inner join service_request_form as sr on sr.request_id = br.request_id';
  $query .= ' left join payment as pt on bc.confirmation_id=pt.confirmation_id';
  $query .= ' left join public_users as p on p.user_id = br.public_user_id';
  $query .= ' where bc.request_id IS NOT NULL';
  $query .= ' and pt.confirmation_id IS NULL ';
  $query .= ' and p.user_status=1';
  $query .= ' group by br.public_user_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}


function get_facility_list($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select fac.fac_id,ins.institute_email';
  $query .= ' from facilities as fac';
  $query .= ' left join faculties as fi on fac.faculty_id = fi.faculty_id';
  $query .= ' join departments as dp on fac.dept_id = dp.dept_id';
  $query .= ' join institutes as ins on ins.institute_id = dp.institute_id';
  $query .= " where ins.institute_id = '{$institute_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_dept_id_from_fac_id($fac_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select dp.dept_id';
  $query .= ' from facilities as fc';
  $query .= ' join departments as dp on fc.dept_id = dp.dept_id';
  $query .= " where fc.fac_id = '{$fac_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_facility_mapped_equipments($fac_id,$dept_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select eq.equipment_id';
  $query .= ' from facilities as f';
  $query .= ' left join equipments as eq on f.fac_id=eq.equipment_facility_id';
  $query .= ' left join funding_agency as fn on eq.equipment_agency_id = fn.fund_agen_id';
  $query .= ' left join departments as dp on dp.dept_id=f.dept_id';
  $query .= ' left join facilities as fac on dp.dept_id=fac.dept_id';
  $query .= " where eq.equipment_facility_id = '{$fac_id}'";
  $query .= " and eq.equipment_department_id = '{$dept_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_facility_non_mapped_equipments($institute_id, $mapped_equipment_id_array,$dept_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select count(eq.equipment_id) as eq_count';
  $query .= ' from equipments as eq';
  $query .= ' left join departments as dp on dp.dept_id=eq.equipment_department_id';
  $query .= ' left join funding_agency as fn on eq.equipment_agency_id = fn.fund_agen_id';
  $query .= ' left join facilities as fac on eq.equipment_facility_id=fac.fac_id';
  $query .= " where eq.institute_id = '{$institute_id}'";
  $query .= " and eq.equipment_department_id = '{$dept_id}'";
  if($mapped_equipment_id_array){
    if(sizeof($mapped_equipment_id_array) > 0 ){
      $query .= " and eq.equipment_id NOT IN ('" . implode("', '", $mapped_equipment_id_array) . "')";
      //$query .= " and f.fac_id NOT IN '{$mapped_facility_id_array}'";
    }
  }
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row; // Inside while loop
  }
  return $res;
}

function get_operator_list($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select o.operator_id,i.institute_email,iu.user_id';
  $query .= ' from operators o';
  $query .= ' join istem_users as iu on o.user_id=iu.user_id';
  $query .= ' join users_entity_mapping as uem on uem.user_id=iu.user_id';
  $query .= ' join departments as dp on dp.dept_id = uem.entity_ref_id';
  $query .= ' join institutes as i on i.institute_id = dp.institute_id';
  $query .= " where i.institute_id = '{$institute_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_mapped_dept_id($operator_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select dept_id as dept_id,d.dept_email';
  $query .= ' from departments d';
  $query .= ' join users_entity_mapping as uem on d.dept_id = uem.entity_ref_id';
  $query .= ' join operators as op on op.user_id = uem.user_id';
  $query .= "  where op.operator_id = '{$operator_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_mapped_equipments($operator_id, $dept_id_list) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select oem.equipment_id';
  $query .= ' from operator_equipment_mapping as oem';
  $query .= ' join equipments as eq on oem.equipment_id=eq.equipment_id';
  $query .= ' left join departments as dp on dp.dept_id=eq.equipment_department_id';
  $query .= ' left join funding_agency as fn on eq.equipment_agency_id = fn.fund_agen_id';
  $query .= " where oem.operator_id = '{$operator_id}'";
  if($dept_id_list){
    if(sizeof($dept_id_list) > 0 ){
      $query .= " and eq.equipment_department_id IN ('" . implode("', '", $dept_id_list) . "')";
      //$query .= " and f.fac_id NOT IN '{$mapped_facility_id_array}'";
    }
  }
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function get_non_mapped_equipments($institute_id, $operator_id, $mapped_equipment_id_array, $dept_id_array) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select count(eq.equipment_id) as eq_count';
  $query .= ' from equipments as eq';
  $query .= ' left join departments as dp on dp.dept_id=eq.equipment_department_id';
  $query .= ' left join funding_agency as fn on eq.equipment_agency_id = fn.fund_agen_id';
  $query .= ' join institutes as ins on eq.institute_id=ins.institute_id';
  $query .= " where eq.institute_id = '{$institute_id}'";
  $query .= ' and eq.equipment_status = 1';
  if($mapped_equipment_id_array){
    if(sizeof($mapped_equipment_id_array) > 0 ){
      $query .= " and eq.equipment_id NOT IN ('" . implode("', '", $mapped_equipment_id_array) . "')";
    }
  }
  if($dept_id_array){
    if(sizeof($dept_id_array) > 0 ){
      $query .= " and eq.equipment_department_id IN ('" . implode("', '", $dept_id_array) . "')";
    }
  }
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row; // Inside while loop
  }
  return $res;

}

function get_user_list($dept_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select i.user_email as user_email,i.user_id';
  $query .= ' from istem_users i';
  $query .= ' join users_entity_mapping as u on u.user_id = i.user_id';
  $query .= ' where u.entity_id = 4';
  //$query .= " and u.entity_ref_id IN ('" . implode("', '", $dept_id) . "')";
  $query .= " and u.entity_ref_id = '{$dept_id}'";
  $query .= " and i.user_status = 1";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_mapped_operator($equipment_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select o.user_email,o.user_id';
  $query .= ' from operator_equipment_mapping oem';
  $query .= ' join operators as o  on oem.operator_id = o.operator_id';
  $query .= ' join equipments eq  on eq.equipment_id = oem.equipment_id';
  $query .= " where eq.equipment_id = '{$equipment_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_faculty_user_list_for_department_on_dept_id($dept_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select f.faculty_id,f.user_email,ist.user_id';
  $query .= ' from faculties as f';
  $query .= ' join users_entity_mapping as uem on f.user_id=uem.user_id';
  $query .= ' left join istem_users as ist on ist.user_id=uem.user_id';
  $query .= ' where uem.entity_id = 5';
  //$query .= " and uem.entity_ref_id IN ('" . implode("', '", $dept_id) . "')";
  $query .= " and uem.entity_ref_id  = '{$dept_id}'";
  $query .= " and ist.user_status = 1";
  $query .= ' group by f.faculty_id,f.user_email';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_details_for_eqipment($equipment_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select e.equipment_id, i.institute_id,e.equipment_facility_id,e.equipment_department_id';
  $query .= ' from equipments e ';
  $query .= ' left join departments as d on e.equipment_department_id = d.dept_id';
  $query .= ' left join facilities as f on e.equipment_facility_id = f.fac_id';
  $query .= ' left join funding_agency as fn on e.equipment_agency_id = fn.fund_agen_id';
  $query .= ' left join project as p on e.equipment_project_id = p.project_id';
  $query .= ' join institutes as i on e.institute_id = i.institute_id';
  $query .= ' left join states as s on i.institute_state = s.state_name';
  $query .= ' left join sample_list as sl on e.equipment_id = sl.equipment_id';
  $query .= ' left join equipment_uom as euom on e.equipment_uom = euom.equipment_unit';
  $query .= " where e.equipment_id = '{$equipment_id}'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_facility_user_list($fac_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select i.user_email as user_email,i.user_id';
  $query .= ' from istem_users i';
  $query .= ' join users_entity_mapping as u on u.user_id = i.user_id';
  $query .= ' join facilities as f on f.fac_id = u.entity_ref_id';
  $query .= ' join equipments eq  on eq.equipment_facility_id = f.fac_id';
  $query .= ' where u.entity_id = 6';
  $query .= " and u.entity_ref_id = '{$fac_id}'";
  $query .= ' and i.user_status = 1';
  $query .= ' group by i.user_email';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_institute_facility_coordinator_list_based_on_institute_id($facility_id_array) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select i.user_id as user_id,i.user_id';
  $query .= ' from istem_users as i';
  $query .= ' join users_entity_mapping as u on i.user_id=u.user_id';
  $query .= ' join facilities as fa on fa.fac_id = u.entity_ref_id';
  $query .= " where i.user_entity = 'FC'";
  $query .= " and fa.fac_id IN ('" . implode("', '", $facility_id_array) . "')";
  $query .= ' and i.user_status = 1';
  //$query .= " and fa.fac_id  = '{$facility_id_array}'";
  $query .= ' group by i.user_name';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_mapped_facilities($user_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select DISTINCT (f.fac_id)';
  $query .= ' from users_entity_mapping as uem';
  $query .= ' left join facilities as f on f.fac_id = uem.entity_ref_id';
  $query .= " where uem.user_id = '{$user_id}'";
  $query .= ' and uem.entity_id =  6';
  $query .= ' and uem.status IS NULL';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_unmapped_facilities($institute_id, $mapped_facility_id_array) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select COUNT(f.fac_id) as fac_count,dp.dept_id';
  $query .= ' from facilities as f';
  $query .= ' left join departments as dp on f.dept_id = dp.dept_id';
  $query .= " where dp.institute_id  = '{$institute_id}'";
  if($mapped_facility_id_array){
    if(sizeof($mapped_facility_id_array) > 0 ){
      $query .= " and f.fac_id NOT IN ('" . implode("', '", $mapped_facility_id_array) . "')";
    }
  }
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res = $row; // Inside while loop
  }
  return $res;
}

function get_public_mail_from_cart() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select p.user_email,p.user_id';
  $query .= ' from public_users as p';
  $query .= ' join cart_booking_request as cb on cb.public_user_id = p.user_id';
  $query .= ' left join booking_request as br on  br.equipment_id = cb.equipment_id';
  $query .= ' inner join booking_confirmation as bc on bc.request_id = br.request_id
  and bc.confirmation_time_from = cb.preferred_timings_from
  and bc.confirmation_time_to = cb.preferred_timings_to
  and bc.confirmation_date = cb.request_date';
  $query .= ' group by p.user_email,p.user_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_public_mail_if_date_expired() {
  $res = array();
  $today = date('d-M-Y');
  $db_conn = new DB_CONNECT();
  $query  = ' select p.user_email,p.user_id';
  $query .= ' from public_users as p';
  $query .= ' join cart_booking_request as cb on cb.public_user_id = p.user_id';
  $query .= " where DATE(cb.request_date) < DATE(NOW())";
  $query .= ' group by p.user_email,p.user_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_grivance_count($inst_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select count(*) as gr_count , ins.institute_id,pu.user_id';
  $query .= ' from grievance as g';
  $query .= ' left join grievance_answer as ga on ga.grievance_id=g.grievance_id';
  $query .= ' join public_users as pu on pu.user_name=g.user_name';
  $query .= ' join institutes as ins on ins.institute_id=g.entity_ref_id';
  $query .= " where g.entity_ref_id = '{$inst_id}'";
  $query .= ' and ga.answers IS NULL';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_list_of_confirmed_request_id() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select request_id';
  $query .= ' from booking_confirmation';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_list_of_rejected_request_id() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select request_id';
  $query .= ' from booking_reject';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_pending_service_request($eq_id_array, $confirmed_request_array, $rejected_request_array) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select COUNT(eq.equipment_id) as eq_count';
  $query .= ' from equipments as eq';
  $query .= ' join booking_request as br on eq.equipment_id=br.equipment_id';
  $query .= ' left join booking_confirmation as bc on br.request_id !=bc.request_id';
  $query .= ' left join booking_reject as brj on br.request_id !=brj.request_id';
  $query .= ' join institutes as ins on eq.institute_id=ins.institute_id';
  $query .= ' left join states as st on st.state_name=ins.institute_state';
  $query .= ' join public_users as pu on pu.user_id=br.public_user_id';
  $query .= " where br.equipment_id IN ('" . implode("', '", $eq_id_array) . "')";
  $query .= " and br.clar_status = 1 and br.cancelled IS NULL";
  if($confirmed_request_array){
    $query .= " and br.request_id NOT IN ('" . implode("', '", $confirmed_request_array) . "')";
  }
  if($rejected_request_array){
    $query .= " and br.request_id NOT IN ('" . implode("', '", $rejected_request_array) . "')";
  }
  $query .= " group by br.request_id";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function alerts_complete_user_profile_for_custodians() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select ist.user_email,ist.user_id';
  $query .= ' from istem_users as ist';
  $query .= ' where (ist.first_name = "" OR ist.user_email = "" OR ist.user_contactno = "")';
  $query .= ' and ist.user_status=1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function get_institute_admin_email($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query =  ' select ist.user_email,ist.user_id';
  $query .= ' from istem_users as ist';
  $query .= ' join users_entity_mapping as uem on uem.user_id = ist.user_id';
  $query .= ' join institutes as i on i.institute_id = uem.entity_ref_id';
  $query .= " where i.institute_id ='{$institute_id}'";
  $query .= ' and ist.user_status = 1';
  $query .= " and (uem.user_role = 'Institute Representative')";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function insert($data) {
  $db_conn = new DB_CONNECT();
  $query = 'Insert INTO alerts_mailbox (mail_type,mail_from,mail_to,mail_subject,mail_content,ip,mail_seen_status,last_updated_on,user_id) VALUES ';
  $query .= "('".$data['mail_type']."', '".$data['mail_from']."', '".$data['mail_to']."' , '".$data['mail_subject']."' , '".$data['mail_content']."' , '".$data['ip']."' ,'".$data['mail_seen_status']."' , '".$data['last_updated_on']."', '".$data['user_id']."')";
  $que = trim($query,',');
  $db_conn->load_records($que);
  //echo $que;
}

function get_super_email() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query = 'select ist.user_status , ist.user_email,ist.user_id , ist.user_name from istem_users as ist where ist.user_status = 1 and (ist.user_name like "SB%" or ist.user_name like "IS%")';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
  }
  return $res;
}

function get_date_from_alerts($date) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select date';
  $query .= ' from alerts_scheduling';
  $query .= " where date = '{$date}'";
  //$query .= " ORDER BY id DESC LIMIT 1";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_all_date_from_alerts() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select date';
  $query .= ' from alerts_scheduling';
  //$query .= " where date = '{$date}'";
  //$query .= " ORDER BY id DESC LIMIT 1";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function alerts_complete_supplier($institute_id) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select dp.dept_id,fc.fac_id,u.user_id,e.equipment_id,i.institute_id,e.equipment_name,dp.dept_name,fac_name,concat(s.state_unique_id ,"", e.equipment_id) as eq_code';
  $query .= ' from equipments as e';
  $query .= ' left join departments as dp on dp.dept_id=e.equipment_department_id';
  $query .= ' left join facilities as fc on fc.fac_id = e.equipment_facility_id';
  $query .= ' join institutes as i on i.institute_id=e.institute_id';
  $query .= ' join users_entity_mapping as eam on eam.entity_ref_id = i.institute_id';
  $query .= ' join istem_users as u on u.user_id = eam.user_id';
  $query .= ' left join states as s on i.institute_state = s.state_name';
  $query .= ' left join sample_list as sl on e.equipment_id = sl.equipment_id';
  $query .= ' where e.equipment_status = 1';
  $query .= ' and (e.supplier = "" OR e.supplier_email_id = "" OR e.service_provider = "" OR e.service_provider_email_id = "")';
  $query .= " and i.institute_id  ='{$institute_id}'";
  $query .= ' group by e.equipment_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_cart_request_date() {
  $res = array();
  $today = date('d-M-Y');
  $db_conn = new DB_CONNECT();
  $query  = ' select p.user_email,cb.request_date,cb.public_user_id';
  $query .= ' from public_users as p';
  $query .= ' join cart_booking_request as cb on cb.public_user_id = p.user_id';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_cart_data($user_id,$request_date) {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select cbr.public_user_id,equip.equipment_name,dp.dept_name,ins.institute_name,concat(s.state_unique_id ,"", equip.equipment_id) as eq_code,DATE_FORMAT(cbr.request_date, "%d-%b-%Y") as request_date';
  $query .= ' from cart_equipments as cq';
  $query .= ' left join cart_booking_request as cbr on cbr.public_user_id = cq.user_id';
  $query .= ' left join cart_service_request_form as srf on srf.request_id = cbr.request_id';
  $query .= ' left join equipments as equip on equip.equipment_id = cbr.equipment_id';
  $query .= ' left join departments as dp on dp.dept_id = equip.equipment_department_id';
  $query .= ' left join institutes as ins on equip.institute_id=ins.institute_id';
  $query .= ' left join states as s on ins.institute_state = s.state_name';
  $query .= " where cq.user_id = '{$user_id}'";
  $query .= " and cbr.request_date ='{$request_date}'";
  //$query .= " group by cbr.public_user_id,equip.equipment_name,dp.dept_name,ins.institute_name,s.state_unique_id,equip.equipment_id,cbr.request_date";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $res[] = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function insert_for_cart($data) {
  $db_conn = new DB_CONNECT();
  $query = 'Insert INTO alerts_mailbox_for_carts (mail_type,mail_from,mail_to,mail_subject,mail_content,ip,mail_seen_status,last_updated_on,user_id) VALUES ';
  $query .= "('".$data['mail_type']."', '".$data['mail_from']."', '".$data['mail_to']."' , '".$data['mail_subject']."' , '".$data['mail_content']."' , '".$data['ip']."' ,'".$data['mail_seen_status']."' , '".$data['last_updated_on']."', '".$data['user_id']."')";
  $que = trim($query,',');
  $db_conn->load_records($que);
}

function get_expiry_date_for_cart() {
  $res = array();
  $db_conn = new DB_CONNECT();
  $query  = ' select no_of_days';
  $query .= ' from alerts_scheduling_for_carts';
  $query .= ' order by id DESC limit 1';
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_row($db_conn->result)) {
    $res = $row; // Inside while loop
    //$res = $row;
  }
  return $res;
}

function get_list_of_equipments_for_first_reminder()
{
  $eq_array = array();

  $res = array();
  $result = array();
  $db_conn = new DB_CONNECT();
  /**To get the number of days' of the first reminder*/
  // $this->db->reset_query();
  $query  = ' select ede.no_of_days as no_of_days';
  $query .= ' from equipment_down_events as ede';
  $query .= " where ede.event_name = 'First Reminder'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $no_days = $row["no_of_days"];
    break;
  }
  $query = "";
  $query = "select distinct esh.equipment_id as equipment_id from equipment_status_history as esh";
  $db_conn->load_records($query);
  $equip_array = array();
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $equip_array[] = $row;
  }

  foreach ($equip_array as $equipment) {
    $eq = $equipment['equipment_id'];
    $query = "select equipment_id,last_updated_on,status from equipment_status_history where equipment_id=$eq ORDER BY history_id DESC LIMIT 1";
    $db_conn->load_records($query);
    //$latest_status = $db_conn->result;
    while ($row = mysqli_fetch_assoc($db_conn->result)) {
      $latest_status = $row;
    }

    if ($latest_status) {
      if ($latest_status["status"] == "2") {
        $date1 = date_create(date("Y-m-d H:i:s"));
        $down_date = date_create($latest_status["last_updated_on"]);
        $diff = date_diff($date1, $down_date);
        $days_diff = $diff->format("%a");
        if ($days_diff == $no_days) {
          $eq_array[] = $eq; //push
        }
      }
    }
  }

  $mailing_list = array();
  if ($eq_array) {
    foreach ($eq_array as $equipment_id) {

      // $this->load->model('EquipmentModel', '', TRUE);
      // $equipment_data = $this->EquipmentModel->get_details($equipment_id);
      // $institute_id = $equipment_data['institute_id'];

      $query = "SELECT `e`.`equipment_id`,`d`.`dept_name`,`f`.`fac_name`,`fn`.`fund_agen_name`,`p`.`project_name`,`i`.`institute_id`,
       `i`.`institute_name`,`e`.`equipment_name`,`e`.`equipment_abbr`,`e`.`equipment_location`,`e`.`equipment_make`,`e`.`equipment_model`,
       `e`.`supplier`,`e`.`supplier_email_id`,`e`.`service_provider`,`e`.`service_provider_email_id`,`e`.`equipment_srno`,
       `e`.`funding_agency_type`,`e`.`funding_agencies`,`e`.`equipment_description`,`e`.`equipment_dept_lab`,`e`.`equipment_project`,
       `e`.`equipment_rate`,`e`.`equipment_project_id`,`e`.`equipment_agency_id`,`e`.`equipment_facility_id`,`e`.`equipment_department_id`,
       `e`.`equipment_website`,`e`.`equipment_category`,`i`.`institute_city` as`city`,`e`.`equipment_status`,`e`.`last_updated_on`,
       `e`.`last_updated_by`,`i`.`institute_name`,`s`.`state_unique_id`,`e`.`equipment_uom`,`euom`.`unit_description`,`e`.`equipment_fov_rate`,
       `e`.`equipment_cif_rate`,`e`.`equipment_other_rate`,`sl`.`sample_name`,`sl`.`sample_quantity`, concat(s.state_unique_id,'', e.equipment_id) as eqcode
        FROM `equipments` as `e`
        LEFT JOIN`departments` as`d` ON`e`.`equipment_department_id` =`d`.`dept_id`
        LEFT JOIN`facilities` as`f` ON`e`.`equipment_facility_id` =`f`.`fac_id`
        LEFT JOIN`funding_agency` as`fn` ON`e`.`equipment_agency_id` =`fn`.`fund_agen_id`
        LEFT JOIN`project` as`p` ON`e`.`equipment_project_id` =`p`.`project_id`
        JOIN`institutes` as`i` ON`e`.`institute_id` =`i`.`institute_id`
        LEFT JOIN`states` as`s` ON`i`.`institute_state` =`s`.`state_name`
        LEFT JOIN`sample_list` as`sl` ON`e`.`equipment_id` =`sl`.`equipment_id`
        LEFT JOIN`equipment_uom` as`euom` ON`e`.`equipment_uom` =`euom`.`equipment_unit`
        WHERE`e`.`equipment_id` = $equipment_id";

      $db_conn->load_records($query);
      //$equipment_data = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $equipment_data = $row;
      }

      $institute_id = $equipment_data['institute_id'];

      // $this->load->model('EquipmentdownConfigModel', '', TRUE);
      // $equipment_down_details = $this->EquipmentdownConfigModel->get_equiment_down_updated_on($equipment_id);

      $query = "SELECT `esh`.`last_updated_on`,`esh`.`last_updated_by`,`esh`.`status_remark`
      FROM `equipment_status_history` as`esh`
      WHERE `equipment_id` = $equipment_id
      AND `status` = 2
      ORDER BY`esh`.`history_id` DESC
      LIMIT 1";

      $db_conn->load_records($query);
      //$equipment_down_details = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $equipment_down_details = $row;
      }
      // $admin_mail = $this->config->item('super_admin_email');
      $admin_mail = 'istemstaging@gmail.com';
      $standard_id = 'istem.india@gmail.com';

      // $this->load->model('EquipmentdownConfigModel', '', TRUE);
      // $user_considered_list = $this->EquipmentdownConfigModel->get_user_considered_for_equipment_down_first_reminder();

        $query = ' select edu.user_type as user_role';
        $query .= ' FROM equipment_down_users as edu';
        $query .= ' WHERE edu.event_name = "First Reminder"';
        $query .= ' GROUP BY edu.user_type';
        $db_conn->load_records($query);
      //$user_considered_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $user_considered_list[] = $row;
      }
      //$institute_admin_list = $this->EquipmentdownConfigModel->get_user_list_institute_admin($institute_id); //Institute Admin Role

      $query = "SELECT `i`.`user_contactno`, `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation, '', `i`.`first_name`,'' , i.last_name)as name, `i`.`user_email` as `user_email`, `u`.`remarks` as `remarks`,
      `u`.`user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '3'
      AND `u`.`entity_ref_id` = $institute_id
      AND `i`.`user_role` = 'Institute Admin'
      GROUP BY `i`.`user_contactno`, `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`user_saluation`, `i`.`last_name`, `i`.`user_email`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $institute_admin_list = $db_conn->result; //result_array

      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $institute_admin_list[] = $row;
      }
      // $institute_representative_list = $this->EquipmentdownConfigModel->get_user_list_institute_representative($institute_id); //Institute Representative

      $query = " SELECT `i`.`user_contactno`, `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation,'', `i`.`first_name`,'', i.last_name)as name, `i`.`user_email` as `user_email`, `u`.`remarks` as `remarks`,
      `u`.`user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '3'
      AND `u`.`entity_ref_id` = $institute_id
      AND `i`.`user_role` = 'Institute Representative'
      GROUP BY `i`.`user_contactno`, `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`user_saluation`, `i`.`last_name`, `i`.`user_email`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
      //$institute_representative_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $institute_representative_list[] = $row;
      }
      $dept_id = $equipment_data['equipment_department_id'];

      // $this->load->model('DepartmentModel', '', TRUE);
      // $department_rep_list = $this->DepartmentModel->get_user_list($dept_id);

      $query = " SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`, `i`.`user_contactno`,
      `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '4'
      AND `u`.`entity_ref_id` = $dept_id
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`, `i`.`user_contactno`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $department_rep_list = $db_conn->result; //result_array
    while ($row = mysqli_fetch_assoc($db_conn->result)) {
      $department_rep_list[] = $row;
    }
      // $this->load->model('FacultyModel', '', TRUE);
      // $faculty_list = $this->FacultyModel->get_faculty_user_list_for_department_on_dept_id($dept_id);

      $query = "SELECT `f`.`faculty_id`, `f`.`first_name`, `f`.`last_name`, `f`.`user_email`, `f`.`user_contactno`, `ist`.`user_name`,
      concat(f.user_salutation,' ', `f`.`first_name`,' ', f.last_name)as name
      FROM `faculties` as `f`
      JOIN `users_entity_mapping` as `uem` ON `f`.`user_id`=`uem`.`user_id`
      LEFT JOIN `istem_users` as `ist` ON `ist`.`user_id`=`uem`.`user_id`
      WHERE `uem`.`entity_id` = '5'
      AND `uem`.`entity_ref_id` = $dept_id
      GROUP BY `f`.`faculty_id`, `f`.`first_name`, `f`.`last_name`, `f`.`user_email`, `f`.`user_contactno`, `ist`.`user_name`, `f`.`user_salutation`";
      $db_conn->load_records($query);
    //  $faculty_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $faculty_list[] = $row;
      }
      $facility_id = $equipment_data['equipment_facility_id'];
      // $facility_coordinator_list = $this->EquipmentdownConfigModel->get_user_list_facility_coordinator($facility_id);

      $query = " SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`, `u`.`entity_ref_id`,
      `i`.`last_name` as `last_name`, concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`,
      `i`.`user_contactno`, `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '6'
      AND `i`.`user_role` = 'Facility Coordinator'
      AND `u`.`entity_ref_id` = $facility_id
      AND `u`.`status` IS NULL
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `u`.`entity_ref_id`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`,
      `i`.`user_contactno`, `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $facility_coordinator_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $facility_coordinator_list[] = $row;
      }
      // $facility_user_list = $this->EquipmentdownConfigModel->get_user_list_facility_user($facility_id);

      $query = "SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`, `u`.`entity_ref_id`,
      `i`.`last_name` as `last_name`, concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`,
      `i`.`user_contactno`, `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '6'
      AND `i`.`user_role` = 'Facility User'
      AND `u`.`entity_ref_id` = $facility_id
      AND `u`.`status` IS NULL
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `u`.`entity_ref_id`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`,
      `i`.`user_contactno`, `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
      //$facility_user_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $facility_user_list[] = $row;
      }
      // $this->load->model('EquipmentModel', '', TRUE);
      // $opeartor_list = $this->EquipmentModel->get_mapped_operator($equipment_id);

      $query = " SELECT `o`.`first_name`, `o`.`last_name`, `o`.`user_email`, `eq`.`equipment_name`
     FROM `operator_equipment_mapping` `oem`
     JOIN `operators` as `o` ON `oem`.`operator_id` = `o`.`operator_id`
     JOIN `equipments` `eq` ON `eq`.`equipment_id` = `oem`.`equipment_id`
     WHERE `eq`.`equipment_id` = $equipment_id";
   $db_conn->load_records($query);
      //$opeartor_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $opeartor_list[] = $row;
      }
      // $public_user_list = $this->EquipmentdownConfigModel->get_pu_list_booked_equipment($equipment_id); //Public Users

      $query = "SELECT DISTINCT `pu`.`user_id`, `pu`.`user_name`, `pu`.`user_salutation`, `pu`.`user_firstname`, `pu`.`user_lastname`,
        concat(pu.user_firstname,' ', pu.user_lastname) as public_user_name, `pu`.`user_email`, `pu`.`user_contactno`, `pu`.`user_organisation`,
        `pu`.`user_aadhaarno`, `pu`.`user_research_area`, `pu`.`user_category`, `alternate_contactno`, `pu`.`user_type`, `pu`.`whatsapp_no`,
        `pu`.`facebook_profile`, `pu`.`billing_user_name`, `pu`.`state` as `user_state`, `pu`.`billing_address`, `pu`.`user_country`,
        `pu`.`user_department`, `pu`.`user_designation`
        FROM `public_users` `pu`
        JOIN `booking_request` as `br` ON `br`.`public_user_id`=`pu`.`user_id`
        WHERE `br`.`equipment_id` = $equipment_id";
        $db_conn->load_records($query);
      //$public_user_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $public_user_list[] = $row;
      }
      //$supplier = $this->EquipmentdownConfigModel->get_supplier_of_equipment($equipment_id); //Supplier


            $query = "SELECT `e`.`supplier_email_id`
            FROM `equipments` `e`
            WHERE `e`.`equipment_id` = $equipment_id";
            $db_conn->load_records($query);
      //$supplier = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $supplier = $row;
      }
      // $service_provider = $this->EquipmentdownConfigModel->get_service_provider_of_equipment($equipment_id); //Service

      $query = "SELECT `e`.`service_provider_email_id`
      FROM `equipments` `e`
      WHERE `e`.`equipment_id` = $equipment_id";
      $db_conn->load_records($query);
      //$service_provider = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $service_provider = $row;
      }

      $cc_list = array();
      foreach ($user_considered_list as $user_considered) {

        if ($user_considered['user_role'] == 'Super Admin') {
          if ($admin_mail) {
            array_push($cc_list, $admin_mail);
          }
        }

        if ($user_considered['user_role'] == 'Institute Admin') {
          if ($institute_admin_list) {
            foreach ($institute_admin_list as $institute_admin) {
              array_push($cc_list, $institute_admin["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Institute Representative') {
          if ($institute_representative_list) {
            foreach ($institute_representative_list as $institute_representative) {
              array_push($cc_list, $institute_representative["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Department Representative') {
          if ($department_rep_list) {
            foreach ($department_rep_list as $department_rep) {
              array_push($cc_list, $department_rep["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Faculty Incharge') {
          if ($faculty_list) {
            foreach ($faculty_list as $faculty) {
              array_push($cc_list, $faculty["user_email"]);
            }
          }
        }
        if ($user_considered['user_role'] == 'Facility Coordinator') {
          if ($facility_coordinator_list) {
            foreach ($facility_coordinator_list as $facility_coordinator) {
              array_push($cc_list, $facility_coordinator["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Facility User') {
          if ($facility_user_list) {
            foreach ($facility_user_list as $facility_user) {
              array_push($cc_list, $facility_user["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Operator') {
          if ($opeartor_list) {
            foreach ($opeartor_list as $opeartor) {
              array_push($cc_list, $opeartor["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Public User') {
          if ($public_user_list) {
            foreach ($public_user_list as $public_user) {
              array_push($cc_list, $public_user["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Supplier') {

          if ($supplier) {

            array_push($cc_list, $supplier["supplier_email_id"]);
          }
        }

        if ($user_considered['user_role'] == 'Service Provider') {
          if ($service_provider) {
            array_push($cc_list, $service_provider["service_provider_email_id"]);
          }
        }
      }

      $notif_message1 = "Dear All,<br>";
      $notif_message1 = $notif_message1 . "The equipment" . " &nbsp;<strong>" . $equipment_data['equipment_name'].",&nbsp;" . $equipment_data['eqcode'] .",&nbsp;" . $equipment_data['dept_name'] . "&nbsp;</strong>";
      $notif_message1 = $notif_message1 . "is marked" . "&nbsp;<strong>Down</strong>&nbsp;by&nbsp;" . $equipment_down_details['last_updated_by'] . "&nbsp;on&nbsp;" . $equipment_down_details['last_updated_on'] . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Reason:</strong>". $equipment_down_details['status_remark'] .".<br>";
      $notif_message1 = $notif_message1 . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Thanks,<br></strong>";
      $notif_message1 = $notif_message1 . "<strong>I-STEM Team<br></strong>";
      $notif_message1 = $notif_message1 . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Note : Kindly enable/disable the notification in the profile section, if you do not want it in your email and continue checking the inbox at the I-STEM portal.</strong><br>";
      //sendmail2($standard_id, 'Equipment Down Alert', $notif_message1, $cc_list);
      $mailing_list = array("mail_to"=>$standard_id,"mail_subject"=>'Equipment Down Alert',"mail_message"=>$notif_message1,"mail_cc"=>$cc_list);
    }
  }
  return $mailing_list;
}

function get_list_of_equipments_for_second_reminder()
{
  $eq_array = array();

  $res = array();
  $result = array();
  $db_conn = new DB_CONNECT();
  /**To get the number of days' of the first reminder*/
  // $this->db->reset_query();
  $query  = ' select ede.no_of_days as no_of_days';
  $query .= ' from equipment_down_events as ede';
  $query .= " where ede.event_name = 'Second Reminder'";
  $db_conn->load_records($query);
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $no_days = $row["no_of_days"];
    break;
  }
  $query = "";
  $query = "select distinct esh.equipment_id as equipment_id from equipment_status_history as esh";
  $db_conn->load_records($query);
  $equip_array = array();
  while ($row = mysqli_fetch_assoc($db_conn->result)) {
    $equip_array[] = $row;
  }
  foreach ($equip_array as $equipment) {
    $eq = $equipment['equipment_id'];
    $query = "select equipment_id,last_updated_on,status from equipment_status_history where equipment_id=$eq ORDER BY history_id DESC LIMIT 1";
    $db_conn->load_records($query);
    //$latest_status = $db_conn->result;
    while ($row = mysqli_fetch_assoc($db_conn->result)) {
      $latest_status = $row;
    }

    if ($latest_status) {
      if ($latest_status["status"] == "2") {
        $date1 = date_create(date("Y-m-d H:i:s"));
        $down_date = date_create($latest_status["last_updated_on"]);
        $diff = date_diff($date1, $down_date);
        $days_diff = $diff->format("%a");
        if ($days_diff == $no_days) {
          $eq_array[] = $eq; //push
        }
      }
    }
  }

  $mailing_list = array();
  if ($eq_array) {
    foreach ($eq_array as $equipment_id) {

      // $this->load->model('EquipmentModel', '', TRUE);
      // $equipment_data = $this->EquipmentModel->get_details($equipment_id);
      // $institute_id = $equipment_data['institute_id'];

      $query = "SELECT `e`.`equipment_id`,`d`.`dept_name`,`f`.`fac_name`,`fn`.`fund_agen_name`,`p`.`project_name`,`i`.`institute_id`,
       `i`.`institute_name`,`e`.`equipment_name`,`e`.`equipment_abbr`,`e`.`equipment_location`,`e`.`equipment_make`,`e`.`equipment_model`,
       `e`.`supplier`,`e`.`supplier_email_id`,`e`.`service_provider`,`e`.`service_provider_email_id`,`e`.`equipment_srno`,
       `e`.`funding_agency_type`,`e`.`funding_agencies`,`e`.`equipment_description`,`e`.`equipment_dept_lab`,`e`.`equipment_project`,
       `e`.`equipment_rate`,`e`.`equipment_project_id`,`e`.`equipment_agency_id`,`e`.`equipment_facility_id`,`e`.`equipment_department_id`,
       `e`.`equipment_website`,`e`.`equipment_category`,`i`.`institute_city` as`city`,`e`.`equipment_status`,`e`.`last_updated_on`,
       `e`.`last_updated_by`,`i`.`institute_name`,`s`.`state_unique_id`,`e`.`equipment_uom`,`euom`.`unit_description`,`e`.`equipment_fov_rate`,
       `e`.`equipment_cif_rate`,`e`.`equipment_other_rate`,`sl`.`sample_name`,`sl`.`sample_quantity`, concat(s.state_unique_id,'', e.equipment_id) as eqcode
        FROM `equipments` as `e`
        LEFT JOIN`departments` as`d` ON`e`.`equipment_department_id` =`d`.`dept_id`
        LEFT JOIN`facilities` as`f` ON`e`.`equipment_facility_id` =`f`.`fac_id`
        LEFT JOIN`funding_agency` as`fn` ON`e`.`equipment_agency_id` =`fn`.`fund_agen_id`
        LEFT JOIN`project` as`p` ON`e`.`equipment_project_id` =`p`.`project_id`
        JOIN`institutes` as`i` ON`e`.`institute_id` =`i`.`institute_id`
        LEFT JOIN`states` as`s` ON`i`.`institute_state` =`s`.`state_name`
        LEFT JOIN`sample_list` as`sl` ON`e`.`equipment_id` =`sl`.`equipment_id`
        LEFT JOIN`equipment_uom` as`euom` ON`e`.`equipment_uom` =`euom`.`equipment_unit`
        WHERE`e`.`equipment_id` = $equipment_id";

      $db_conn->load_records($query);
      //$equipment_data = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $equipment_data = $row;
      }

      $institute_id = $equipment_data['institute_id'];

      // $this->load->model('EquipmentdownConfigModel', '', TRUE);
      // $equipment_down_details = $this->EquipmentdownConfigModel->get_equiment_down_updated_on($equipment_id);

      $query = "SELECT `esh`.`last_updated_on`,`esh`.`last_updated_by`,`esh`.`status_remark`
      FROM `equipment_status_history` as`esh`
      WHERE `equipment_id` = $equipment_id
      AND `status` = 2
      ORDER BY`esh`.`history_id` DESC
      LIMIT 1";

      $db_conn->load_records($query);
      //$equipment_down_details = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $equipment_down_details = $row;
      }
      // $admin_mail = $this->config->item('super_admin_email');
      $admin_mail = 'istemstaging@gmail.com';
      $standard_id = 'istem.india@gmail.com';

      // $this->load->model('EquipmentdownConfigModel', '', TRUE);
      // $user_considered_list = $this->EquipmentdownConfigModel->get_user_considered_for_equipment_down_first_reminder();

        $query = ' select edu.user_type as user_role';
        $query .= ' FROM equipment_down_users as edu';
        $query .= ' WHERE edu.event_name = "Second Reminder"';
        $query .= ' GROUP BY edu.user_type';
        $db_conn->load_records($query);
      //$user_considered_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $user_considered_list[] = $row;
      }
      //$institute_admin_list = $this->EquipmentdownConfigModel->get_user_list_institute_admin($institute_id); //Institute Admin Role

      $query = "SELECT `i`.`user_contactno`, `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation, '', `i`.`first_name`,'' , i.last_name)as name, `i`.`user_email` as `user_email`, `u`.`remarks` as `remarks`,
      `u`.`user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '3'
      AND `u`.`entity_ref_id` = $institute_id
      AND `i`.`user_role` = 'Institute Admin'
      GROUP BY `i`.`user_contactno`, `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`user_saluation`, `i`.`last_name`, `i`.`user_email`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $institute_admin_list = $db_conn->result; //result_array

      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $institute_admin_list[] = $row;
      }
      // $institute_representative_list = $this->EquipmentdownConfigModel->get_user_list_institute_representative($institute_id); //Institute Representative

      $query = " SELECT `i`.`user_contactno`, `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation,'', `i`.`first_name`,'', i.last_name)as name, `i`.`user_email` as `user_email`, `u`.`remarks` as `remarks`,
      `u`.`user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '3'
      AND `u`.`entity_ref_id` = $institute_id
      AND `i`.`user_role` = 'Institute Representative'
      GROUP BY `i`.`user_contactno`, `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`user_saluation`, `i`.`last_name`, `i`.`user_email`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
      //$institute_representative_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $institute_representative_list[] = $row;
      }
      $dept_id = $equipment_data['equipment_department_id'];

      // $this->load->model('DepartmentModel', '', TRUE);
      // $department_rep_list = $this->DepartmentModel->get_user_list($dept_id);

      $query = " SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`,
      concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`, `i`.`user_contactno`,
      `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '4'
      AND `u`.`entity_ref_id` = $dept_id
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`, `i`.`user_contactno`,
      `u`.`remarks`, `u`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $department_rep_list = $db_conn->result; //result_array
    while ($row = mysqli_fetch_assoc($db_conn->result)) {
      $department_rep_list[] = $row;
    }
      // $this->load->model('FacultyModel', '', TRUE);
      // $faculty_list = $this->FacultyModel->get_faculty_user_list_for_department_on_dept_id($dept_id);

      $query = "SELECT `f`.`faculty_id`, `f`.`first_name`, `f`.`last_name`, `f`.`user_email`, `f`.`user_contactno`, `ist`.`user_name`,
      concat(f.user_salutation,' ', `f`.`first_name`,' ', f.last_name)as name
      FROM `faculties` as `f`
      JOIN `users_entity_mapping` as `uem` ON `f`.`user_id`=`uem`.`user_id`
      LEFT JOIN `istem_users` as `ist` ON `ist`.`user_id`=`uem`.`user_id`
      WHERE `uem`.`entity_id` = '5'
      AND `uem`.`entity_ref_id` = $dept_id
      GROUP BY `f`.`faculty_id`, `f`.`first_name`, `f`.`last_name`, `f`.`user_email`, `f`.`user_contactno`, `ist`.`user_name`, `f`.`user_salutation`";
      $db_conn->load_records($query);
    //  $faculty_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $faculty_list[] = $row;
      }
      $facility_id = $equipment_data['equipment_facility_id'];
      // $facility_coordinator_list = $this->EquipmentdownConfigModel->get_user_list_facility_coordinator($facility_id);

      $query = " SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`, `u`.`entity_ref_id`,
      `i`.`last_name` as `last_name`, concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`,
      `i`.`user_contactno`, `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '6'
      AND `i`.`user_role` = 'Facility Coordinator'
      AND `u`.`entity_ref_id` = $facility_id
      AND `u`.`status` IS NULL
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `u`.`entity_ref_id`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`,
      `i`.`user_contactno`, `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
    //  $facility_coordinator_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $facility_coordinator_list[] = $row;
      }
      // $facility_user_list = $this->EquipmentdownConfigModel->get_user_list_facility_user($facility_id);

      $query = "SELECT `i`.`user_name` as `user_name`, `i`.`user_id` as `user_id`, `i`.`first_name` as `first_name`, `u`.`entity_ref_id`,
      `i`.`last_name` as `last_name`, concat(i.user_saluation,' ', `i`.`first_name`,' ', i.last_name)as name, `i`.`user_email` as `user_email`,
      `i`.`user_contactno`, `u`.`remarks` as `remarks`, `u`.`user_role` as `user_role`, `i`.`user_role`, case i.user_status when 1 then 'active' else 'inactive' end as user_status
      FROM `istem_users` `i`
      JOIN `users_entity_mapping` as `u` ON `u`.`user_id` = `i`.`user_id`
      WHERE `u`.`entity_id` = '6'
      AND `i`.`user_role` = 'Facility User'
      AND `u`.`entity_ref_id` = $facility_id
      AND `u`.`status` IS NULL
      GROUP BY `i`.`user_name`, `i`.`user_id`, `i`.`first_name`, `u`.`entity_ref_id`, `i`.`last_name`, `i`.`user_saluation`, `i`.`user_email`,
      `i`.`user_contactno`, `u`.`remarks`, `u`.`user_role`, `i`.`user_role`, `i`.`user_status`";
      $db_conn->load_records($query);
      //$facility_user_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $facility_user_list[] = $row;
      }
      // $this->load->model('EquipmentModel', '', TRUE);
      // $opeartor_list = $this->EquipmentModel->get_mapped_operator($equipment_id);

      $query = " SELECT `o`.`first_name`, `o`.`last_name`, `o`.`user_email`, `eq`.`equipment_name`
     FROM `operator_equipment_mapping` `oem`
     JOIN `operators` as `o` ON `oem`.`operator_id` = `o`.`operator_id`
     JOIN `equipments` `eq` ON `eq`.`equipment_id` = `oem`.`equipment_id`
     WHERE `eq`.`equipment_id` = $equipment_id";
   $db_conn->load_records($query);
      //$opeartor_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $opeartor_list[] = $row;
      }
      // $public_user_list = $this->EquipmentdownConfigModel->get_pu_list_booked_equipment($equipment_id); //Public Users

      $query = "SELECT DISTINCT `pu`.`user_id`, `pu`.`user_name`, `pu`.`user_salutation`, `pu`.`user_firstname`, `pu`.`user_lastname`,
        concat(pu.user_firstname,' ', pu.user_lastname) as public_user_name, `pu`.`user_email`, `pu`.`user_contactno`, `pu`.`user_organisation`,
        `pu`.`user_aadhaarno`, `pu`.`user_research_area`, `pu`.`user_category`, `alternate_contactno`, `pu`.`user_type`, `pu`.`whatsapp_no`,
        `pu`.`facebook_profile`, `pu`.`billing_user_name`, `pu`.`state` as `user_state`, `pu`.`billing_address`, `pu`.`user_country`,
        `pu`.`user_department`, `pu`.`user_designation`
        FROM `public_users` `pu`
        JOIN `booking_request` as `br` ON `br`.`public_user_id`=`pu`.`user_id`
        WHERE `br`.`equipment_id` = $equipment_id";
        $db_conn->load_records($query);
      //$public_user_list = $db_conn->result; //result_array
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $public_user_list[] = $row;
      }
      //$supplier = $this->EquipmentdownConfigModel->get_supplier_of_equipment($equipment_id); //Supplier


            $query = "SELECT `e`.`supplier_email_id`
            FROM `equipments` `e`
            WHERE `e`.`equipment_id` = $equipment_id";
            $db_conn->load_records($query);
      //$supplier = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $supplier = $row;
      }
      // $service_provider = $this->EquipmentdownConfigModel->get_service_provider_of_equipment($equipment_id); //Service

      $query = "SELECT `e`.`service_provider_email_id`
      FROM `equipments` `e`
      WHERE `e`.`equipment_id` = $equipment_id";
      $db_conn->load_records($query);
      //$service_provider = $db_conn->result[0];
      while ($row = mysqli_fetch_assoc($db_conn->result)) {
        $service_provider = $row;
      }

      $cc_list = array();
      foreach ($user_considered_list as $user_considered) {

        if ($user_considered['user_role'] == 'Super Admin') {
          if ($admin_mail) {
            array_push($cc_list, $admin_mail);
          }
        }

        if ($user_considered['user_role'] == 'Institute Admin') {
          if ($institute_admin_list) {
            foreach ($institute_admin_list as $institute_admin) {
              array_push($cc_list, $institute_admin["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Institute Representative') {
          if ($institute_representative_list) {
            foreach ($institute_representative_list as $institute_representative) {
              array_push($cc_list, $institute_representative["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Department Representative') {
          if ($department_rep_list) {
            foreach ($department_rep_list as $department_rep) {
              array_push($cc_list, $department_rep["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Faculty Incharge') {
          if ($faculty_list) {
            foreach ($faculty_list as $faculty) {
              array_push($cc_list, $faculty["user_email"]);
            }
          }
        }
        if ($user_considered['user_role'] == 'Facility Coordinator') {
          if ($facility_coordinator_list) {
            foreach ($facility_coordinator_list as $facility_coordinator) {
              array_push($cc_list, $facility_coordinator["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Facility User') {
          if ($facility_user_list) {
            foreach ($facility_user_list as $facility_user) {
              array_push($cc_list, $facility_user["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Operator') {
          if ($opeartor_list) {
            foreach ($opeartor_list as $opeartor) {
              array_push($cc_list, $opeartor["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Public User') {
          if ($public_user_list) {
            foreach ($public_user_list as $public_user) {
              array_push($cc_list, $public_user["user_email"]);
            }
          }
        }

        if ($user_considered['user_role'] == 'Supplier') {

          if ($supplier) {

            array_push($cc_list, $supplier["supplier_email_id"]);
          }
        }

        if ($user_considered['user_role'] == 'Service Provider') {
          if ($service_provider) {
            array_push($cc_list, $service_provider["service_provider_email_id"]);
          }
        }
      }

      $notif_message1 = "Dear All,<br>";
      $notif_message1 = $notif_message1 . "The equipment" . " &nbsp;<strong>" . $equipment_data['equipment_name'].",&nbsp;" . $equipment_data['eqcode'] .",&nbsp;" . $equipment_data['dept_name'] . "&nbsp;</strong>";
      $notif_message1 = $notif_message1 . "is marked" . "&nbsp;<strong>Down</strong>&nbsp;by&nbsp;" . $equipment_down_details['last_updated_by'] . "&nbsp;on&nbsp;" . $equipment_down_details['last_updated_on'] . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Reason:</strong>". $equipment_down_details['status_remark'] .".<br>";
      $notif_message1 = $notif_message1 . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Thanks,<br></strong>";
      $notif_message1 = $notif_message1 . "<strong>I-STEM Team<br></strong>";
      $notif_message1 = $notif_message1 . "<br>";
      $notif_message1 = $notif_message1 . "<strong>Note : Kindly enable/disable the notification in the profile section, if you do not want it in your email and continue checking the inbox at the I-STEM portal.</strong><br>";
      //sendmail2($standard_id, 'Equipment Down Alert', $notif_message1, $cc_list);
      $mailing_list = array("mail_to"=>$standard_id,"mail_subject"=>'Equipment Down Alert',"mail_message"=>$notif_message1,"mail_cc"=>$cc_list);
    }
  }
  return $mailing_list;
}
