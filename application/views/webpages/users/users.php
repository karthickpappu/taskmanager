    <style>       
        .card-collapsed .card-options-collapse i:before {
            content: '\f078';
        } 
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
        .input-client .show-tick{
            width: 75% !important;
        }

        .pagination>.pageactive>a, .pagination>.pageactive>a:focus, .pagination>.pageactive>a:hover, .pagination>.pageactive>span, .pagination>.pageactive>span:focus, .pagination>.pageactive>span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            /* background-color: #0bafcc; */
            border-color: #0bafcc;
        }

        .pagination>li>a, .pagination>li>span {
            position: relative;
            float: none;
            padding: 0px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: rgb(10 177 206 / 0%);
            border: 0px solid #ddd;
        }

        .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
            background-color: #eee0;
        }

        /* .pagination{
            text-align: center;
            margin: 30px 30px 60px;
            user-select: none;
        } */

        .pagination {
            text-align: center;
            margin: 10px 10px 10px 0px;
            user-select: none;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .pagination li{
            display: inline-block;
            margin: 5px;
            box-shadow: 0 5px 25px rgb(1 1 1 / 10%);
        }

        .pagination li a{
            color: #fff !important;
            text-decoration: none;
            font-size: 1.2em;
            line-height: 40px;
        }

        .previous-page, .next-page{
            background: #0AB1CE;
            width: 80px;
            border-radius: 45px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .previous-page:hover{
            transform: translateX(-5px);
        }

        .next-page:hover{
            transform: translateX(5px);
        }

        .current-page, .dots{
            background: #ccc;
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }

        .pageactive{
            background: #0AB1CE;
        }
        .disable {
            background: #ccc;
        }

        #allCardsContainer {
            max-width: 100%;
            width: 100%;
            flex-wrap: wrap;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
            display: block !important;
        }
        .input-daterange input {
            text-align: left;
        }
    </style>
	<div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex justify-content-between">
                                <ul class="nav nav-tabs b-none">
                                    <li class="nav-item"><a class="nav-link active" id="list-tab" data-toggle="tab" href="#list"><i class="fa fa-list-ul"></i> List</a></li>
                                    <li class="nav-item"><a class="nav-link" id="grid-tab" data-toggle="tab" href="#grid"><i class="fa fa-th"></i> Grid</a></li>
                                    <li class="nav-item"><a class="nav-link" id="addnew-tab" data-toggle="tab" href="#addnew"><i class="fa fa-plus"></i> Add New</a></li>
                                </ul>
                                <!-- <div class="d-flex align-items-center sort_stat">
                                    <div class="d-flex">
                                        <span class="bh_income">2,5,1,8,3,6,7,5,3,6,7,5</span>
                                        <div class="ml-2">
                                            <p class="mb-0 font-11">MY INCOME</p>
                                            <h5 class="font-16 mb-0">$5,510</h5>
                                        </div>
                                    </div>
                                    <div class="d-flex ml-3">
                                        <span class="bh_traffic">5,8,9,10,5,2,5,8,9,10</span> 
                                        <div class="ml-2">
                                            <p class="mb-0 font-11">SITE TRAFFIC</p>
                                            <h5 class="font-16 mb-0">53% Up</h5>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="input-group mt-2">
                                <input type="text" class="form-control search" placeholder="Search..." id="filter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="container-fluid">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="list" role="tabpanel">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="table-responsive " id="users">
                                <table class="table table-hover table-vcenter text-nowrap table_custom border-style list ">
                                    <tbody class="card-content">
                                    <?php 
                                        if($allusers){
                                        foreach($allusers as $output){
                                    ?>
                                        <tr class="eachCard">
                                            <td class="width35 hidden-xs">
                                                <a href="javascript:void(0);" class="mail-star"><i class="fa fa-star"></i></a>
                                            </td>
                                            <td class="text-center width40">
                                                <div class="avatar d-block">
                                                    <img class="avatar" src="<?php echo $this->config->item('base_url');?>assets/images/user.png" alt="avatar">
                                                </div>
                                            </td>
                                            <td>
                                                <div><a href="javascript:void(0);"><?php echo $output->user_name;?></a></div>
                                                <div class="text-muted">+<?php echo $output->phone;?></div>
                                            </td>
                                            <td class="hidden-xs">
                                                <div class="text-muted"><?php echo $output->email;?></div>
                                            </td>
                                            <td class="hidden-sm">
                                                <div class="text-muted">455 S. Airport St. Moncks Corner, SC 29461</div>                                                
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Phone"><i class="fa fa-phone"></i></a>
                                                <a class="btn btn-sm btn-link" href="javascript:void(0)" data-toggle="tooltip" title="Mail"><i class="fa fa-envelope"></i></a>
                                                <a class="btn btn-sm btn-link" href="<?php echo $this->config->item('base_url');?>user/view" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-sm btn-link" href="<?php echo $this->config->item('base_url');?>user/edit" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    <?php } } ?>                                           
                                    </tbody>
                                </table>                                
                                <div class="pagination"> </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane fade" id="grid" role="tabpanel">
                    <div class="row row-deck userdivcontent" id="usersdiv">
                        <?php 
                            if($allusers){
                            foreach($allusers as $output){
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 userdivcontentsub">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-status bg-blue"></div>
                                    <div class="mb-3"> <img src="<?php echo $this->config->item('base_url');?>assets/images/user.png" class="rounded-circle w100" alt=""> </div>
                                    <div class="mb-2">
                                        <h5 class="mb-0"><?php echo $output->user_name;?></h5>
                                        <p class="text-muted"><?php echo $output->email;?></p>
                                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam deleniti fugit incidunt</span>
                                    </div>
                                    <span class="font-12 text-muted">Common Contact</span>
                                    <ul class="list-unstyled team-info margin-0 pt-2">
                                        <li><img src="assets/images/xs/avatar1.jpg" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar8.jpg" alt="Avatar"></li>
                                        <li><img src="assets/images/xs/avatar2.jpg" alt="Avatar"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>        
                    </div>
                </div>
                <div class="tab-pane fade" id="addnew" role="tabpanel">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
									<h3 class="card-title">Create User</h3>
									<!-- <div class="card-options">
										<a type="button" class="btn btn-primary btn-sm addclient" data-toggle="tab" href="#Client-add" ><i class="fa fa-plus mr-2"></i>Add Client</a>
									</div> -->
								</div>
                                <div class="card-body">
                                    <?php echo form_open_multipart('data/users/create','id="createuser" name="createuser" autocomplete="on" ');?>
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control user_name" id="fname" placeholder="Enter First Name" name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>Middle Name</label>
                                                    <input type="text" class="form-control user_name" id="mname" placeholder="Enter Middle Name" name="middle_name" >
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control user_name" id="lname" placeholder="Enter Last Name" name="last_name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>User Name</label>
                                                    <input type="text" class="form-control" placeholder="User Name" id="user_name" name="user_name" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="number" class="form-control" placeholder="Enter Number" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" required>
                                                </div>
                                            </div>	
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Role" name="role_id" required>
                                                    <?php 
                                                        if($allroles){
                                                        foreach($allroles as $output){
                                                    ?>
                                                        <option data-tokens="<?php echo $output->role;?>" value="<?php echo $output->role_id;?>"><?php echo $output->role;?></option>
                                                    <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Department</label>
                                                    <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Department"  name="department_id" required >
                                                    <?php 
                                                        if($alldepartment){
                                                        foreach($alldepartment as $output){
                                                    ?>
                                                        <option data-tokens="<?php echo $output->department;?>" value="<?php echo $output->department_id;?>"><?php echo $output->department;?></option>
                                                    <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Designation</label>
                                                    <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Designation" name="designation_id" required>
                                                    <?php 
                                                        if($alldesignation){
                                                        foreach($alldesignation as $output){
                                                    ?>
                                                        <option data-tokens="<?php echo $output->designation;?>" value="<?php echo $output->designation_id;?>"><?php echo $output->designation;?></option>
                                                    <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label>Reporting To</label>
                                                    <select class="selectpicker show-menu-arrow" data-style="form-control" data-live-search="true" title="Select Reporting To" multiple="multiple" name="reporting_to[]" required>
                                                    <?php 
                                                        if($allusers){
                                                        foreach($allusers as $output){
                                                    ?>
                                                        <option data-tokens="<?php echo $output->user_name;?>" value="<?php echo $output->user_id;?>"><?php echo $output->user_name;?></option>
                                                    <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>	
                                            <div class="col-lg-4 col-md-4">
												<div class="form-group">
                                                    <label>Emp Type</label>
													<select class="selectpicker show-menu-arrow" onchange="showdate()" data-style="form-control" data-live-search="true" title="Select Type" id="emp_type" name="emp_type" required>
														<option data-tokens="Internal" value="Internal">Permanent</option>
														<option data-tokens="Contract" value="Contract">Contract</option>
														<option data-tokens="Intern" value="Intern">Intern</option>
														<option data-tokens="Other"value="Other">Other</option>
													</select>
												</div>
											</div>			
											<div class="col-lg-4 col-md-4" style="display:none;" id="datediv">
                                                <label>Contract Dates</label>
												<div class="input-daterange input-group" data-provide="datepicker">
                                                    <input type="text" class="form-control datepicker" name="emp_start_date" autocomplete="off" required value="<?php echo date('d-m-Y');?>">
                                                    <span class="input-group-addon"> to </span>
                                                    <input type="text" class="form-control datepicker" name="emp_end_date" autocomplete="off" required value="<?php echo date('d-m-Y');?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <label>Joining Date</label>
												<div class="input-daterange input-group" data-provide="datepicker">
                                                    <input type="text" class="form-control datepicker" name="joining_date" autocomplete="off" required value="<?php echo date('d-m-Y');?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>User Description</label>
                                                    <textarea type="text" name="description" class="form-control" rows="4">Enter User Description</textarea>
                                                </div>
                                            </div>   
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <textarea type="text" name="address" class="form-control" rows="4" >Enter your Address</textarea>
                                                </div>
                                            </div> 
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <input type="text" class="form-control" placeholder="Enter State" name="state" >
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text" class="form-control" placeholder="Enter City" name="city" >
                                                </div>
                                            </div> 
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <label>Pincode</label>
                                                    <input type="text" class="form-control" placeholder="Enter Pincode" name="pincode" >
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>User Picture</label>
                                                <input type="file" class="dropify" name="user_pic">
                                            </div>  
                                            <div class="col-lg-4">
                                                <label>User Document</label>
                                                <input type="file" class="dropify" name="user_document">
                                            </div>
                                            <div class="col-lg-12 mt-3 text-right">
                                                <button type="button" class="btn btn-default">Cancel</button>
                                                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                            </div>
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
    <script src='https://rendro.github.io/easy-pie-chart/javascripts/jquery.easy-pie-chart.js'></script>
    <script src='https://npmcdn.com/isotope-layout@3/dist/isotope.pkgd.js'></script>
    <script src='https://use.fontawesome.com/e8927eb029.js'></script>
    <script>
        $(document).ready(function(){
            $(".datepicker").datepicker({
                "format": "d-m-yyyy",
            });
        });

        function showdate(){
            if($("#emp_type").val() == 'Contract'){
                $("#datediv").show();
            }else{
                $("#datediv").hide();
            }
        }

        $(document).on('keyup','.user_name', function(e) { 
            var fname = $("#fname").val();
            var mname = $("#mname").val();
            var lname = $("#lname").val();
            $("#user_name").val(fname+' '+mname+' '+lname);
        });

        $(document).on('click','#submit', function(e) { 
            e.preventDefault();		
            if($("#createuser")[0].reportValidity()) 
            {
                var datastring =  new FormData($('#createuser')[0]); 
                $.ajax({
                    type:'POST',
                    url:'<?php echo $this->config->item("base_url");?>data/user/create',
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


        $("#filter").keyup(function() 
        {
            // Retrieve the input field text and reset the count to zero
            var filter = $(this).val(),
            count = 0;

            // Loop through the comment list
            $('#users tr').each(function() {

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).hide();  // MY CHANGE

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show(); // MY CHANGE
                    count++;
                }

            });
            $('#usersdiv div').each(function() {

                // If the list item does not contain the text phrase fade it out
                if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                    $(this).hide();  // MY CHANGE

                    // Show the list item if the phrase matches and increase the count by 1
                } else {
                    $(this).show(); // MY CHANGE
                    count++;
                }

            });

        });

        $(function() {
            cardpagination(5);
        });

        function getPageList(totalPages, page, maxLength){
            function range(start, end){
                return Array.from(Array(end - start + 1), (_, i) => i + start);
            }
            var sideWidth = maxLength < 9 ? 1 : 2;
            var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
            var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;
            if(totalPages <= maxLength){
                return range(1, totalPages);
            }
            if(page <= maxLength - sideWidth - 1 - rightWidth){
                return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
            }
            if(page >= totalPages - sideWidth - 1 - rightWidth){
                return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
            }
            return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
        }

        // $(function(){
        function cardpagination(cardlenght){
            var numberOfItems = $(".card-content .eachCard").length;
            // var numberOfItems = cardlenght;
            var limitPerPage = 10; //How many card items visible per a page
            var totalPages = Math.ceil(numberOfItems / limitPerPage);
            var paginationSize = 7; //How many page elements visible in the pagination
            var currentPage;

            function showPage(whichPage){
                if(whichPage < 1 || whichPage > totalPages) return false;
                currentPage = whichPage;
                $(".card-content .eachCard").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();
                $(".pagination li").slice(1, -1).remove();
                getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                    $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
                    .toggleClass("pageactive", item === currentPage).append($("<a>").addClass("page-link")
                    .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
                });
                $(".previous-page").toggleClass("disable", currentPage === 1);
                $(".next-page").toggleClass("disable", currentPage === totalPages);
                return true;
            }

            $(".pagination").append(
                $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
                $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
            );

            $(".card-content").show();
            showPage(1);

            $(document).on("click", ".pagination li.current-page:not(.pageactive)", function(){
                return showPage(+$(this).text());
            });

            $(".next-page").on("click", function(){
                return showPage(currentPage + 1);
            });

            $(".previous-page").on("click", function(){
                return showPage(currentPage - 1);
            });
        }
    </script>