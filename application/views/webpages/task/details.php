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
    </style>
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">                  
					
                    <div class="col-lg-8 col-md-12">
                        <div class="card c_grid c_yellow">  
							<div class="card-header">
								<h3 class="card-title">Task Details</h3>
							</div>
                            <div class="card-body text-left">
                                <p>Title : <?php echo $taskbyid->title;?></p>
                                <span>Description : <?php echo $taskbyid->description;?></span>
                            </div>
                        </div>
                        <div class="card c_grid c_yellow">  
							<div class="card-header">
								<h3 class="card-title">Task Details</h3>
							</div>
                            <div class="card-body text-left">
                                <div class="table-responsive todo_list">
                                    <table class="table table-hover table-striped table-vcenter mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width:30%;" class="text-left">Title</th>
                                                <th class="">Description</th>
                                                <th style="width:5%;" class=""></th>
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
                                                    <label class="custom-control custom-checkbox">
                                                        <input onclick="changetasktodostatus(<?php echo $tasktodooutput->task_todo_id;?>)" type="checkbox" class="custom-control-input" name="example-checkbox1" value="<?php echo $tasktodooutput->task_todo_id;?>">
                                                        <span class="custom-control-label"><?php echo $tasktodooutput->title;?></span>
                                                    </label>
                                                </td>
                                                <td><?php echo $tasktodooutput->description;?></td>
                                                <td>
                                                    <div class="item-action dropdown ml-2">
                                                        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-edit"></i> </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fas fa-list-check fa-lg"></i> Completed </a>
                                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-calendar-check"></i> Pending </a>
                                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-calendar-check"></i> Clarity Needed</a>
                                                        </div>
                                                    </div>
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
                                <div class="summernote">
                                    Hi there,
                                    <br/>
                                    <p>The toolbar can be customized and it also supports various callbacks such as <code>oninit</code>, <code>onfocus</code>, <code>onpaste</code> and many more.</p>
                                    <br/>
                                    <p>Thank you!</p>
                                    <h6>Summer Note</h6>
                                </div>
                                <div class="mt-4 text-right">
                                    <button class="btn btn-warning"><i class="fa fa-link"></i></button>
                                    <button class="btn btn-warning"><i class="fa fa-camera"></i></button>
                                    <button class="btn btn-primary">Post</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Task Replies</h3>
                                <div class="card-options">
                                    <a href="javascript:void(0)" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                    <div class="item-action dropdown ml-2">
                                        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-more-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar1.jpg" alt="">
                                    <span><a href="javascript:void(0);">Elisse Joson</a> San Francisco, CA <small class="float-right text-right">20-April-2019 - Today</small></span>
                                    <h6 class="font600">Hello, 'Im a single div responsive timeline without media Queries!</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web card she has is the Lorem card.</p>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 12 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-comments"></i> 1 Comment</a>
                                        <div class="collapse p-4 section-gray mt-2" id="collapseExample">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                            <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="rounded img-fluid" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar4.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h6>Donald Gardner <small class="float-right font-14">Just now</small></h6>
                                                        <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>                                
                                </div>
                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar4.jpg" alt="">
                                    <span><a href="javascript:void(0);" title="">Dessie Parks</a> Oakland, CA <small class="float-right text-right">19-April-2019 - Yesterday</small></span>
                                    <h6 class="font600">Oeehhh, that's awesome.. Me too!</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. on the web by far... While that's mock-ups and this is politics, are they really so different? I think the only card she has is the Lorem card.</p>
                                        <div class="timeline_img mb-20">
                                            <img class="width100" src="<?php echo $this->config->item("base_url");?>assets/images/gallery/1.jpg" alt="Awesome Image">
                                            <img class="width100" src="<?php echo $this->config->item("base_url");?>assets/images/gallery/2.jpg" alt="Awesome Image">
                                        </div>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 23 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1"><i class="fa fa-comments"></i> 2 Comment</a>
                                        <div class="collapse p-4 section-gray mt-2" id="collapseExample1">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                            <ul class="recent_comments list-unstyled mt-4 mb-0">
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="rounded img-fluid" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar4.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h6>Donald Gardner <small class="float-right font-14">Just now</small></h6>
                                                        <p>Lorem ipsum Veniam aliquip culpa laboris minim tempor</p>
                                                        <div class="timeline_img mb-20">
                                                            <img class="width150" src="<?php echo $this->config->item("base_url");?>assets/images/gallery/7.jpg" alt="Awesome Image">
                                                            <img class="width150" src="<?php echo $this->config->item("base_url");?>assets/images/gallery/8.jpg" alt="Awesome Image">
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="avatar_img">
                                                        <img class="rounded img-fluid" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar3.jpg" alt="">
                                                    </div>
                                                    <div class="comment_body">
                                                        <h5>Dessie Parks <small class="float-right font-14">1min ago</small></h5>
                                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="timeline_item ">
                                    <img class="tl_avatar" src="<?php echo $this->config->item("base_url");?>assets/images/xs/avatar7.jpg" alt="">
                                    <span><a href="javascript:void(0);" title="">Rochelle Barton</a> San Francisco, CA <small class="float-right text-right">12-April-2019</small></span>
                                    <h6 class="font600">An Engineer Explains Why You Should Always Order the Larger Pizza</h6>
                                    <div class="msg">
                                        <p>I'm speaking with myself, number one, because I have a very good brain and I've said a lot of things. I write the best placeholder text, and I'm the biggest developer on the web by far... While that's mock-ups and this is politics, is the Lorem card.</p>
                                        <a href="javascript:void(0);" class="mr-20 text-muted"><i class="fa fa-heart text-pink"></i> 7 Love</a>
                                        <a class="text-muted" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2"><i class="fa fa-comments"></i> 1 Comment</a>
                                        <div class="collapse p-4 section-gray mt-2" id="collapseExample2">
                                            <form class="well">
                                                <div class="form-group">
                                                    <textarea rows="2" class="form-control no-resize" placeholder="Enter here for tweet..."></textarea>
                                                </div>
                                                <button class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-eye"></i> View Details </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-share-alt"></i> Share </a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-cloud-download"></i> Download</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-copy"></i> Copy to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-folder"></i> Move to</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-edit"></i> Rename</a>
                                            <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fa fa-trash"></i> Delete</a>
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
                                        <p  class="mb-0">07 Feb 2019</p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="text-muted">Due Date: </small>
                                        <p  class="mb-0">07 Feb 2019</p>
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

                </div>
            </div>
        </div>