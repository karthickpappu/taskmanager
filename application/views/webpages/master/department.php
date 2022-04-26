    <style>  
        .dropify-font-upload:before, .dropify-wrapper .dropify-message span.file-icon:before {
            content: '\f0ee' !important;
            display: initial;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
        }   
    </style>
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
                                <div class="d-flex align-items-center sort_stat">
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
                                </div>
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
                                        if($alldepartment){
                                        foreach($alldepartment as $output){
                                    ?>
                                        <tr class="eachCard">
                                            <td class="width35 hidden-xs">
                                                <a href="javascript:void(0);" class="mail-star"><i class="fa fa-star"></i></a>
                                            </td>
                                            <td>
                                                <div><a href="javascript:void(0);"><?php echo $output->department;?></a></div>
                                                <div class="text-muted">+<?php echo $output->department_prefix;?></div>
                                            </td>
                                            <td class="hidden-xs">
                                                <div class="text-muted"  style="display: inline-block;white-space: pre-line;width: 500px;"><?php echo $output->department_brief;?></div>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-sm btn-link hidden-xs" data-type="confirm" href="javascript:void(0)" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-link hidden-xs" onclick="deletedepartment(<?php echo $output->department_id;?>)" data-type="confirm" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></a>
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
                            if($alldepartment){
                            foreach($alldepartment as $output){
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 userdivcontentsub">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="card-status bg-blue"></div>
                                    <div class="mb-2">
                                        <h5 class="mb-0"><?php echo $output->department;?></h5>
                                        <p class="text-muted" style="text-align: justify;"><?php echo $output->department_brief;?></p>
                                    </div>
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
                                <div class="card-body">
                                    <?php echo form_open_multipart('data/department/create','id="createuser" name="createuser" autocomplete="on" ');?>
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control user_name" id="fname" placeholder="Enter Department Name" name="department" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control user_name" id="mname" placeholder="Enter Prefix Name (eg : AD ...)" name="department_prefix" >
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <textarea type="text" name="department_brief" class="form-control" rows="4">Enter Department Description</textarea>
                                                </div>
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
        // $(document).on('keyup','.user_name', function(e) { 
        //     var fname = $("#fname").val();
        //     var mname = $("#mname").val();
        //     var lname = $("#lname").val();
        //     $("#user_name").val(fname+' '+mname+' '+lname);
        // });

        $(document).on('click','#submit', function(e) { 
            e.preventDefault();		
            if($("#createuser")[0].reportValidity()) 
            {
                var datastring =  new FormData($('#createuser')[0]); 
                $.ajax({
                    type:'POST',
                    url:'<?php echo $this->config->item("base_url");?>data/department/create',
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


        function deletedepartment(id) { 
            $.ajax({
                type:'POST',
                url:'<?php echo $this->config->item("base_url");?>data/department/delete',
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