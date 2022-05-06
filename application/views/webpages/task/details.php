	<style>	
        .userul{
            width: auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
	
        .team-info li+li {
            margin-left: 0px;
        }
        .team-info li {
            margin-top: 5px;
        }
        .table td, .table th {
            padding: 0.25rem;
        }
        .fa-list-check:before, .fa-tasks:before {
            content: "\f0ae";
        }
        .dropify-wrapper{
            height: 100px;
        }
        	
	.dropdown {
		display: inline-block;
		position: relative;
	}

	.dd-button {
		display: inline-block;
		border: 1px solid gray;
		border-radius: 4px;
		padding: 2px 20px 2px 5px;
		background-color: #ffffff;
		cursor: pointer;
		white-space: nowrap;
	}

	.dd-button:after {
		content: '';
		position: absolute;
		top: 50%;
		right: 5px;
		transform: translateY(-50%);
		width: 0; 
		height: 0; 
		border-left: 5px solid transparent;
		border-right: 5px solid transparent;
		border-top: 5px solid black;
	}

	.dd-button:hover {
		background-color: #eeeeee;
	}

	.dd-input {
		display: none;
	}

	.dd-menu {
		position: absolute;
		top: 100%;
		border: 1px solid #ccc;
		border-radius: 4px;
		padding: 0;
		margin: 2px 0 0 0;
		box-shadow: 0 0 6px 0 rgba(0,0,0,0.1);
		background-color: #ffffff;
		list-style-type: none;
		right: 0;    
		z-index: 1;
	}

	.dd-input + .dd-menu {
		display: none;
	} 

	.dd-input:checked + .dd-menu {
		display: block;
	} 

	.dd-menu li {
		padding: 10px 20px;
		cursor: pointer;
		white-space: nowrap;
	}

	.dd-menu li a {
		display: block;
		margin: -10px -20px;
		padding: 10px 20px;
	}

	.dd-menu li.divider{
		padding: 0;
		border-bottom: 1px solid #cccccc;
	}
	.dropa {
		text-decoration: none;
		color: #000000;
	}

	.dropa:hover {
		color: #222222
	}
    
    .table-responsive {
        overflow-x: unset;
    }
    li:last-child {
        padding-bottom: 10px;
    }
    .todo_list li {
        padding-bottom: 0px;
        margin-bottom: 0px;
    }
    .dd-menu li {
        padding: 2px 10px 2px 10px !important;
    }

    .totostatus label {
        display: table-cell;
        margin: 0.5rem;
    }
    .dd-button:hover {
        background-color: #2185d0;
        color: white;
    }
    .dd-menu li:hover{
        background-color: #e2e2e2;
    }

    .fa-ellipsis-v:before, .fa-ellipsis-vertical:before {
        content: "\f142";
    }

    #cke_1_contents{
        height:150px !important;
    }
    </style>

	<?php                 
		$taskboardread 		= $this->rolemodel->getpermission('taskboard','read');                   
		$taskboardwrite 	= $this->rolemodel->getpermission('taskboard','write');                   
		$taskboarddelete	= $this->rolemodel->getpermission('taskboard','delete');                   
		$taskboardcreate	= $this->rolemodel->getpermission('taskboard','create');                   
		$taskboardimport	= $this->rolemodel->getpermission('taskboard','import');                   
		$taskboardexport 	= $this->rolemodel->getpermission('taskboard','export');                   
	?>

    <div class="section-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <ul class="nav nav-tabs page-header-tab">
                            <li class="nav-item"><a class="nav-link active" id="TaskBoard-tab" data-toggle="tab" href="#TaskBoard-list">Task Detailed View</a></li> 
                        </ul>
                        <div class="header-action d-flex">
                            <button onclick="javascript:window.history.back();" class="btn btn-sm btn-danger">Back</button>
                        </div>
                    </div>
                </div>
            </div>                            
        </div>
    </div>

    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix">       

                <div class="col-lg-4 col-md-12">
                    <div class="card c_grid c_yellow">  
                        <div class="card-header">
                            <h3 class="card-title">Created By</h3>
                        </div>
                        <div class="card-body text-left">
                            <ul class="list-unstyled team-info">
                                <?php 
                                    foreach($allusers as $uoutput){
                                        if($uoutput->user_id == $taskbyid->created_by){
                                            $cname = $uoutput->user_name;
                                            $cemail = $uoutput->email;
                                            $cphone = $uoutput->phone;
                                        }
                                    }
                                ?>
                                <li><img src="<?php echo $this->config->item("base_url");?>assets/images/user.png" data-toggle="tooltip" data-placement="top" title="<?php echo $cemail;?>" alt="Avatar"><?php echo $cname;?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Task Info</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                <div class="item-action dropdown ml-2">
                                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <!-- <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                        <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <small class="text-muted">Team: </small>
                                    <p class="mb-0">
                                        <?php 
                                            $tags = explode(',',$taskbyid->assign_to);
                                            $taskteam = '';
                                            foreach($tags as $key) { 
                                                foreach($allusers as $uoutput){
                                                    if($uoutput->user_id == $key){
                                                        $taskteam .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->email.'" alt="Avatar">'.$uoutput->user_name.'</li>';
                                                    }
                                                }
                                            }
                                        ?> 
                                        <ul class="list-unstyled team-info userul">
                                            <?php echo $taskteam;?>
                                        </ul>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">Followers: </small>
                                    <p  class="mb-0">
                                        <?php 
                                            $followerstag = explode(',',$taskbyid->followers);
                                            $followers = '';
                                            foreach($followerstag as $fkey) { 
                                                foreach($allusers as $uoutput){
                                                    if($uoutput->user_id == $fkey){
                                                        $followers .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->email.'" alt="Avatar">'.$uoutput->user_name.'</li>';
                                                    }
                                                }
                                            }
                                        ?>
                                        <ul class="list-unstyled team-info userul">
                                            <?php echo $followers; ?>
                                        </ul>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">Start Date: </small>
                                    <p  class="mb-0"><?php echo $taskbyid->date_from;?></p>
                                </li>
                                <li class="list-group-item">
                                    <small class="text-muted">Due Date: </small>
                                    <p  class="mb-0"><?php echo $taskbyid->date_to;?></p>
                                </li>
                                <li class="list-group-item">
                                    <div><?php echo $taskbyid->task_status;?></div>
                                    <div class="progress progress-xs mb-0">
                                        <div class="progress-bar bg-info" style="width: 50%"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                    <div class="card c_grid c_yellow">  
                        <div class="card-header">
                            <h3 class="card-title">Task Details</h3>
                            <div class="card-options">
                                <label <?php if($taskboardwrite == '0' ){ echo 'style="pointer-events: none;"' ;}?> class="dropdown todo_list" style="margin: 0px;">
                                    Task Status : 
                                    <div class="dd-button">
                                        <?php echo $taskbyid->task_status;?>
                                    </div>
                                    <input type="checkbox" class="dd-input" id="test">
                                    <ul class="dd-menu">
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'Open')">Open</li>
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'On Process')">On Process</li>
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'On Hold')">On Hold</li>
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'Clarity Needed')">Clarity Needed</li>   
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'Testing')">Testing</li>
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'Completed')">Completed</li>
                                        <li onclick="changetaskstatus(<?php echo $taskbyid->task_id;?>,'Closed')">Closed</li>
                                        <!-- <li class="divider"></li>
                                        <li><a href="http://rane.io">Link to Rane.io</a></li> -->
                                    </ul>										
                                </label>
                            </div>
                        </div>
                        <div class="card-body text-left">
                            <p>Title : <?php echo $taskbyid->title;?></p>
                            <span>Description : <?php echo $taskbyid->description;?></span>
                        </div>
                    </div>
                    <div class="card c_grid c_yellow">  
                        <div class="card-header">
                            <h3 class="card-title">Task Todo Details</h3>
                            <div class="card-options">
                                <button type="button" <?php if($taskboardcreate == '0' ){ echo 'style="pointer-events: none;"' ;}?> class="ml-15 btn btn-primary" onclick="taskid(<?php echo $taskbyid->task_id?>)" data-toggle="modal" data-target="#addtasktodo"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add Todo</button> 
                            </div>
                        </div>
                        <div class="card-body text-left">
                            <div class="table-responsive todo_list">
                                <table class="table table-hover table-striped table-vcenter mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Title</th>
                                            <th style="width:70%;"class="">Description</th>
                                            <th class="15%">status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if($alltasktodo){
                                            $a=1;
                                            foreach($alltasktodo as $tasktodooutput){
                                            $b=$a++;
                                        ?>
                                        <tr>
                                            <td>                                                  
                                                <span ><?php echo $tasktodooutput->title;?></span>
                                            </td>
                                            <td><?php echo $tasktodooutput->description;?></td>
                                            <td class="totostatus"> 
                                                <label <?php if($taskboardwrite == '0' ){ echo 'style="pointer-events: none;"' ;}?> class="dropdown">
                                                    <div class="dd-button">
                                                        <?php echo $tasktodooutput->tasktodo_status;?>
                                                    </div>
                                                    <input type="checkbox" class="dd-input" id="test">
                                                    <ul class="dd-menu">
                                                        <li onclick="changetasktodostatus(<?php echo $tasktodooutput->task_todo_id;?>,'Queued')">Queued</li>
                                                        <li onclick="changetasktodostatus(<?php echo $tasktodooutput->task_todo_id;?>,'Running')">Running</li>
                                                        <li onclick="changetasktodostatus(<?php echo $tasktodooutput->task_todo_id;?>,'On Hold')">On Hold</li>
                                                        <li onclick="changetasktodostatus(<?php echo $tasktodooutput->task_todo_id;?>,'Completed')">Completed</li>
                                                        <!-- <li class="divider"></li>
                                                        <li><a href="http://rane.io">Link to Rane.io</a></li> -->
                                                    </ul>										
                                                </label>
                                            </td>
                                        </tr>
                                        <?php } } ?>                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
				            <?php echo form_open_multipart('data/task/taskcomment','id="taskcomment" name="taskcomment" autocomplete="on" ');?>
                                <div class="col-lg-12" style="padding: 0rem;">
                                    <div class="form-group" style="margin-bottom: 0rem;">
                                        <label>Task Comment</label>
                                        <textarea cols="50" id="editor1" name="task_comment" rows="3"></textarea>
                                        <input type="hidden" name="task_id" value="<?php echo $this->uri->segment(3);?>" /> 
                                    </div>
                                </div>
                                <!-- <div class="summernote"> </div> -->
                                <div class="mt-2 text-right">
                                    <a tye="button" id="OpenImgUpload" class="btn btn-warning"><i class="fa fa-camera" id="filename"> </i></a>
                                    <input type="file" name="comment_attachment" id="imgupload" onchange="fileSelect(this.id)" style="display:none"/> 
                                    <script>$('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click');  });function fileSelect(id){ var file = $('#'+id)[0].files[0]; $("#filename").html(' '+file.name); }</script>
                                    <button class="btn btn-primary" type="submit" id="submittaskcomment" >Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Task Comments</h3>
                            <div class="card-options">
                                <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                foreach($alltaskcomment as $tcoutput){ 
                                    if($tcoutput->task_id == $this->uri->segment(3)){
                            ?>
                            <div class="timeline_item ">
                                <img class="tl_avatar" src="<?php echo $this->config->item("base_url");?>assets/images/user.png" alt="">
                                <span><a href="javascript:void(0);">Elisse Joson</a> San Francisco, CA 
                                    <small class="float-right text-right">20-April-2019 - Today 
                                        <div class="item-action dropdown ml-2 ">
                                            <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-ellipsis-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                            </div>
                                        </div>
                                    </small> 
                                </span>
                                <h6 class="font600">Hello, 'Im a single div responsive timeline without media Queries!</h6>
                                <div class="msg">
                                    <?php echo $tcoutput->comment;?>
                                    <!-- <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 12 Love</a> -->
                                    <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample_<?php echo $tcoutput->task_comment_id?>" aria-expanded="false" aria-controls="collapseExample_<?php echo $tcoutput->task_comment_id?>"><i class="fa fa-comments"></i>
                                    <?php  
                                        $a = 1;
                                        $b = 0;
                                        foreach($alltaskreplay as $tcrcoutput){ 
                                            if($tcrcoutput->task_id == $this->uri->segment(3) && $tcoutput->task_comment_id  == $tcrcoutput->comment_replay_id){
                                                $b = $a++;
                                            }
                                        }
                                        echo $b;
                                    ?> Replie</a>
                                    <div class="collapse p-4 section-gray mt-2" id="collapseExample_<?php echo $tcoutput->task_comment_id?>">                                       
				                        <?php echo form_open_multipart('data/task/createtaskrelaycomment','id="taskrelaycomment" name="taskrelaycomment" autocomplete="on" ');?>
                                            <div class="form-group">
                                                <textarea rows="2" class="form-control no-resize" name="replay_comment" placeholder="Enter here for tweet..."></textarea>
                                                <input type="hidden" name="reply_task_id" value="<?php echo $this->uri->segment(3);?>" />
                                                <input type="hidden" name="comment_replay" value="1" />
                                                <input type="hidden" name="comment_replay_id" value="<?php echo $tcoutput->task_comment_id?>" />
                                            </div>
                                            <div class="col-lg-12 text-right" style="padding:0px;">
                                                <button class="btn btn-primary" type="submit" id="submittaskreplaycomment" >Submit</button>
                                            </div>
                                        </form>
                                        <ul class="recent_comments list-unstyled mt-4 mb-0">
                                            <?php
                                                foreach($alltaskreplay as $tcroutput){ 
                                                    if($tcroutput->task_id == $this->uri->segment(3) && $tcoutput->task_comment_id  == $tcroutput->comment_replay_id){
                                            ?>
                                                <li>
                                                    <div class="avatar_img">
                                                        <img style="width: 30px;" class="rounded img-fluid" src="<?php echo $this->config->item("base_url");?>assets/images/user.png" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h6>Donald Gardner <small class="float-right font-14">Just now</small></h6>
                                                        <?php echo $tcroutput->comment;?>
                                                    </div>
                                                </li>
                                            <?php } } ?>
                                        </ul>
                                    </div>
                                </div>                                
                            </div>
                            <?php } } ?>

                        </div>
                    </div>

                </div>                  
            </div>
        </div>
    </div>

        
	<!-- Add New Module -->
	<div class="modal fade" id="addtasktodo" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="title" id="defaultModalLabel">Add New Task Todo</h6>
				</div>
				<?php echo form_open_multipart('data/task/tasktodo','id="tasktodo" name="tasktodo" autocomplete="on" ');?>
					<div class="modal-body">
						<div class="row clearfix">
							<div class="col-12">
								<div class="form-group">                                   
									<input type="hidden" id="task_id" name="task_id" >
									<input type="text" class="form-control" placeholder="Title" name="title" required>
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<textarea class="form-control" placeholder="Description" name="description" required></textarea>
								</div>
							</div>                   
							<div class="col-12">
								<div class="form-group">
                                    <input type="file" class="dropify" name="task_todo_attachment">
								</div>
							</div>                   
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="submittasktodo" class="btn btn-primary">Add</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

    <script>
        CKEDITOR.replace('editor1');

		function taskid(task_id){
			$("#task_id").val(task_id);
		}

		$(document).on('click','#submittasktodo', function(e) { 
			e.preventDefault();		
			if($("#tasktodo")[0].reportValidity()) 
			{
				var datastring =  new FormData($('#tasktodo')[0]); 
				$.ajax({
					type:'POST',
					url:'<?php echo $this->config->item("base_url");?>data/task/createtasktodo',
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

		function changetaskstatus(id,status) { 
			// alert(status);
			// alert(id);
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/task/changetaskstatus',
                enctype: 'multipart/form-data',
                data: {id:id,task_status:status},    
                // contentType: false,
                // processData:false,
                // cache: false,
                dataType:"JSON",
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

		function changetasktodostatus(id,status) { 
			// alert(status);
			// alert(id);
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/task/changetasktodostatus',
                enctype: 'multipart/form-data',
                data: {id:id,tasktodo_status:status},    
                // contentType: false,
                // processData:false,
                // cache: false,
                dataType:"JSON",
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

        $(document).on('click','#submittaskcomment', function(e) { 
			e.preventDefault();		
			if($("#taskcomment")[0].reportValidity()) 
			{
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
				var datastring =  new FormData($('#taskcomment')[0]); 
				$.ajax({
					type:'POST',
					url:'<?php echo $this->config->item("base_url");?>data/task/createtaskcomment',
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

        $(document).on('click','#submittaskreplaycomment', function(e) { 
			e.preventDefault();		
			if($("#taskrelaycomment")[0].reportValidity()) 
			{
                for (instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
				var datastring =  new FormData($('#taskrelaycomment')[0]); 
				$.ajax({
					type:'POST',
					url:'<?php echo $this->config->item("base_url");?>data/task/createtaskrelaycomment',
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
	</script>