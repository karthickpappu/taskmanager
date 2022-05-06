<!doctype html>
<?PHP
	header('Access-Control-Allow-Origin: *');
?>
<html lang="en" dir="ltr">
<!-- soccer/project/  07 Jan 2020 03:36:49 GMT -->
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>I-STEM Task Manager</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->config->item('base_url'); ?>assets/images/logo/ico.jpeg" />
	<!-- Bootstrap Core and vandor -->
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/bootstrap/css/bootstrap.min.css" />
	<!-- Plugins css -->
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/charts-c3/c3.min.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/sweetalert/sweetalert.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/dropify/css/dropify.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/nestable/jquery-nestable.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/plugins/summernote/dist/summernote.css"/>
	<!-- Core css -->
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/main.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/theme1.css"/>
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/fonts.css">
	<link rel="stylesheet" href="<?php echo $this->config->item('base_url');?>assets/css/font-awesome.min.css">
	<script src="<?php echo $this->config->item('base_url');?>assets/ckeditor/ckeditor.js"></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css'>
	<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
	<!-- Core css -->
	<style>

		.h5, h5 {
			font-size: 1rem !important;
		}
		#left-sidebar {
			padding: 15px 15px 20px 65px !important;
		}
		.page-title {
			color: #ffffff !important;
		}
		.fa {
			display: initial;
			font: normal normal normal 14px/1 FontAwesome;
			font-size: inherit;
			text-rendering: auto;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}
		.metismenu ul a::before {
			font-size: 10px;
			font-family: 'FontAwesome' !important;
			content: "\f067" !important;
			position: absolute;
			left: 1px;
			top: 8px
		}
		
		.avatar {
			color: #4D5052;
			font-weight: 600;
			width: 2rem;
			height: 2rem;
			line-height: 2rem;
			border-radius: 50%;
			display: inline-block;
			background: #e6e7e7 no-repeat center/cover;
			position: relative;
			vertical-align: bottom;
			font-size: .875rem;
			user-select: none;
		}

        .dropify-font-upload:before, .dropify-wrapper .dropify-message span.file-icon:before {
            content: '\f0ee' !important;
            display: initial;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
        }   
	</style>
</head>
<body class="font-montserrat">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader"> </div>
</div>

<div id="main_content">
    <div id="header_top" class="header_top">
        <div class="container">
            <div class="hleft">
                <a class="header-brand" href="<?php echo $this->config->item('base_url');?>"><img src="<?php echo $this->config->item('base_url'); ?>assets/images/logo/ico.jpeg" style="border-radius:50%;width:35px;"></a>
                <div class="dropdown">
                    <!--<a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="<?php echo $this->config->item('base_url');?>assets/images/user.png" alt="" data-toggle="tooltip" data-placement="right" title="User Menu"/></a>
                    <a href="page-search.html" class="nav-link icon xs-hide"><i class="fa fa-search"></i></a>
                    <a href="<?php echo $this->config->item('base_url');?>home/calendar"  class="nav-link icon app_inbox xs-hide"><i class="fa fa-calendar"></i></a>
                    <a href="app-contact.html"  class="nav-link icon xs-hide"><i class="fa fa-id-card-o"></i></a>
                    <a href="app-chat.html"  class="nav-link icon xs-hide"><i class="fa fa-comments-o"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon theme_btn xs-hide"><i class="fa fa-paint-brush" data-toggle="tooltip" data-placement="right" title="Themes"></i></a>-->
                </div>
            </div>
            <div class="hright">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link icon settingbar"><i class="fa fa-gear fa-spin" data-toggle="tooltip" data-placement="right" title="Settings"></i></a>
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa  fa-align-left"></i></a>
                </div>            
            </div>
        </div>
    </div>

    <div id="rightsidebar" class="right_sidebar">
        <a href="javascript:void(0)" class="p-3 settingbar float-right"><i class="fa fa-close"></i></a>
        <div class="p-4">
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                <div class="custom-controls-stacked font_setting">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-opensans">
                        <span class="custom-control-label">Open Sans Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-montserrat" checked="">
                        <span class="custom-control-label">Montserrat Google Font</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="font" value="font-roboto">
                        <span class="custom-control-label">Robot Google Font</span>
                    </label>
                </div>
            </div>
            <hr>
            <div class="mb-4">
                <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
                <div class="custom-controls-stacked arrow_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-a">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="marrow" value="arrow-c" checked="">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
                <div class="custom-controls-stacked list_option">
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                        <span class="custom-control-label">A</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                        <span class="custom-control-label">B</span>
                    </label>
                    <label class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                        <span class="custom-control-label">C</span>
                    </label>
                </div>
            </div>
            <hr>
            <div>
                <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                <ul class="setting-list list-unstyled mt-1 setting_switch">
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Night Mode</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Fix Navbar top</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Header Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader" checked="">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Min Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Sidebar Dark</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Icon Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Gradient Color</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Shadow</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">RTL Support</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                    <li>
                        <label class="custom-switch">
                            <span class="custom-switch-description">Box Layout</span>
                            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                            <span class="custom-switch-indicator"></span>
                        </label>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="form-group">
                <label class="d-block">Storage <span class="float-right">77%</span></label>
                <div class="progress progress-sm">
                    <div class="progress-bar" role="progressbar" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100" style="width: 77%;"></div>
                </div>
                <button type="button" class="btn btn-primary btn-block mt-3">Upgrade Storage</button>
            </div>
        </div>
    </div>

    <div class="theme_div">
        <div class="card">
            <div class="card-body">
                <ul class="list-group list-unstyled">
                    <li class="list-group-item mb-2">
                        <p>Default Theme</p>
                        <a href="index-2.html"><img src="<?php echo $this->config->item('base_url');?>assets/images/themes/default.png" class="img-fluid" /></a>
                    </li>
                    <li class="list-group-item mb-2">
                        <p>Night Mode Theme</p>
                        <a href="project-dark/index.html"><img src="<?php echo $this->config->item('base_url');?>assets/images/themes/dark.png" class="img-fluid" /></a>
                    </li>                    
                    <li class="list-group-item mb-2">
                        <p>RTL Version</p>
                        <a href="project-rtl/index.html"><img src="<?php echo $this->config->item('base_url');?>assets/images/themes/rtl.png" class="img-fluid" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="user_div">
        <h5 class="brand-name mb-4">I-STEM Task Manager<a href="javascript:void(0)" class="user_btn"><i class="fa fa-close"></i></a></h5>
        <div class="card-body">
            <a href="page-profile.html"><img class="card-profile-img" src="<?php echo $this->config->item('base_url');?>assets/images/profile/sanjeev.png" alt=""></a>
            <h6 class="mb-0"><?php echo $user_data['user_name'];?></h6>
            <span><?php echo $user_data['email'];?></span>
            <div class="d-flex align-items-baseline mt-3">
                <h3 class="mb-0 mr-2">9.8</h3>
                <p class="mb-0"><span class="text-success">1.6% <i class="fa fa-arrow-up"></i></span></p>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-orange" role="progressbar" style="width: 5%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-indigo" role="progressbar" style="width: 13%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <h6 class="text-uppercase font-10 mt-1">Performance Score</h6>
            <hr>
            <p>Activity</p>
            <ul class="new_timeline">
                <li>
                    <div class="bullet pink"></div>
                    <div class="time">11:00am</div>
                    <div class="desc">
                        <h3>Attendance</h3>
                        <h4>Computer Class</h4>
                    </div>
                </li>
                <li>
                    <div class="bullet pink"></div>
                    <div class="time">11:30am</div>
                    <div class="desc">
                        <h3>Added an interest</h3>
                        <h4>“Volunteer Activities”</h4>
                    </div>
                </li>
                <li>
                    <div class="bullet green"></div>
                    <div class="time">12:00pm</div>
                    <div class="desc">
                        <h3>Developer Team</h3>
                        <h4>Hangouts</h4>
                        <ul class="list-unstyled team-info margin-0 p-t-5">                                            
                            <li><img src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                            <li><img src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                            <li><img src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar3.jpg" alt="Avatar"></li>
                            <li><img src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar4.jpg" alt="Avatar"></li>                                            
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="bullet green"></div>
                    <div class="time">2:00pm</div>
                    <div class="desc">
                        <h3>Responded to need</h3>
                        <a href="javascript:void(0)">“In-Kind Opportunity”</a>
                    </div>
                </li>
                <li>
                    <div class="bullet orange"></div>
                    <div class="time">1:30pm</div>
                    <div class="desc">
                        <h3>Lunch Break</h3>
                    </div>
                </li>
                <li>
                    <div class="bullet green"></div>
                    <div class="time">2:38pm</div>
                    <div class="desc">
                        <h3>Finish</h3>
                        <h4>Go to Home</h4>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div id="left-sidebar" class="sidebar ">
        <h5 class="brand-name">I-STEM Task Manager <a href="javascript:void(0)" class="menu_option float-right"><i class="fa fa-th" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Project</li>
                <?php                 
		            // $this->load->model('HeaderModel', 'headermodel', TRUE);
                    $dashboardread 	        = $this->rolemodel->getpermission('dashboard','read');
                    $projectread 	        = $this->rolemodel->getpermission('project','read');
                    $taskboardread 	        = $this->rolemodel->getpermission('taskboard','read');
                    $userread 	            = $this->rolemodel->getpermission('user','read');
                    $todoread 	            = $this->rolemodel->getpermission('todo list','read');
                    $masterread 	        = $this->rolemodel->getpermission('master','read');
                    $departmentread         = $this->rolemodel->getpermission('department','read');
                    $designationread 	    = $this->rolemodel->getpermission('designation','read');
                    $clientread 	        = $this->rolemodel->getpermission('client','read');
                    $vendorread 	        = $this->rolemodel->getpermission('vendor','read');
                    $rolesread 	            = $this->rolemodel->getpermission('roles','read');
                    $modulesread 	        = $this->rolemodel->getpermission('modules','read');
                    $roleaccessread 	    = $this->rolemodel->getpermission('role based access','read');
                    $useraccessread 	    = $this->rolemodel->getpermission('user based access','read');                    
                ?>
                <?php if($dashboardread){?>
                    <li class="<?php if($title =='dashboard') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                <?php } ?>
                <?php if($projectread){?>
				<li class="<?php if($title =='project') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>project"><i class="fa fa-list-ol"></i><span>Project list</span></a></li>
                <?php } ?>
                <?php if($taskboardread){?>
                <li class="<?php if($title =='taskboard') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>taskboard"><i class="fa fa-calendar-check-o"></i><span>Taskboard</span></a></li>
                <?php } ?>
				<!--<li class="<?php if($title =='ticket') echo 'active';?>">
                    <a href="javascript:void(0)" class="has-arrow arrow-c"aria-expanded="<?php if($title =='ticket') echo 'true';?>"><i class="fa fa-tag"></i><span>Ticket</span></a>
                    <ul>
                        <li><a href="<?php echo $this->config->item('base_url');?>ticket">Ticket List</a></li>
                        <li><a href="<?php echo $this->config->item('base_url');?>ticket/details">Ticket Details</a></li>
                    </ul>
                </li>-->
                <?php if($userread){?>
                <li class="<?php if($title =='user') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>user"><i class="fa fa-user"></i><span>user</span></a></li>
                <?php } ?>
                <?php if($todoread){?>
                <li class="<?php if($title =='todo-list') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>todo-list"><i class="fa fa-check-square-o"></i><span>Todo List</span></a></li>
                <?php } ?>
                <!--<li class="g_heading">App</li>
                <li><a href="app-calendar.html"><i class="fa fa-calendar"></i><span>Calendar</span></a></li>
                <li><a href="app-chat.html"><i class="fa fa-comments"></i><span>Chat</span></a></li>
                <li><a href="app-contact.html"><i class="fa fa-address-book"></i><span>Contact</span></a></li>
                <li><a href="app-filemanager.html"><i class="fa fa-folder"></i><span>FileManager</span></a></li>
                <li><a href="app-setting.html"><i class="fa fa-gear"></i><span>Setting</span></a></li>
                <li><a href="page-gallery.html"><i class="fa fa-photo"></i><span>Gallery</span></a></li>-->
                <?php if($masterread){?>
                <li  class="<?php if($title =='master') echo 'active';?>">
                    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa fa-lock"></i><span>Master</span></a>
                    <ul>
                        <?php if($departmentread){?>
                        <li class="<?php if($page =='department') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>master/department">Department</a></li>
                        <?php } ?>
                        <?php if($designationread){?>
                        <li class="<?php if($page =='designation') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>master/designation">Designation</a></li>
                        <?php } ?>
                        <?php if($clientread){?>
                        <li class="<?php if($page =='client') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>master/client">Client</a></li>
                        <?php } ?>
                        <?php if($vendorread){?>
                        <li class="<?php if($page =='vendor') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>master/vendor">Vendor</a></li>
                        <?php } ?>
                    </ul>
                </li> 
                <?php } ?>
                <?php if($rolesread){?>
                <li  class="<?php if($title =='access') echo 'active';?>">
                    <a href="javascript:void(0)" class="has-arrow arrow-c"><i class="fa fa-lock"></i><span>Roles</span></a>
                    <ul>
                        <?php if($modulesread){?>
                        <li class="<?php if($page =='modules') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>access/modules">Modules</a></li>
                        <?php } ?>
                        <?php if($roleaccessread){?>
                        <li class="<?php if($page =='role-based-access') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>access/role-based-access">Role Based Access</a></li>
                        <?php } ?>
                        <?php if($useraccessread){?>
                            <li class="<?php if($page =='user-based-access') echo 'active';?>"><a href="<?php echo $this->config->item('base_url');?>access/user-based-access">User Based Access</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <!--<li class="g_heading">Support</li>
                <li><a href="javascript:void(0)"><i class="fa fa-support"></i><span>Need Help?</span></a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-tag"></i><span>ContactUs</span></a></li>-->
            </ul>
        </nav>        
    </div>

    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Dashboard</h1>                        
                    </div>
                    <div class="right">
                        <div class="input-icon xs-hide mr-4">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-icon-addon"><i class="fa fa-search"></i></span>
                        </div>
                        <div class="notification d-flex">
                            <!--<div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-language"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="<?php echo $this->config->item('base_url');?>assets/images/flags/us.svg">English</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="<?php echo $this->config->item('base_url');?>assets/images/flags/es.svg">Spanish</a>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="<?php echo $this->config->item('base_url');?>assets/images/flags/jp.svg">japanese</a>
                                    <a class="dropdown-item" href="#"><img class="w20 mr-2" src="<?php echo $this->config->item('base_url');?>assets/images/flags/bl.svg">France</a>
                                </div>
                            </div>
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success nav-unread"></span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <ul class="right_chat list-unstyled w350 p-0">
                                        <li class="online">
                                            <a href="javascript:void(0);" class="media">
                                                <img class="media-object" src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar4.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Donald Gardner</span>
                                                    <div class="message">It is a long established fact that a reader</div>
                                                    <small>11 mins ago</small>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="online">
                                            <a href="javascript:void(0);" class="media">
                                                <img class="media-object " src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar5.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Wendy Keen</span>
                                                    <div class="message">There are many variations of passages of Lorem Ipsum</div>
                                                    <small>18 mins ago</small>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </a>                            
                                        </li>
                                        <li class="offline">
                                            <a href="javascript:void(0);" class="media">
                                                <img class="media-object " src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar2.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Matt Rosales</span>
                                                    <div class="message">Contrary to popular belief, Lorem Ipsum is not simply</div>
                                                    <small>27 mins ago</small>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </a>                            
                                        </li>
                                        <li class="online">
                                            <a href="javascript:void(0);" class="media">
                                                <img class="media-object " src="<?php echo $this->config->item('base_url');?>assets/images/xs/avatar3.jpg" alt="">
                                                <div class="media-body">
                                                    <span class="name">Phillip Smith</span>
                                                    <div class="message">It has roots in a piece of classical Latin literature from 45 BC</div>
                                                    <small>33 mins ago</small>
                                                    <span class="badge badge-outline status"></span>
                                                </div>
                                            </a>                            
                                        </li>                        
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
                                </div>
                            </div>-->
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-bell"></i><span class="badge badge-primary nav-unread"></span></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <ul class="list-unstyled feeds_widget">
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-check"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-danger">Issue Fixed <small class="float-right text-muted">11:05</small></h4>
                                                <small>WE have fix all Design bug with Responsive</small>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-user"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">New User <small class="float-right text-muted">10:45</small></h4>
                                                <small>I feel great! Thanks team</small>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">7 New Feedback <small class="float-right text-muted">Today</small></h4>
                                                <small>It will give a smart finishing to your site</small>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-question-circle"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title text-warning">Server Warning <small class="float-right text-muted">10:50</small></h4>
                                                <small>Your connection is not private</small>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="feeds-left"><i class="fa fa-shopping-cart"></i></div>
                                            <div class="feeds-body">
                                                <h4 class="title">7 New Orders <small class="float-right text-muted">11:35</small></h4>
                                                <small>You received a new oder from Tina.</small>
                                            </div>
                                        </li>                                   
                                    </ul>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0)" class="dropdown-item text-center text-muted-dark readall">Mark all as read</a>
                                </div>
                            </div>
                            <div class="dropdown d-flex">
                                <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2" data-toggle="dropdown"><i class="fa fa-user"></i></a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <a class="dropdown-item" href="page-profile.html"><i class="dropdown-icon fa fa-user"></i> Profile</a>
                                    <a class="dropdown-item" href="app-setting.html"><i class="dropdown-icon fa fa-gear"></i> Settings</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="dropdown-icon fa fa-inbox"></i> Inbox</a>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fa fa-send"></i> Message</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon fa fa-info"></i> Need help?</a>
                                    <a class="dropdown-item" href="<?php echo $this->config->item('base_url');?>logout"><i class="dropdown-icon fa fa-sign-out"></i> Sign out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>