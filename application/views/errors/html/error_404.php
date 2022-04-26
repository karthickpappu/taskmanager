<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
header('X-XSS-Protection: 1; mode=block');
header('X-Frame-Options: deny');
header('X-Content-Type-Options: nosniff');
header("Content-Security-Policy: report-url /report-csp.php");
header("Strict-Transport-Security: max-age=31536000");

?>
<?php
$CI =& get_instance();
if( ! isset($CI))
{
    $CI = new CI_Controller();
}
$CI->load->helper('url');
?>
<!doctype html>
<html lang="en" dir="ltr">
<!-- soccer/project/404.html  07 Jan 2020 03:42:43 GMT -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>I-STEM Task Manager</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/logo/ico.jpeg" />
	<!-- Bootstrap Core and vandor -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" />
	<!-- Core css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme1.css"/>
	<link href="<?php echo base_url();?>assets/css/fonts.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/css/font-awesome.min.css" rel="stylesheet">
</head>
<body class="font-montserrat">

<div class="auth">
    <div class="auth_right full_img"></div>
    <div class="auth_left">
        <div class="card">
            <div class="card-body">
                <div class="display-3 text-muted mb-5"><i class="si si-exclamation"></i> 404</div>
                <h1 class="h3 mb-3">Oops.. You just found an error page..</h1>
                <p class="h6 text-muted font-weight-normal mb-3">We are sorry but our service is currently not available&hellip;</p>
                <a class="btn btn-primary" href="javascript:history.back()"><i class="fa fa-arrow-left mr-2"></i>Go back</a>
            </div>
        </div>        
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/bundles/lib.vendor.bundle.js"></script>
<script src="<?php echo base_url(); ?>assets/js/core.js"></script>
</body>

<!-- soccer/project/404.html  07 Jan 2020 03:42:43 GMT -->
</html>