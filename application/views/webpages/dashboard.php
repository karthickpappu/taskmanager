
	<div class="section-body mt-3">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-lg-12">
					<div class="mb-4">
						<h4>Welcome <?php echo $user_data['user_name'];?>!</h4>
						<small>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">Learn More</a></small>
					</div>                        
				</div>
			</div>
			<div class="row clearfix row-deck">
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Active Users</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($allusers);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Total Tasks</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($alltask);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Upcoming Events</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($allusers);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">New Message</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($allusers);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div>
				<!-- <div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Open Requests</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($allusers);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Hours Spent</h3>
						</div>
						<div class="card-body">
							<h5 class="number mb-0 font-32 counter"><?php echo count($allusers);?></h5>
							<span class="font-12">Measure How Fast... <a href="<?php echo $this->config->item('base_url');?>user">More</a></span>
						</div>
					</div>
				</div> -->
			</div>
			
			<!--<div class="row clearfix row-deck">
				<div class="col-xl-12 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Sales Analytics</h3>
							<div class="card-options">
								<button class="btn btn-sm btn-outline-secondary mr-1" id="one_month">1M</button>
								<button class="btn btn-sm btn-outline-secondary mr-1" id="six_months">6M</button>
								<button class="btn btn-sm btn-outline-secondary mr-1" id="one_year" class="active">1Y</button>
								<button class="btn btn-sm btn-outline-secondary mr-1" id="ytd">YTD</button>
								<button class="btn btn-sm btn-outline-secondary" id="all">ALL</button>
							</div>
						</div>
						<div class="card-body">
							<div id="apex-timeline-chart"></div>
						</div>
					</div>                
				</div>
				<div class="col-xl-8 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Current Ticket Status</h3>
							<div class="card-options">
								<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
							</div>
						</div>
						<div class="card-body">
							<div class="d-sm-flex justify-content-between">
								<div class="font-12">as of 10th to 17th of Jun 2019</div>
								<div class="selectgroup w250">
									<label class="selectgroup-item">
										<input type="radio" name="intensity" value="Day" class="selectgroup-input" checked="">
										<span class="selectgroup-button">1D</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="intensity" value="Week" class="selectgroup-input">
										<span class="selectgroup-button">1W</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="intensity" value="Month" class="selectgroup-input">
										<span class="selectgroup-button">1M</span>
									</label>
									<label class="selectgroup-item">
										<input type="radio" name="intensity" value="Year" class="selectgroup-input">
										<span class="selectgroup-button">1Y</span>
									</label>
								</div>
							</div>
							<div id="chart-combination" style="height: 205px"></div>
						</div>
						<div class="card-footer">
							<div class="row">
								<div class="col-6 col-xl-3 col-md-6">
									<h5>05</h5>
									<div class="clearfix">
										<div class="float-left"><strong>35%</strong></div>
										<div class="float-right"><small class="text-muted">Yesterday</small></div>
									</div>
									<div class="progress progress-xs">
										<div class="progress-bar bg-gray" role="progressbar" style="width: 35%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="text-uppercase font-10">New Tickets</span>
								</div>
								<div class="col-6 col-xl-3 col-md-6">
									<h5>18</h5>
									<div class="clearfix">
										<div class="float-left"><strong>61%</strong></div>
										<div class="float-right"><small class="text-muted">Yesterday</small></div>
									</div>
									<div class="progress progress-xs">
										<div class="progress-bar bg-gray" role="progressbar" style="width: 61%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="text-uppercase font-10">Open Tickets</span>
								</div> 
								<div class="col-6 col-xl-3 col-md-6">
									<h5>06</h5>
									<div class="clearfix">
										<div class="float-left"><strong>100%</strong></div>
										<div class="float-right"><small class="text-muted">Yesterday</small></div>
									</div>
									<div class="progress progress-xs">
										<div class="progress-bar bg-gray" role="progressbar" style="width: 100%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="text-uppercase font-10">Solved Tickets</span>
								</div>
								<div class="col-6 col-xl-3 col-md-6">
									<h5>11</h5>
									<div class="clearfix">
										<div class="float-left"><strong>87%</strong></div>
										<div class="float-right"><small class="text-muted">Yesterday</small></div>
									</div>
									<div class="progress progress-xs">
										<div class="progress-bar bg-gray" role="progressbar" style="width: 87%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="text-uppercase font-10">Unresolved</span>
								</div>                                                                       
							</div>
						</div>
					</div>                
				</div>
				<div class="col-xl-4 col-lg-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Project Statistics</h3>
							<div class="card-options">
								<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
								<a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
							</div>
						</div>
						<div class="card-body">
							<div class="row text-center">
								<div class="col-4 border-right pb-4 pt-4">
									<label class="mb-0 font-13">Total Project</label>
									<h4 class="font-30 font-weight-bold text-col-blue counter">42</h4>
								</div>
								<div class="col-4 border-right pb-4 pt-4">
									<label class="mb-0 font-13">On Going</label>
									<h4 class="font-30 font-weight-bold text-col-blue counter">23</h4>
								</div>
								<div class="col-4 pb-4 pt-4">
									<label class="mb-0 font-13">Pending</label>
									<h4 class="font-30 font-weight-bold text-col-blue counter">8</h4>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-vcenter mb-0">
								<tbody>
									<tr>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>35%</strong></div>
												<div class="float-right"><small class="text-muted">Design Team</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-azure" role="progressbar" style="width: 35%" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>25%</strong></div>
												<div class="float-right"><small class="text-muted">Developer Team</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-green" role="progressbar" style="width: 25%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>15%</strong></div>
												<div class="float-right"><small class="text-muted">Marketing</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-orange" role="progressbar" style="width: 15%" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>20%</strong></div>
												<div class="float-right"><small class="text-muted">Management</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-indigo" role="progressbar" style="width: 20%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="clearfix">
												<div class="float-left"><strong>11%</strong></div>
												<div class="float-right"><small class="text-muted">Other</small></div>
											</div>
											<div class="progress progress-xs">
												<div class="progress-bar bg-pink" role="progressbar" style="width: 11%" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>-->
			
		</div>
	</div>
	
	<div class="section-body">
		<div class="container-fluid">
			<!--<div class="row clearfix row-deck">
				<div class="col-xl-4 col-lg-12 col-md-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Transaction History</h3>
							<div class="card-options">
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
								<div class="item-action dropdown ml-2">
									<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-174px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
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
						<table class="table card-table mt-2">
							<tbody>
								<tr>
									<td class="w60"><img class="avatar" src="assets/images/xs/avatar1.jpg" alt="Avatar"></td>
									<td>
										<p class="mb-0 d-flex justify-content-between"><span>Payment from #2583</span> <strong>$300</strong></p>
										<span class="text-muted font-13">Feb 21, 2019</span>
									</td>
								</tr>
								<tr>
									<td class="w60"><img class="avatar" src="assets/images/xs/avatar2.jpg" alt="Avatar"></td>
									<td>
										<p class="mb-0 d-flex justify-content-between"><span>Payment from #1245</span> <strong>$1200</strong></p>
										<span class="text-muted font-13">March 14, 2019</span>
									</td>
								</tr>
								<tr>
									<td class="w60"><img class="avatar" src="assets/images/xs/avatar3.jpg" alt="Avatar"></td>
									<td>
										<p class="mb-0 d-flex justify-content-between"><span>Payment from #8596</span> <strong>$780</strong></p>
										<span class="text-muted font-13">March 18, 2019</span>
									</td>
								</tr>
								<tr>
									<td class="w60"><img class="avatar" src="assets/images/xs/avatar4.jpg" alt="Avatar"></td>
									<td>
										<p class="mb-0 d-flex justify-content-between"><span>Payment from #1526</span> <strong>$841</strong></p>
										<span class="text-muted font-13">April 27, 2019</span>
									</td>
								</tr>
								<tr>
									<td class="w60"><img class="avatar" src="assets/images/xs/avatar5.jpg" alt="Avatar"></td>
									<td>
										<p class="mb-0 d-flex justify-content-between"><span>Payment from #4859</span> <strong>$235</strong></p>
										<span class="text-muted font-13">March 18, 2019</span>
									</td>
								</tr>
							</tbody>
						</table>                        
					</div>
				</div>
				<div class="col-xl-4 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Customer Satisfaction</h3>
							<div class="card-options">
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
								<div class="item-action dropdown ml-2">
									<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-174px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
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
							<div class="d-flex align-items-baseline">
								<h1 class="mb-0 mr-2">9.8</h1>
								<p class="mb-0"><span class="text-success">1.6% <i class="fa fa-arrow-up"></i></span></p>
							</div>
							<h6 class="text-uppercase font-10">Performance Score</h6>
							<div class="progress progress-xs">
								<div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
								<div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
								<div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
								<div class="progress-bar bg-orange" role="progressbar" style="width: 5%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
								<div class="progress-bar bg-indigo" role="progressbar" style="width: 13%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-vcenter mb-0">
								<tbody>
									<tr>
										<td class="tx-medium"><i class="fa fa-circle text-blue"></i> Excellent</td>
										<td class="text-right">3,007</td>
										<td class="text-right">50%</td>
									</tr>
									<tr>
										<td class="tx-medium"><i class="fa fa-circle text-success"></i> Very Good</td>
										<td class="text-right">1,674</td>
										<td class="text-right">25%</td>
									</tr>
									<tr>
										<td class="tx-medium"><i class="fa fa-circle text-info"></i> Good</td>
										<td class="text-right">125</td>
										<td class="text-right">6%</td>
									</tr>
									<tr>
										<td class="tx-medium"><i class="fa fa-circle text-orange"></i> Fair</td>
										<td class="text-right">98</td>
										<td class="text-right">5%</td>
									</tr>
									<tr>
										<td class="tx-medium"><i class="fa fa-circle text-indigo"></i> Poor</td>
										<td class="text-right">512</td>
										<td class="text-right">10%</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-lg-6 col-md-6">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Overall Rating</h3>
							<div class="card-options">
								<a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
								<div class="item-action dropdown ml-2">
									<a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
									<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-174px, 25px, 0px); top: 0px; left: 0px; will-change: transform;">
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
							<div class="d-flex align-items-baseline">
								<h2 class="font-28 mr-2">4.2</h2>
								<div class="font-14">
									<i class="fa fa-star text-orange"></i>
									<i class="fa fa-star text-orange"></i>
									<i class="fa fa-star text-orange"></i>
									<i class="fa fa-star text-orange"></i>
									<i class="fa fa-star"></i>
								</div>                                    
							</div>
							<p class="mb-0 font-12">Overall the quality or your support team’s efforts Rating.</p>                                
						</div>
						<div class="table-responsive">
							<table class="table table-striped table-vcenter mb-0">
								<tbody>
									<tr>
										<td><strong>5.0</strong></td>
										<td>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</td>
										<td class="text-right">432</td>
										<td class="text-right">58%</td>
									</tr>
									<tr>
										<td><strong>4.0</strong></td>
										<td>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</td>
										<td class="text-right">189</td>
										<td class="text-right">42%</td>
									</tr>
									<tr>
										<td><strong>3.0</strong></td>
										<td>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
										</td>
										<td class="text-right">125</td>
										<td class="text-right">23%</td>
									</tr>
									<tr>
										<td><strong>2.0</strong></td>
										<td>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
										</td>
										<td class="text-right">89</td>
										<td class="text-right">18%</td>
									</tr>
									<tr>
										<td><strong>1.0</strong></td>
										<td>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
											<i class="fa fa-star-o"></i>
										</td>
										<td class="text-right">18</td>
										<td class="text-right">11%</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>    -->
			<div class="row clearfix">
				<div class="col-12 col-sm-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title">Project Summary</h3>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-hover table-striped text-nowrap table-vcenter mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Client</th>
											<th>Team</th>
											<th>Project</th>
											<th>Project Type</th>
											<th>Project Cost</th>
											<th>Payment</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>#IS001</td>
											<td>Self</td>
											<td>
												<ul class="list-unstyled team-info sm margin-0 w150">
													<li><img src="assets/images/user.png" alt="Avatar"></li>
													<li><img src="assets/images/user.png" alt="Avatar"></li>
													<li><img src="assets/images/user.png" alt="Avatar"></li>
													<li><img src="assets/images/user.png" alt="Avatar"></li>
													<li class="ml-2"><span>2+</span></li>
												</ul>
											</td>
											<td>I-STEM Web Portal</td>
											<td>Internal</td>
											<td>NA</td>
											<td>NA</td>
											<td><span class="tag tag-success">On Going</span></td>
										</tr>										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>      

