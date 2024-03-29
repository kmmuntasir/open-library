<script>

//window.open('http://localhost/library.ist.edu.bd','IST Library','toolbar=no, menubar=no, resizable=yes');

var sms_access_token 	= "";
var sms_gateway_url		= "";
var sms_sending_status	= "";

	$(document).ready(function(){


		var global_admin_id = $('#global_admin_id').val();
		var global_admin_type = $('#global_admin_type').val();


		sms_access_token = $('#sms_access_token').val();
		sms_gateway_url = $('#sms_gateway_url').val();
		sms_sending_status = $('#sms_sending_status').val();

		var site_url = "<?php echo site_url(); ?>/";
		// Datatables Functions
		var datatable_source = $('.datatable').attr('data-source');
		var datapage = $('.datatable').attr('data-page');
	    var buttons = ['colvis', 'csv','excel', 'print', 'refresh'];


	    
	    // Enabling Individual Column Search
	    $('.datatable tfoot td').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="Search '+title+'" class="form-control datatable-tfoot-input">' );
	    });
		
	    var dtable = $('.datatable').DataTable({
            "ajax": datatable_source,
            "deferRender": true,
            "pageLength": 10,
            "drawCallback": function() {
            	post_process_datatable(datapage);
            },
	        // buttons: buttons,
            // responsive: true,
            //"order": [[ 2, "asc" ]],
            //dom: 'lfrtip',
	        // dom: 'iplBfrt',
	        dom: 'lifptlifp',
            initComplete: function() {
                //post_process_datatable(datapage);
            }
        });

        
        // Apply the search
        dtable.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on('keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            });
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
			$('.library_code_curtain').html('');
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


	    $(document).on('click', '.delete', function() {
	    	if(!confirm("Are you sure to delete?")) {
	    		event.preventDefault();
	    		return false;
	    	}
	    });

	    // API Calls ==============================================================

	    // Function for Changing the online_offline indicator
	    function online_status() {
	    	//alert("Status Checker");
	        var status_url = "<?php echo site_url('user/sync/last_sync_time/1') ?>";
	        $.post( status_url, function( data ) { 
	            if(data) {
	            	if(data > <?php echo $this->sync_interval*3; ?>) $('#main_nav').addClass('navbar-inverse');
	            	else $('#main_nav').removeClass('navbar-inverse');
	            }
	        });
	    }
	    var stat_time = function() {online_status();};
	    var stat_check_interval = <?php echo $this->sync_interval*1500; ?>;
	    online_status();
	    setInterval(stat_time, stat_check_interval);
	    
	    //============= Page Depended Functions =================
	    <?php require_once('js_'.$page.'.php'); ?>

	});



	function isJSON(str) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}

	
	function formatDate(date=null, format='MMM d, yyyy') {
		// Requires jquery-dateFormat Plugin
		// yy = short year
		// yyyy = long year
		// M = month (1-12)
		// MM = month (01-12)
		// MMM = month abbreviation (Jan, Feb ... Dec)
		// MMMM = long month (January, February ... December)
		// d = day (1 - 31)
		// dd = day (01 - 31)
		// ddd = day of the week in words (Monday, Tuesday ... Sunday)
		// E = short day of the week in words (Mon, Tue ... Sun)
		// D - Ordinal day (1st, 2nd, 3rd, 21st, 22nd, 23rd, 31st, 4th...)
		// h = hour in am/pm (0-12)
		// hh = hour in am/pm (00-12)
		// H = hour in day (0-23)
		// HH = hour in day (00-23)
		// mm = minute
		// ss = second
		// SSS = milliseconds
		// a = AM/PM marker
		// p = a.m./p.m. marker

		if(date != null) var d = new Date(date);
		else var d = new Date();
		return $.format.date(d, format)
	}

	function send_sms(sms=null) {
		alert(sms_access_token);
		alert(sms_gateway_url);
		alert(sms_sending_status);
		
	}

	/*
    public function send_sms($to=NULL, $message=NULL) {
        if(!$this->settings->sms_sending_status) return 'SMS Sending Turned Off By Admin';
        
        // Returns 'success' if succeeded, returns API Reply if SMS is not sent.
        
        if(!$to || !$message) return 'Recipient and Message Text is Required';


        $sms = array();
        $sms['to']      = $to;
        $sms['message'] = $message;
        $sms['token']   = $this->settings->sms_access_token;

        // $this->printer($sms, true);

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$this->settings->sms_gateway_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($sms));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $api_reply = curl_exec($ch);

        $sms_stat = explode(':', $api_reply)[0];

        // $sms_stat = 'Ok';

        if($sms_stat == 'Ok') return 'success';
        else return $api_reply;
    }
    */
</script>