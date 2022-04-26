<!doctype html>
<html lang="en" dir="ltr">

<!-- soccer/project/login.html  07 Jan 2020 03:42:43 GMT -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>I-STEM Task Manager</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->config->item('base_url'); ?>assets/images/logo/ico.jpeg" />
	<!-- Bootstrap Core and vandor -->
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/bootstrap/css/bootstrap.min.css" />
	<!-- Core css -->
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/main.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/theme1.css"/>
	<link href="<?php echo $this->config->item('base_url');?>assets/css/fonts.css" rel="stylesheet">
	<link href="<?php echo $this->config->item('base_url');?>assets/css/font-awesome.min.css" rel="stylesheet">
	<style>
	.auth .auth_right.full_img {
		height: 100vh;
		background-image: url(<?php echo $this->config->item('base_url');?>assets/images/login.png);
		background-size: cover;
		background-repeat: no-repeat;
		background-position: right;
	}
	.auth .auth_left .card {
		left: 150px!important;
	}
	</style>
</head>
<body class="font-montserrat" style="overflow-y: hidden;">

<div class="auth">
    <div class="auth_left">
        <div class="card">
            <div class="text-center mb-2">
                <a class="header-brand" href="index-2.html"><i class="fa fa-soccer-ball-o brand-logo"></i></a>
            </div>
            <div class="card-body">    
				<?php echo form_open('login-verification'); ?>
					<div class="card-title">Login to your account</div>
					<!--<div class="form-group">
						<select class="custom-select" name="user_role">
							<option>Project Manager</option>
							<option>Team Leader</option>
							<option>Employee</option>
						</select>
					</div>-->
					<div class="form-group">
						<label class="form-label">User Name/Email</label>
						<input type="email" name="user_detail" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group">
						<label class="form-label">Password<a href="forgot-password.html" class="float-right small">I forgot password</a></label>
						<input type="password" name="user_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
					<div class="form-group">
						<label class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input" />
						<span class="custom-control-label">Remember me</span>
						</label>
					</div>
					<div class="form-footer">
						<button type="submit" class="btn btn-primary btn-block" title="">Sign in</button>
					</div>
                </form>
            </div>
            <div class="text-center text-muted">
                <!--Don't have account yet? <a href="register.html">Sign up</a>-->
            </div>
        </div>        
    </div>	
    <div class="auth_right full_img"></div>
</div>

<script src="<?php echo $this->config->item('base_url');?>assets/bundles/lib.vendor.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/core.js"></script>
</body>

<!-- soccer/project/login.html  07 Jan 2020 03:42:43 GMT -->
</html>
<script>
// $(document).on('click','#submit', function(e) { 
    // e.preventDefault(); 		
	// var datastring =  new FormData($('#Login')[0]);
    // $.ajax({
        // type:'POST',
        // url:'<?php echo $this->config->item("base_url");?>istem-dashboard-login/verification',
        // enctype: 'multipart/form-data',
        // data: datastring,    
        // contentType: false,
        // processData:false, 		 
        // cache: false,
        // dataType:"JSON",
        // success:function(data){
			// console.log(data);
			// return false;
            // if(data.status == '0'){
                // location.replace ('<?php echo $this->config->item('base_url');?>istem-dashboard-login/login/'+data.msg);
            // }else{
                // localStorage.clear();	
                // location.replace ('<?php echo $this->config->item('base_url');?>home/'+data.msg);
            // }			
        // },
        // timeout: 10000,
        // async: false			
    // });	
// });

</script>
