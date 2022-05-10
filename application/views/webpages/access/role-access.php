<style>
    .card-fullscreen .card-options-fullscreen i:before {
        content: '\f2d1';
    }
    .card-collapsed .card-options-collapse i:before {
        content: '\f078';
    }
    .card-collapsed .card-options-remove i:before {
        content: '\f00d';
    }
    .custom-control {
        user-select: none;
        cursor: pointer;
    }
    .table td, .table th {
        padding: 0.2rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }
    .custom-checkbox .custom-control-label:before {
        border: 1px solid rgb(143 188 143);
        background-color: #ffffff;
        background-size: 0.5rem;
        top: 0.1rem;
    }
    .table-responsive>.table-bordered {
        border: 1px solid #e8e9e9;
    }
    
    .custom-control {
        padding-left: 2rem;
    }
</style>
    <div class="section-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <ul class="nav nav-tabs page-header-tab">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#roles" id="rolesbutton">All Roles and Permissions</a></li>
                            <!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Project-UpComing">UpComing</a></li>-->
                            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Project-add" id="addprojectbutton">Add Project</a></li> -->
                        </ul>
                        <div class="header-action d-md-flex">
                            <div class="input-group mr-2">
                                <input type="text" class="form-control" placeholder="Search...">
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade <?php if($_GET['roleid'] =='' ){ echo 'show active';}?>" id="roles" role="tabpanel">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Roles</h3>
                                    <div class="card-options">
                                        <button type="button" class="ml-15 btn btn-primary" data-toggle="modal" data-target="#addrole"><i class="fa fa-plus mr-2"></i>Add Role</button>
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                                <div class="card-body" style="padding:0px">
                                    <table  id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead style="background: cornsilk;">
                                            <tr>
                                                <th width="20%">Name</th>
                                                <th width="10%">Prefix</th>
                                                <th width="50%">Desc</th>
                                                <th width="10%">Action</th>
                                                <th width="10%">Access</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 	
                                            foreach($allroles as $routput){
                                        ?>
                                            <tr>
                                                <td><?php echo $routput->role;?></td>
                                                <td><?php echo $routput->role_prefix;?></td>
                                                <td><?php echo $routput->role_brief;?></td>
                                                <td>	
                                                    <label class="custom-switch m-0">
                                                        <input type="checkbox" onclick="deleterole(<?php echo $routput->role_id; ?>)" value="1" class="custom-switch-input" checked>
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>	
                                                    <a href="#addaccess" onclick="addroleid(<?php echo $routput->role_id;?>,'<?php echo $routput->role;?>')" class=" btn btn-primary btn-sm" data-toggle="tab" data-target="#addaccess"><i class="fa fa-plus mr-2"></i> Add </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade <?php if($_GET['roleid'] !='' ){ echo 'show active';}?>" id="addaccess" role="tabpanel">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Roles &amp; Permissions [<?php echo $_GET['role'];?>]</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                                    </div>
                                </div>
                                <?php echo form_open_multipart('data/role/addpermission','id="addpermission" name="addpermission" autocomplete="on" ');?>
                                <input type="hidden" name="role_id" id="role_id" value="<?php echo $_GET['roleid'];?>">
                                    <div class="card-body">
                                        <!-- <ul class="list-group mb-3 tp-setting">
                                            <li class="list-group-item">
                                                Anyone seeing my profile page
                                                <div class="float-right">
                                                    <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                Anyone send me a message
                                                <div class="float-right">
                                                    <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                Anyone posts a comment on my post
                                                <div class="float-right">
                                                    <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                Anyone invite me to group
                                                <div class="float-right">
                                                    <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked="">
                                                    <span class="custom-control-label">&nbsp;</span>
                                                    </label>
                                                </div>
                                            </li>
                                        </ul> -->
                                        <div class="table-responsive">
                                            <table  id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" >Module Permission</th>
                                                        <th>Read</th>
                                                        <th>Write</th>
                                                        <th>Create</th>
                                                        <th>Delete</th>
                                                        <th>Import</th>
                                                        <th>Export</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr style="background: darkseagreen;"> 
                                                        <td colspan="2" >Select All</td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_read" id="module_read" type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_write" id="module_write"  type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_create" id="module_create" type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_delete" id="module_delete" type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_import" id="module_import" type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <label class="custom-control custom-checkbox">
                                                            <input onclick="selectall(this.value)" value="module_export" id="module_export" type="checkbox" class="custom-control-input">
                                                            <span class="custom-control-label">&nbsp;</span>
                                                            </label>
                                                        </td>
                                                    </tr>
                                                    <?php 	
                                                        $a=1;
                                                        foreach($allmodule as $moutput){
                                                            $b = $a++
                                                    ?>
                                                        <tr> 
                                                            <input type="hidden" name="module[<?php echo $b;?>]" id="module" value="<?php echo $moutput->module;?>">
                                                            <input type="hidden" name="module_id[<?php echo $b;?>]" id="module_id" value="<?php echo $moutput->module_id;?>">
                                                            <?php if( $moutput->main_module_id == '0' ){ ?>
                                                                <td colspan="2" ><?php echo $moutput->module;?></td>
                                                            <?php } else { ?>
                                                                <td></td>
                                                                <td><?php echo $moutput->module;?></td>
                                                            <?php } ?>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'read')){ echo 'checked'; } ?> name="module_read[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_read" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'write')){ echo 'checked'; } ?> name="module_write[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_write" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'create')){ echo 'checked'; } ?> name="module_create[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_create" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'delete')){ echo 'checked'; } ?> name="module_delete[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_delete" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'import')){ echo 'checked'; } ?> name="module_import[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_import" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <label class="custom-control custom-checkbox">
                                                                <input <?php if($this->rolemodel->getpermissionbyrole($moutput->module,$_GET['roleid'],'export')){ echo 'checked'; } ?> name="module_export[<?php echo $b;?>]" type="checkbox" class="custom-control-input module_export" value="1">
                                                                <span class="custom-control-label">&nbsp;</span>
                                                                </label>
                                                            </td>                                                            
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="card-body text-right">
                                        <a href="#roles" class="ml-15 btn btn-primary closebutton" data-toggle="tab" data-target="#roles">Close</a>
                                        <button type="submit" id="submitaccess" class="ml-15 btn btn-primary" data-toggle="tab" data-target="#addaccess">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Add Role Module -->
    <div class="modal fade" id="addrole" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="title" id="defaultModalLabel">Add New Role</h6>
                </div>
                <?php echo form_open_multipart('data/role/create','id="createrole" name="createrole" autocomplete="on" ');?>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="form-group">                                   
                                    <input type="hidden" id="project_id" name="project_id" >
                                    <input type="text" class="form-control" placeholder="Role" name="role" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">                                   
                                    <input type="hidden" id="project_id" name="project_id" >
                                    <input type="text" class="form-control" placeholder="Prefix" name="role_prefix" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Description" name="role_brief" required></textarea>
                                </div>
                            </div>                   
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="submitrole" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
            
        function addroleid(value,role){
            $("#role_id").val(value);
            var nextURL = '<?php echo $this->config->item('base_url');?>access/role-access';
            history.pushState({}, null, nextURL+'?roleid='+value+'&role='+role);
            window.location.reload();
        }
        
        function selectall(value){
            let isChecked = $('#'+value).is(':checked');
            console.log(isChecked);
            if( isChecked ){
                $('.'+value).attr("checked",true);
            }else{
                $('.'+value).attr("checked",false);
            }
        }

        $('.closebutton').click(function() {
            var nextURL = '<?php echo $this->config->item('base_url');?>access/role-access';
            history.pushState({}, null, nextURL);
            $(this).removeClass('active');
            $('#ongioingbutton').addClass('active');
            $('#addprojectbutton').removeClass('active');
            $('.btn').removeClass('active');
        });

        $(document).on('click','#submitrole', function(e) { 
            e.preventDefault();		
            if($("#createrole")[0].reportValidity()) 
            {
                var datastring =  new FormData($('#createrole')[0]); 
                $.ajax({
                    type:'POST',
                    url:'<?php echo $this->config->item("base_url");?>data/role/create',
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

        function deleterole(id) { 
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/role/delete',
                enctype: 'multipart/form-data',
                data: {id:id},    
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
        
        $(document).on('click','#submitaccess', function(e) { 
            e.preventDefault();		
            if($("#addpermission")[0].reportValidity()) 
            {
                var datastring =  new FormData($('#addpermission')[0]); 
                $.ajax({
                    type:'POST',
                    url:'<?php echo $this->config->item("base_url");?>data/role/addpermission',
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