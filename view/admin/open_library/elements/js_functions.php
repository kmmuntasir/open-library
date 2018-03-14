<script>
//window.open('http://localhost/library.ist.edu.bd','IST Library','toolbar=no, menubar=no, resizable=yes');
	$(document).ready(function(){
		var busy = false;
		function sync_trigger() {
			if(busy) return;
			busy = true;
			var url = "<?php echo site_url('user/sync') ?>";
			$.post( url, function( data ) { 
				if(data != '') {
					//alert(data);
				}
			});
			busy = false;
		}
		
		var sync = function() {if(!busy) sync_trigger();};
		var interval = <?php echo $this->sync_interval*1000; ?>;
		<?php if($this->settings->application_role == 0) { ?>
		setInterval(sync, interval);
		<?php } ?>

		var site_url = "<?php echo site_url(); ?>/";
		// Datatables Functions
		var datatable_source = $('.datatable').attr('data-source');
		var datapage = $('.datatable').attr('data-page');
		var post_processing_flag = true;
		//alert(datatable_source);
	    var dtable = $('.datatable').DataTable({
            "ajax": datatable_source,
            "deferRender": true,
            "pageLength": 10,
            "drawCallback": function() {
            	post_process_datatable(datapage);
            },
            //"order": [[ 2, "asc" ]],
            //dom: 'lfrtip',
            initComplete: function() {
                //post_process_datatable(datapage);
            }
            //responsive: true
        });

        function post_process_datatable(page) {
        	if(page == 'students') post_process_students_table();
        	else if(page == 'teachers') post_process_teachers_table();
        }

	    $(document).on('click', '#add_button', function() {
	    	$('#myModal').removeClass('hide');
	    	$('#myModal').addClass('show');
	    });

	    $(document).on('click', 'button.close', function() {
	    	$('.modal').removeClass('show');
	    	$('.modal').addClass('hide');
	    });

	    $(document).on('click', '.edit', function() {
	    	$('#editModal').removeClass('hide');
	    	$('#editModal').addClass('show');
	    });

	    
	    $(document).on('click', 'i.fa-eye', function() {
	    	$('#viewModal').removeClass('hide');
	    	$('#viewModal').addClass('show');
	    });

	    $(document).on('click', '.addCopy', function() {
	    	$('#viewModal').removeClass('show');
	    	$('#viewModal').addClass('hide');
	    	$('#copyModal').removeClass('hide');
	    	$('#copyModal').addClass('show');
	    });

	    $('.flash_message').delay(5000).fadeOut(5000);
	    var flash = 1;
	    $('.flash_message').each(function() {
	    	var margin = (flash * 10 + (flash-1) * 50) + 'px';
	    	$(this).css('margin-top', margin);
	    	++flash;
	    });

	    function showFlash(msg, type) {
	    	$('.standby_flash').children('div').removeAttr('class');
	    	$('.standby_flash').children('div').addClass('alert alert-' + type);
	    	$('.standby_flash').children('div').html(msg);
	    	$('.standby_flash').fadeIn(0, function() {
	    		$('.standby_flash').delay(5000).fadeOut(5000);
	    	});
	    }


	    $(document).one('click', '.delete', function() {
	    	if(!confirm("Are you sure to delete?")) return false;
	    });
	    
	    //============= Page Depended Functions =================
	    <?php require_once('js_'.$page.'.php'); ?>
	});
</script>