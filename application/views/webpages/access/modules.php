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
</style>

<div class="section-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center">
                    <ul class="nav nav-tabs page-header-tab">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Project-OnGoing" id="ongioingbutton">Task Manager Modules</a></li>
                        <!--<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Project-UpComing">UpComing</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Project-add" id="addprojectbutton">Add Project</a></li> -->
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
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modules</h3>
                        <div class="card-options">
                            <button type="button" class="ml-15 btn btn-primary" data-toggle="modal" data-target="#addmodule"><i class="fa fa-plus mr-2"></i>Add Module</button>
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fa fa-chevron-up"></i></a>
                            <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fa fa-window-maximize"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="card-body" style="padding:0px">
                        <table  id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2" width="30%">Name</th>
                                    <th width="60%">Desc</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 	
                                foreach($allmodule as $moutput){
                            ?>
                                <tr>
                                    <?php if( $moutput->main_module_id == '0' ){ ?>
                                        <td colspan="2" ><?php echo $moutput->module;?></td>
                                        <td><?php echo $moutput->module_description;?></td>
                                        <td>	
                                            <label class="custom-switch m-0">
                                                <input type="checkbox" onclick="deletemodule(<?php echo $moutput->module_id; ?>)" value="1" class="custom-switch-input" checked>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td><?php echo $moutput->module;?></td>
                                        <td><?php echo $moutput->module_description;?></td>
                                        <td>	
                                            <label class="custom-switch m-0">
                                                <input type="checkbox" onclick="deletemodule(<?php echo $moutput->module_id; ?>)" value="1" class="custom-switch-input" checked>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </td>
                                     <?php } ?>
                                </tr>
                             <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add New Module -->
<div class="modal fade" id="addmodule" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Add New Module</h6>
            </div>
            <?php echo form_open_multipart('data/module/create','id="createmodule" name="createmodule" autocomplete="on" ');?>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div class="col-12">
                            <div class="form-group">                                   
                                <input type="hidden" id="project_id" name="project_id" >
                                <input type="text" class="form-control" placeholder="Title" name="module" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Description" name="module_description" required></textarea>
                            </div>
                        </div>                   
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitmodule" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).on('click','#submitmodule', function(e) { 
        e.preventDefault();		
        if($("#createmodule")[0].reportValidity()) 
        {
            var datastring =  new FormData($('#createmodule')[0]); 
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/module/create',
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

    function deletemodule(id) { 
        $.ajax({
            type:'POST',
            url:'<?php echo $this->config->item("base_url");?>data/module/delete',
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
</script>