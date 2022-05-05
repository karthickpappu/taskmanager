	<style>       
	.card-collapsed .card-options-collapse i:before {
		content: '\f078';
	}
	.card-fullscreen .card-options-fullscreen i:before {
		content: '\f066';
	}
	.bootstrap-select.show-tick .dropdown-menu .selected span.check-mark {
		position: absolute;
		display: inline-block;
		right: 20px;
		top: 6px;
	}
	.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
		width: 100%;
	}
	.input-daterange .input-group-addon {
		width: auto;
		min-width: 15px;
		padding: 7px 15px;
		line-height: 1.42857143;
		text-shadow: 0 1px 0 #fff;
		border-width: 1px 0;
		margin-left: -5px;
		margin-right: -5px;
	}

	.dropdown-menu .dropdown-item {
		color: #333537;
		font-size: 14px;
		padding: 5px;
		margin: 0 10px;
		width: auto;
	}
	.btn.btn-default, .dataTables_wrapper .dataTables_paginate .btn-default.paginate_button {
		color: #4D5052;
		background-color: #fff;
		border-color: #E8E9E9;
		//padding: 6px 14px;
		padding: .375rem .75rem;
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
							<li class="nav-item"><a class="nav-link active" id="TaskBoard-tab" data-toggle="tab" href="#TaskBoard-list">All Task View</a></li> 
							<li class="nav-item"><a class="nav-link" id="TaskBoard-tab" data-toggle="tab" href="#TaskBoard-mylist">My Task View</a></li>
							<!-- <li class="nav-item"><a class="nav-link" id="TaskBoard-grid-btn" data-toggle="tab" href="#TaskBoard-grid">Grid View</a></li> -->
							<?php if($taskboardcreate){ ?>
								<li class="nav-item"><a class="nav-link" id="TaskBoard-tab" data-toggle="tab" href="#TaskBoard-add">Add Task</a></li>
							<?php } ?>
						</ul>
						<div class="header-action d-flex">
							<div class="input-group mr-2">
								<input type="text" class="form-control" placeholder="Search...">
							</div>
						</div>
					</div>
				</div>
			</div>
							
		</div>
	</div>
		
	<div class="section-body">
		<div class="container-fluid">
			<div class="tab-content taskboard">
			
				<div class="tab-pane fade show active" id="TaskBoard-list" role="tabpanel">
					<div class="row clearfix mt-2">
						<?php 					
							$planned = array_filter($alltask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'Planned';
							});
							$progress = array_filter($alltask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'In Progress';
							});
							$completed = array_filter($alltask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'Completed';
							});
						?>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>Planned</h6>
									<input type="text" class="knob" value="<?php echo count($planned);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>In Progress</h6>
									<input type="text" class="knob" value="<?php echo count($progress);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>Completed</h6>
									<input type="text" class="knob" value="<?php echo count($completed);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>In Completed</h6>
									<input type="text" class="knob" value="0" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-vcenter mb-0 table_custom spacing8 text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>Task</th>
											<th>Team</th>
											<th>Followers</th>
											<th>Duration</th>
											<th>Priority</th>
											<th>Status</th>
											<th class="w200"></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											if($alltask){
											$a=1;
											foreach($alltask as $taskoutput){
											$b=$a++;
										?>
										<tr>
											<td><?php echo $b;?></td>
											<td>
												<h6 class="mb-0"><?php echo $taskoutput->title;?></h6>
												<span><?php echo $taskoutput->description;?></span>
											</td>
											<td>
											<?php 
												$tags = explode(',',$taskoutput->assign_to);
												$followerstag = explode(',',$taskoutput->followers);
												$taskteam = '';
												foreach($tags as $key) { 
													foreach($allusers as $uoutput){
														if($uoutput->user_id == $key){
															$taskteam .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
														}
													}
												}
												$followers = '';
												foreach($followerstag as $fkey) { 
													foreach($allusers as $uoutput){
														if($uoutput->user_id == $fkey){
															$followers .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
														}
													}
												}
											?>
												<ul class="list-unstyled team-info mb-0">
													<?php echo $taskteam;?>
												</ul>
											</td>
											<td>
												<ul class="list-unstyled team-info mb-0">
													<?php echo $followers;?>
												</ul>
											</td>
											<td>
												<div class="text-info">Start: <?php echo $taskoutput->date_from;?></div>
												<div class="text-pink">End: <?php echo $taskoutput->date_to;?></div>
											</td>
											<td>
												<span class="tag tag-red"><?php echo $taskoutput->priority;?></span>
											</td>
											<td>
												<span class="tag tag-blue">Planned</span>
											</td>
											<td>
												<div class="clearfix">
													<div class="float-left"><strong>0%</strong></div>
													<div class="float-right"><small class="text-muted">Progress</small></div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar bg-azure" role="progressbar" style="width: 0%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</td>
											<?php if($taskboardread){ ?>
											<td>
												<a href="<?php echo $this->config->item("base_url");?>taskboard/details/<?php echo $taskoutput->task_id;?>/<?php echo md5($mytaskoutput->task_id);?>" class="tag tag-blue">View</a>
											</td>
											<?php } ?>
										</tr>
										<?php } } else {?>  
											<tr><td colspan="9" class="text-center"><span class="tag tag-blue">No Task</span></td></tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
								
				<div class="tab-pane fade" id="TaskBoard-mylist" role="tabpanel">
					<div class="row clearfix mt-2">
						<?php 					
							$planned = array_filter($mytask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'Planned';
							});
							$progress = array_filter($mytask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'In Progress';
							});
							$completed = array_filter($mytask, function($product) {
								// condition which makes a result belong to div2.
								return ($product->task_status) == 'Completed';
							});
						?>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>Planned</h6>
									<input type="text" class="knob" value="<?php echo count($planned);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>In Progress</h6>
									<input type="text" class="knob" value="<?php echo count($progress);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>Completed</h6>
									<input type="text" class="knob" value="<?php echo count($completed);?>" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="card">
								<div class="card-body text-center">
									<h6>In Completed</h6>
									<input type="text" class="knob" value="0" data-width="90" data-height="90" data-thickness="0.1" data-fgColor="#6e7687">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-hover table-vcenter mb-0 table_custom spacing8 text-nowrap">
									<thead>
										<tr>
											<th>#</th>
											<th>Task</th>
											<th>Team</th>
											<th>Followers</th>
											<th>Duration</th>
											<th>Priority</th>
											<th>Status</th>
											<th class="w200"></th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											if($mytask){
											$a=1;
											foreach($mytask as $mytaskoutput){
											$b=$a++;
										?>
										<tr>
											<td><?php echo $b;?></td>
											<td>
												<h6 class="mb-0"><?php echo $mytaskoutput->title;?></h6>
												<span><?php echo $mytaskoutput->description;?></span>
											</td>
											<td>
											<?php 
												$tags = explode(',',$mytaskoutput->assign_to);
												$followerstag = explode(',',$mytaskoutput->followers);
												$taskteam = '';
												foreach($tags as $key) { 
													foreach($allusers as $uoutput){
														if($uoutput->user_id == $key){
															$taskteam .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
														}
													}
												}
												$followers = '';
												foreach($followerstag as $fkey) { 
													foreach($allusers as $uoutput){
														if($uoutput->user_id == $fkey){
															$followers .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
														}
													}
												}
											?>
												<ul class="list-unstyled team-info mb-0">
													<?php echo $taskteam;?>
												</ul>
											</td>
											<td>
												<ul class="list-unstyled team-info mb-0">
													<?php echo $followers;?>
												</ul>
											</td>
											<td>
												<div class="text-info">Start: <?php echo $mytaskoutput->date_from;?></div>
												<div class="text-pink">End: <?php echo $mytaskoutput->date_to;?></div>
											</td>
											<td>
												<span class="tag tag-red"><?php echo $mytaskoutput->priority;?></span>
											</td>
											<td>
												<span class="tag tag-blue">Planned</span>
											</td>
											<td>
												<div class="clearfix">
													<div class="float-left"><strong>0%</strong></div>
													<div class="float-right"><small class="text-muted">Progress</small></div>
												</div>
												<div class="progress progress-xs">
													<div class="progress-bar bg-azure" role="progressbar" style="width: 0%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</td>
											<td>
												<a href="<?php echo $this->config->item("base_url");?>taskboard/details/<?php echo $mytaskoutput->task_id;?>/<?php echo md5($mytaskoutput->task_id);?>" class="tag tag-blue">View</a>
											</td>
										</tr>
										<?php } } else {?>  
										<tr><td colspan="9" class="text-center"><span class="tag tag-blue">No Task</span></td></tr>
										<?php } ?>                                          
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="TaskBoard-grid" role="tabpanel">
					<div class="row clearfix">
						<div class="col-lg-4 col-md-12">
							<div class="card planned_task">
								<div class="card-header">
									<h3 class="card-title">Planned</h3>
									<div class="card-options">
										<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
										<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-expand"></i></a>
										<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
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
									<div class="dd" data-plugin="nestable">
										<ol class="dd-list">
										<?php 
											if($alltask){
											$a=1;
											foreach($alltask as $taskoutput){
											$b=$a++;
											if($taskoutput->task_status == 'Planned'){
										?>
											<li class="dd-item" data-id="<?php echo $b;?>">
												<div class="dd-handle">
													<h6><?php echo $taskoutput->title;?></h6>
													<span class="time"><span class="text-primary">Start: <?php echo $taskoutput->date_from;?></span> to <span class="text-danger">Due Till: <?php echo $taskoutput->date_to;?></span></span>
													<p><?php echo $taskoutput->description;?></p>
													<?php 
														$tags = explode(',',$taskoutput->assign_to);
														$followerstag = explode(',',$taskoutput->followers);
														$taskteam = '';
														foreach($tags as $key) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $key){
																	$taskteam .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
														
														$followers = '';
														foreach($followerstag as $fkey) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $fkey){
																	$followers .= '<li><img src="'.$this->config->item("base_url").'assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
													?>
													<ul class="list-unstyled team-info">
														<?php echo $taskteam;?>
													</ul> 
													<ul class="list-unstyled team-info">
														<?php echo $followers;?>
													</ul>                                             
												</div>
											</li>
										<?php } } } ?>
										<li class="dd-item" data-id="0">
											<div class="dd-handle text-center">
												<h6>All Planned Task</h6>
												<p></p>
											</div>
										</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-4 col-md-12">
							<div class="card progress_task">
								<div class="card-header">
									<h3 class="card-title">In progress</h3>
									<div class="card-options">
										<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
										<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-expand"></i></a>
										<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
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
									<div class="dd" data-plugin="nestable">
										<ol class="dd-list">
										<?php 
											if($alltask){
											$a=1;
											foreach($alltask as $taskoutput){
											$b=$a++;
											if($taskoutput->task_status == 'In progress'){
										?>
											<li class="dd-item" data-id="<?php echo $b;?>">
												<div class="dd-handle">
													<h6><?php echo $taskoutput->title;?></h6>
													<span class="time"><span class="text-primary">Start: <?php echo $taskoutput->date_from;?></span> to <span class="text-danger">Due Till: <?php echo $taskoutput->date_to;?></span></span>
													<p><?php echo $taskoutput->description;?></p>
													<?php 
														$tags = explode(',',$taskoutput->assign_to);
														$followerstag = explode(',',$taskoutput->followers);
														$taskteam = '';
														$array_filter ='';
														foreach($tags as $key) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $key){
																	$taskteam .= '<li><img src="assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
														
														$followers = '';
														foreach($followerstag as $fkey) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $fkey){
																	$followers .= '<li><img src="assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
													?>
													<ul class="list-unstyled team-info">
														<?php echo $taskteam;?>
													</ul> 
													<ul class="list-unstyled team-info">
														<?php echo $followers;?>
													</ul>                                             
												</div>
											</li>
										<?php } } }  ?>
										<li class="dd-item" data-id="0">
											<div class="dd-handle text-center">
												<h6>All In Progress Task</h6>
												<p></p>
											</div>
										</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12">
							<div class="card completed_task">
								<div class="card-header">
									<h3 class="card-title">Completed</h3>
									<div class="card-options">
											<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
										<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-expand"></i></a>
										<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
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
									<div class="dd" data-plugin="nestable">
										<ol class="dd-list">                                   
											<?php 
											if($alltask){
											$a=1;
											foreach($alltask as $taskoutput){
											$b=$a++;
											if($taskoutput->task_status == 'Completed'){
										?>
											<li class="dd-item" data-id="<?php echo $b;?>">
												<div class="dd-handle">
													<h6><?php echo $taskoutput->title;?></h6>
													<span class="time"><span class="text-primary">Start: <?php echo $taskoutput->date_from;?></span> to <span class="text-danger">Due Till: <?php echo $taskoutput->date_to;?></span></span>
													<p><?php echo $taskoutput->description;?></p>
													<?php 
														$tags = explode(',',$taskoutput->assign_to);
														$followerstag = explode(',',$taskoutput->followers);
														$taskteam = '';
														$array_filter ='';
														foreach($tags as $key) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $key){
																	$taskteam .= '<li><img src="assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
														
														$followers = '';
														foreach($followerstag as $fkey) { 
															foreach($allusers as $uoutput){
																if($uoutput->user_id == $fkey){
																	$followers .= '<li><img src="assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
																}
															}
														}
													?>
													<ul class="list-unstyled team-info">
														<?php echo $taskteam;?>
													</ul> 
													<ul class="list-unstyled team-info">
														<?php echo $followers;?>
													</ul>                                             
												</div>
											</li>
										<?php } } } ?>
										<li class="dd-item" data-id="0">
											<div class="dd-handle text-center">
												<h6>All Completed Task</h6>
												<p></p>
											</div>
										</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-pane fade" id="TaskBoard-add" role="tabpanel">
					<div class="row clearfix">
						<div class="col-lg-12 col-md-12">
							<div class="card planned_task">
								<div class="card-header">
									<h3 class="card-title">Create Task</h3>
									<div class="card-options">
										<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
										<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-expand"></i></a>
										<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
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
									<?php echo form_open_multipart('data/task/create','id="createtask" name="createtask" autocomplete="on" ');?>
										<div class="modal-body">
											<div class="row clearfix">
												<div class="col-lg-4">
													<div class="form-group">
														<select class="selectpicker show-menu-arrow" onchange="selectprojectmodule(this.value)" data-style="form-control" data-live-search="true" title="Select Project" id="project_id" name="project_id" required>
														<?php 
															if($allproject){
															$a=1;
															foreach($allproject as $projectoutput){
															$b=$a++;
														?>
															<option data-tokens="<?php echo $projectoutput->project_id;?>" value="<?php echo $projectoutput->project_id;?>"><?php echo $projectoutput->title;?></option>
														<?php } } ?>
															<option data-tokens="Others" value="Others">Others</option>
														</select>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Project Module" name="project_module_id" id="project_module_id"  required>
														<?php 
															if($allprojectmodule){
															$a=1;
															foreach($allprojectmodule as $projectmoduleoutput){
															$b=$a++;
														?>
															<option style="display:none;" class="projectmoduleoption projectmodule_<?php echo $projectmoduleoutput->project_id;?>" data-tokens="<?php echo $projectmoduleoutput->module_id;?>" value="<?php echo $projectmoduleoutput->module_id;?>"><?php echo $projectmoduleoutput->module;?></option>
														<?php } } ?>
															<option class="projectmodule_Others" data-tokens="Others" value="Others">Others</option>
														</select>
													</div>
												</div>
												<div class="col-lg-8">
													<div class="form-group">                                   
														<input type="text" class="form-control" placeholder="Title" name="title" required>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="form-group">
														<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Priority" name="priority" required>
															<option data-tokens="Low" value="Low">Low</option>
															<option data-tokens="Medium" value="Medium">Medium</option>
															<option data-tokens="High"value="High">High</option>
														</select>
													</div>
												</div>     
												<div class="col-lg-12">
													<div class="form-group">
														<textarea class="form-control" placeholder="Description" name="description" required></textarea>
													</div>
												</div>
												<div class="col-lg-6">
													<div class="form-group">
														<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Team" multiple="multiple"name="assign_to[]" required>
														<?php 
															if($allusers){
															foreach($allusers as $output){
														?>
															<option data-tokens="<?php echo $output->user_name;?>" value="<?php echo $output->user_id;?>"><?php echo $output->user_name;?></option>
														<?php } } ?>
														</select>
													</div>
												</div>					
												<div class="col-lg-6">
													<div class="form-group">
														<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Followers" multiple="multiple" name="followers[]" required>
														<?php 
															if($allusers){
															foreach($allusers as $output){
														?>
															<option data-tokens="<?php echo $output->user_name;?>" value="<?php echo $output->user_id;?>"><?php echo $output->user_name;?></option>
														<?php } } ?>
														</select>
													</div>
												</div>  
											</div> 
											<div class="row">
												<div class="col-lg-4">
													<label>Task Start/Due Date</label>
													<div class="input-daterange input-group" data-provide="datepicker">
														<input type="text" class="form-control datepicker" id="fdatepicker" name="date_from" autocomplete="off" value="<?php echo date('d-m-Y');?>" required>
														<span class="input-group-addon"> to </span>
														<input type="text" class="form-control" id="ddatepicker"  name="date_to" autocomplete="off" value="<?php echo date('d-m-Y');?>"required>
													</div>
												</div>                
											</div>
											<div class="row mt-15">
												<div class="col-lg-4">
													<input type="file" class="dropify" name="task_attachment">
												</div>                 
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" id="submit" class="btn btn-primary">Add</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

<script>
/* Multiple Item Picker */
function selectprojectmodule(value){
	$(".projectmoduleoption").hide();
	$(".projectmodule_"+value).show();
    $('.selectpicker').selectpicker('refresh');
}

$(document).ready(function(){
	$("#fdatepicker").datepicker({
		"format": "d-m-yyyy",
	});
	$("#ddatepicker").datepicker({
		"format": "d-m-yyyy",
	});
});

$(document).on('click','#submit', function(e) { 
	e.preventDefault();		
	// for (instance in CKEDITOR.instances) {
        // CKEDITOR.instances[instance].updateElement();
    // }
	if($("#createtask")[0].reportValidity()) 
	{
		var datastring =  new FormData($('#createtask')[0]); 
		$.ajax({
			type:'POST',
			url:'<?php echo $this->config->item("base_url");?>data/task/create',
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

function deletetask(){
	swal({
		title: "Are you sure to delete this  of ?",
		text: "Delete Confirmation?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Delete",
		closeOnConfirm: false
	  },
	  function() {
		$.ajax({
			type: "post",
			url: "url",
			data: "data",
			success: function(data) {}
		  })
		  .done(function(data) {
			swal("Deleted!", "Data successfully Deleted!", "success");
		  })
		  .error(function(data) {
			swal("Oops", "We couldn't connect to the server!", "error");
		  });
	  }
	);
}


</script>