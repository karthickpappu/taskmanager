<style>
.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 100%;
}
</style>       
	   <div class="section-body">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#todo-list">ToDo List</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#todo-add">Add Todo</a></li>
                    </ul>
                </div>
            </div>
        </div>
		<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" id="token" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="tab-content">
				
                    <div class="tab-pane fade show active" id="todo-list" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive todo_list">
                                    <table class="table table-hover table-striped table-vcenter mb-0 text-nowrap">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="w150 text-right">Due</th>
                                                <th class="w100">Priority</th>
                                                <th class="w100">Created By</th>
                                                <!--<th class="w80"><i class="fa fa-user"></i></th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												if($alltodo){
												$a=1;
												foreach($alltodo as $todooutput){
												$b=$a++;
											?>
                                            <tr>
                                                <td>
                                                    <label class="custom-control custom-checkbox">
                                                        <input onclick="changetodostatus(<?php echo $todooutput->todo_id;?>)" type="checkbox" class="custom-control-input" name="example-checkbox1" value="option1" <?php if($todooutput->todo_status == '0'){ echo 'checked';}?>>
                                                        <span class="custom-control-label"><?php echo $todooutput->todo;?></span>
                                                    </label>
                                                </td>
                                                <td class="text-right"><?php echo $todooutput->date_to;?></td>
                                                <td><span class="tag tag-danger ml-0 mr-0"><?php echo $todooutput->priority;?></span></td>
                                                <td>
												<?php 
													$assignedby = '';
													foreach($allusers as $uoutput){
														if($uoutput->user_id == $todooutput->created_by){
															$assignedby = '<li><img src="assets/images/user.png" data-toggle="tooltip" data-placement="top" title="'.$uoutput->user_name.'" alt="Avatar"></li>';
														}
													}
												?>
                                                   <ul class="list-unstyled team-info mb-0">
                                                        <?php echo $assignedby;?>
                                                    </ul>
                                                </td>
                                            </tr>
											<?php } } ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="tab-pane fade" id="todo-add" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Todo</h3>
                                <div class="card-options ">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
								<?php echo form_open_multipart('data/todo/create','id="createtodo" name="createtodo" autocomplete="on" ');?>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Todo Name <span class="text-danger">*</span></label>
										<div class="col-md-7">
											<input type="text" name="todo" class="form-control">
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Priority <span class="text-danger">*</span></label>
										<div class="col-md-7">
											<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Priority" name="priority" required>
												<option value="Low">Low</option>
												<option value="Medium">Medium</option>
												<option value="High">High</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Select Team <span class="text-danger">*</span></label>
										<div class="col-md-7">
											<select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Team" name="assign_to" required>
												<?php 
													if($allusers){
													foreach($allusers as $output){
												?>
													<option data-tokens="<?php echo $output->user_name;?>" value="<?php echo $output->user_id;?>"><?php echo $output->user_name;?></option>
												<?php } } ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Description <span class="text-danger">*</span></label>
										<div class="col-md-7">
											<textarea rows="4" name="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label">Due <span class="text-danger">*</span></label>
										<div class="col-md-7">
											<div class="input-daterange input-group" data-provide="datepicker">
												<input type="text" class="form-control" name="date_from" autocomplete="off" required>
												<span class="input-group-addon"> to </span>
												<input type="text" class="form-control" name="date_to"autocomplete="off" required>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-3 col-form-label"></label>
										<div class="col-md-7">
											<button type="submit" id="submit" class="btn btn-primary">Submit</button>
											<button type="button" class="btn btn-outline-secondary">Cancel</button>
										</div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
					
                </div>
            </div>
        </div>
<script>
/* Multiple Item Picker */

$(document).on('click','#submit', function(e) { 
	e.preventDefault();		
	// for (instance in CKEDITOR.instances) {
        // CKEDITOR.instances[instance].updateElement();
    // }
	// if($("#createtodo")[0].checkValidity()) 
	// {
		var datastring =  new FormData($('#createtodo')[0]); 
		$.ajax({
			type:'POST',
			url:'<?php echo $this->config->item("base_url");?>data/todo/create',
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
	// }
});

function changetodostatus(id){
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
	csrfHash = $("#token").val();
	var dataJson = {[csrfName]: csrfHash, id: id};
	$.ajax({
		type:'POST',
		url:'<?php echo $this->config->item("base_url");?>data/todo/todostatus',
		enctype: 'multipart/form-data',
		data: dataJson, 
		dataType:"JSON",
		token: '<?php echo $this->security->get_csrf_hash();?>',
		success:function(data){
			console.log(data);
			$('#token').val(data.csrfHash);
			if(data.status == 1){				
				swal({title: 'Action Update!',text: data.msg,type: 'success'},function() {
					// window.location.reload();
				});
			}else{				
				swal({title: 'Action Update!',text: data.msg,type: 'error'},function() {
					// window.location.reload();
				});
			}
		},
		timeout: 10000,
		async: false			
	});
}

</script>