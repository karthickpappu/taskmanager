	     <div class="section-body" style="">
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <a href="#">Task Hub</a>
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-right">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#">Documentation</a></li>
                                <li class="list-inline-item"><a href="javascript:void(0)">FAQ</a></li>
                                <!--<li class="list-inline-item"><a href="javascript:void(0)" class="btn btn-outline-primary btn-icon">Buy Now</a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div> 
	</div>
</div>

<script src="<?php echo $this->config->item('base_url');?>assets/bundles/lib.vendor.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/bundles/apexcharts.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/bundles/counterup.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/bundles/knobjs.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/bundles/c3.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/core.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/page/project-index.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/bundles/nestable.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/page/sortable-nestable.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/chart/knobjs.js"></script>

<script src="<?php echo $this->config->item('base_url');?>assets/bundles/fullcalendar.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/page/calendar.js"></script>

<script src="<?php echo $this->config->item('base_url');?>assets/bundles/summernote.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/page/summernote.js"></script>

<script src="<?php echo $this->config->item('base_url');?>assets/bundles/sweetalert.bundle.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/plugins/dropify/js/dropify.min.js"></script>
<script src="<?php echo $this->config->item('base_url');?>assets/js/page/sweetalert.js"></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js'></script>
<script>
$(function() {
    "use strict";
    
    $('.dropify').dropify();

    var drEvent = $('#dropify-event').dropify();
    drEvent.on('dropify.beforeClear', function(event, element) {
        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
    });

    drEvent.on('dropify.afterClear', function(event, element) {
        alert('File deleted');
    });

    $('.dropify-fr').dropify({
        messages: {
            default: 'Glissez-déposez un fichier ici ou cliquez',
            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
            remove: 'Supprimer',
            error: 'Désolé, le fichier trop volumineux'
        }
    });
});
$(function() {
  $('.selectpicker').selectpicker({
    style: 'btn-default'
  });
});
</script>
</body>

<!-- soccer/project/  07 Jan 2020 03:37:22 GMT -->
</html>
