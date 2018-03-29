<script>
//window.open('http://localhost/library.ist.edu.bd','IST Library','toolbar=no, menubar=no, resizable=yes');
	$(document).ready(function(){
		var busy = false;
		function sync_trigger() {
			//alert("Sync Trigger");
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
		sync_trigger();
		setInterval(sync, interval);
		<?php } ?>


		// Function for Changing the online_offline indicator
		function online_status() {
			//alert("Status Checker");
		    var status_url = "<?php echo site_url('user/sync/last_sync_time/1') ?>";
		    $.post( status_url, function( data ) { 
		        if(data) {
		        	var indicator = '';
		        	if(data > <?php echo $this->sync_interval*1.4; ?>) $('#main_nav').addClass('navbar-inverse');
		        	else $('#main_nav').removeClass('navbar-inverse');
		            //$('#online_status').html(indicator);
		        }
		    });
		}
		var stat_time = function() {online_status();};
		var stat_check_interval = <?php echo $this->sync_interval*1500; ?>;
		online_status();
		setInterval(stat_time, stat_check_interval);

		var site_url = "<?php echo site_url(); ?>/";
		// Datatables Functions
		var datatable_source = $('.datatable').attr('data-source');
		var datapage = $('.datatable').attr('data-page');
		
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
        	else if(page == 'books') post_process_books_table();
        	else if(page == 'managers') post_process_managers_table();
        	else if(page == 'categories') post_process_categories_table();
        	else if(page == 'authors') post_process_authors_table();
        	else if(page == 'publications') post_process_publications_table();
        	else if(page == 'request') post_process_issue_requests_table();
        	else if(page == 'active') post_process_active_issues_table();
        	else if(page == 'overdue') post_process_overdue_issues_table();
        	else if(page == 'completed') post_process_completed_issues_table();
        	else if(page == 'all_issues') post_process_all_issues_table();
        	else if(page == 'issue_by_user') post_process_issue_by_user_table();
        	else if(page == 'issue_by_book') post_process_issue_by_book_table();
        	else if(page == 'issue_by_book_copy') post_process_issue_by_book_copy_table();
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