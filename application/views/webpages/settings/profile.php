<style>
    .icon-envelope:before {
        content: "\f0e0";
    }
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
        width: 100%;
    }
    .datepicker{
        text-align: left !important;
    }
</style>
<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="d-lg-flex justify-content-between">
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#Profile_Settings">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Change_Password">Change Password </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-body">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active show" id="Profile_Settings">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Profile Settings</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php echo form_open_multipart('data/users/update','id="updateuser" name="updateuser" autocomplete="on" ');?>
                                    <h3 class="card-title">Office Details</h3>                                    
                                    <input name="user_id" id="user_id" type="hidden" value="<?php echo $user_data['user_id'];?>">
                                    <input name="role_id" id="role_id" type="hidden" value="<?php echo $user_data['role_id'];?>">
                                    <input name="department_id" id="department_id" type="hidden" value="<?php echo $user_data['department_id'];?>">
                                    <input name="designation_id" id="designation_id" type="hidden" value="<?php echo $user_data['designation_id'];?>">
                                    <input name="reporting_to" id="reporting_to" type="hidden" value="<?php echo $user_data['reporting_to'];?>">
                                    <input name="emp_type" id="emp_type" type="hidden" value="<?php echo $user_data['emp_type'];?>">
                                    <input name="emp_start_date" id="emp_start_date" type="hidden" value="<?php echo $user_data['emp_start_date'];?>">
                                    <input name="emp_end_date" id="emp_end_date" type="hidden" value="<?php echo $user_data['emp_end_date'];?>">
                                    <input name="joining_date" id="joining_date" type="hidden" value="<?php echo $user_data['joining_date'];?>">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Role</label>
                                                <div>
                                                    <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Role" id="disabled_role_id"  disabled="true">
                                                    <?php 
                                                        if($allroles){
                                                        foreach($allroles as $output){
                                                    ?>
                                                        <option <?php if($output->role_id == $user_data['role_id']){ echo'selected';} ?> data-tokens="<?php echo $output->roles;?>" value="<?php echo $output->role_id;?>"><?php echo $output->role;?></option>
                                                    <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>	
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Department</label>
                                                <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Department" id="disabled_department_id" disabled="true">
                                                <?php 
                                                    if($alldepartment){
                                                    foreach($alldepartment as $output){
                                                ?>
                                                    <option  <?php if($output->department_id == $user_data['department_id']){ echo'selected';} ?> data-tokens="<?php echo $output->department;?>" value="<?php echo $output->department_id;?>"><?php echo $output->department;?></option>
                                                <?php } } ?>
                                                </select>
                                            </div>
                                        </div>	
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Designation</label>
                                                <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Designation" id="disabled_designation_id" disabled="true">
                                                <?php 
                                                    if($alldesignation){
                                                    foreach($alldesignation as $output){
                                                ?>
                                                    <option  <?php if($output->designation_id == $user_data['designation_id']){ echo'selected';} ?> data-tokens="<?php echo $output->designation;?>" value="<?php echo $output->designation_id;?>"><?php echo $output->designation;?></option>
                                                <?php } } ?>
                                                </select>
                                            </div>
                                        </div>	
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Reporting To</label>
                                                <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Reporting To" multiple="multiple" id="disabled_reporting_to" disabled="true">
                                                <?php 
                                                    $people = explode(',',$user_data['reporting_to']); 
                                                    if($allusers){
                                                    foreach($allusers as $output){
                                                ?>
                                                    <option <?php if (in_array( $output->user_id, $people )){ echo'selected'; } ?> data-tokens="<?php echo $output->user_name;?>" value="<?php echo $output->user_id;?>"><?php echo $output->user_name;?></option>
                                                <?php } } ?>
                                                </select>
                                            </div>
                                        </div>	
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <label>Emp Type</label>
                                                <select class="selectpicker show-menu-arrow" onchange="showdate(this.value)" data-style="form-control" data-live-search="true" title="Select Type" id="disabled_emp_type" disabled="true">
                                                    <option <?php if($user_data['emp_type'] == 'Permanent'){ echo'selected';} ?> data-tokens="Permanent" value="Permanent">Permanent</option>
                                                    <option <?php if($user_data['emp_type'] ==  'Contract'){ echo'selected';} ?> data-tokens="Contract" value="Contract">Contract</option>
                                                    <option <?php if($user_data['emp_type'] == 'Intern'){ echo'selected';} ?> data-tokens="Intern" value="Intern">Intern</option>
                                                    <option <?php if($user_data['emp_type'] == 'Other'){ echo'selected';} ?> data-tokens="Other"value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>			
                                        <div class="col-lg-4 col-md-4" style="display:none;" id="datediv">
                                            <label>Contract Dates</label>
                                            <div class="input-daterange input-group" data-provide="datepicker">
                                                <input type="text" class="form-control datepicker" id="disabled_emp_start_date" autocomplete="off" readonly value="<?php echo $user_data['emp_start_date'];?>" disabled="true">
                                                <span class="input-group-addon"> to </span>
                                                <input type="text" class="form-control datepicker" id="disabled_emp_end_date" autocomplete="off" readonly value="<?php echo $user_data['emp_end_date'];?>" disabled="true">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <label>Joining Date</label>
                                            <div class="input-daterange input-group" data-provide="datepicker">
                                                <input type="text" class="form-control datepicker" id="disabled_joining_date" autocomplete="off" readonly value="<?php echo $user_data['joining_date'];?>" disabled="true">
                                            </div>
                                        </div>                                       
                                    </div>
                                    <h3 style="margin-top:20px;" class="card-title">Personal Details</h3>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input class="form-control user_name" name="first_name" id="fname" type="text" value="<?php echo $user_data['first_name'];?>">
                                                <input name="user_id" id="user_id" type="hidden" value="<?php echo $user_data['user_id'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Middle Name <span class="text-danger">*</span></label>
                                                <input class="form-control user_name" name="middle_name" id="mname" type="text" value="<?php echo $user_data['middle_name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control user_name" name="last_name" id="lname" type="text" value="<?php echo $user_data['last_name'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>User Name</label>
                                                <input class="form-control" name="user_name" id="user_name" value="<?php echo $user_data['user_name'];?>" type="text" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Mobile Number <span class="text-danger">*</span></label>
                                                <input class="form-control" name="phone" value="<?php echo $user_data['phone'];?>" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label>Email <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                                    </div>
                                                    <input type="text" name="email" class="form-control" value="<?php echo $user_data['email'];?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" aria-label="With textarea"><?php echo $user_data['description'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" aria-label="With textarea"><?php echo $user_data['address'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>State</label>
                                                <input name="state" type="text" class="form-control" value="<?php echo $user_data['state'];?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input name="city" type="text" class="form-control" value="<?php echo $user_data['city'];?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6 col-lg-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input name="pincode" type="text" class="form-control" value="<?php echo $user_data['pincode'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>User Picture</label>
                                                <input type="file" class="dropify" name="user_pic" >
                                                <input type="hidden" name="user_pic_old" value="<?php echo $user_data['user_pic'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 text-right m-t-20">
                                            <button type="submit" id="submit" class="btn btn-primary">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="Change_Password">
                        <div class="col-lg-6 col-md-6 offset-lg-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Change Password</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php echo form_open_multipart('data/users/updatepassword','id="updatepassword" name="updatepassword" autocomplete="off" ');?>
                                        <div class="row clearfix">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <input type="password" class="form-control pwd" placeholder="Current Password" name="opasscode">
                                                    <input type="hidden"name="user_id" value="<?php echo $user_data['user_id'];?>" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control npwd" placeholder="New Password" name="passcode">
                                                    <span style="color:red;display:none;" id="match">Passwords should not be the same!</span>
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control cpwd" placeholder="Confirm New Password" name="cpasscode">
                                                    <span style="color:red;display:none;" id="notmatch">Passwords do not match!</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 m-t-20 text-right">
                                                <button type="submit" id="updatepasswordbtn" class="btn btn-primary">SAVE</button> &nbsp;
                                                <button type="button" class="btn btn-default">CANCEL</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('keyup','.user_name', function(e) { 
        var fname = $("#fname").val();
        var mname = $("#mname").val();
        var lname = $("#lname").val();
        $("#user_name").val(fname+' '+mname+' '+lname);
    });

    $(document).on('keyup','.cpwd', function(e) { 
        var npwd = $(".npwd").val();
        var cpwd = $(".cpwd").val();
        if( npwd != cpwd){
            $("#notmatch").show();
        }else{
            $("#notmatch").hide();
        }
    });

    $(document).on('keyup','.npwd', function(e) { 
        var pwd = $(".pwd").val();
        var npwd = $(".npwd").val();
        if( npwd == pwd){
            $("#match").show();
        }else{
            $("#match").hide();
        }
    });

    $(document).ready(function(){
        $(".datepicker").datepicker({
            "format": "d-m-yyyy",
        });
        var value = $("#emp_type").val();
        showdate(value)
    });

    function showdate(value){
        if(value == 'Contract'){
            $("#datediv").show();
        }else{
            $("#datediv").hide();
        }
    }

    $(document).on('click','#submit', function(e) { 
        e.preventDefault();		
        if($("#updateuser")[0].reportValidity()) 
        {
            var datastring =  new FormData($('#updateuser')[0]); 
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/user/update',
                enctype: 'multipart/form-data',
                data: datastring,    
                contentType: false,
                processData:false,
                cache: false,
                dataType:"JSON",
                token: '<?php echo $this->security->get_csrf_hash();?>',
                success:function(data){
                    console.log(data);
                    $('#token').val(data.csrfHash);
                    if(data.status == 1){				
                        swal({title: 'Action Update!',text: data.msg,type: 'success'},function() {
                            window.location.reload();
                        });
                    }else{				
                        swal({title: 'Action Update!',text: data.msg,type: 'error'},function() {
                            window.location.reload();
                        });
                    }
                },
                timeout: 10000,
                async: false			
            });
        }
    });

    $(document).on('click','#updatepasswordbtn', function(e) { 
        e.preventDefault();		
        if($("#updatepassword")[0].reportValidity()) 
        {
            var datastring =  new FormData($('#updatepassword')[0]); 
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/user/updatepassword',
                enctype: 'multipart/form-data',
                data: datastring,    
                contentType: false,
                processData:false,
                cache: false,
                dataType:"JSON",
                token: '<?php echo $this->security->get_csrf_hash();?>',
                success:function(data){
                    console.log(data);
                    $('#token').val(data.csrfHash);
                    if(data.status == 1){				
                        swal({title: 'Action Update!',text: data.msg,type: 'success'},function() {
                            window.location.assign("http://localhost/task-manager/logout")
                        });
                    }else{				
                        swal({title: 'Action Update!',text: data.msg,type: 'error'},function() {
                            window.location.reload();
                        });
                    }
                },
                timeout: 10000,
                async: false			
            });
        }
    });

</script>