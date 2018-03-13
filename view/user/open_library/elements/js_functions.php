<script>
	$(document).ready(function(){
		var site_url = "<?php echo site_url(); ?>/";
		// Datatables Functions
	    $('.datatable').DataTable();

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

	    <?php if($page == 'books') { ?> //============= Book Page JS Functions
	    // Functions for Book View Form
		$(document).on('click', '.issue_book', function() { 
			if(!confirm("Are you sure to request this book?")) return false;
		});
	    $(document).on('click', '.view_book', function() { 
	    	var book_id = $(this).attr('book_id');
	    	url = site_url + 'user/book/single_book/' + book_id;
	    	$.post(url, function(data) {
	    		var book = $.parseJSON(data);
	    		$('.view_code').html(book.book_id);
	    		$('.view_title').html(book.book_title);
	    		$('.view_isbn').html(book.book_isbn);
	    		$('.view_publication').html(book.publication_name);
	    		$('.view_edition').html(book.book_edition);
	    		$('.view_place_of_publication').html(book.book_place_of_pub);
	    		$('.view_year_of_publication').html(book.book_year_of_pub);
	    		$('.view_total_pages').html(book.book_pages);
	    		var status = ['Inactive', 'Active'];
	    		$('.view_status').html(status[book.book_status]);
	    		$('.view_stock').html(book.book_stock);
	    		$('.view_available').html(book.book_available);
	    		$('.view_remarks').html(book.book_remarks);
	    		var authors = '';
	    		var i=0;
	    		while(i<book.authors.length) {
	    			authors += book.authors[i++].author_name + '<br />';
	    		}
	    		$('.view_author').html(authors);

	    		var categories = '';
	    		var i=0;
	    		while(i<book.categories.length) {
	    			categories += book.categories[i++].category_name + '<br />';
	    		}
	    		$('.view_category').html(categories);


	    		var copy_status = ['Issued', 'Available'];
	    		var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
			    var source = ['', 'Purchase', 'Donation', 'Others'];
	    		var book_copies = '';
	    		var i=0;
	    		while(i<book.book_copies.length) {
	    			var style = '';
	    			if(book.book_copies[i].book_copy_status == 0) style = 'style="color:#f00;"';
	    			book_copies += '<tr '+style+ '><td><a title="View Details" class="accession_anchor" href="#">'+book.book_copies[i].book_copy_accession_no + '</a></td>';
	    			book_copies += '<td>'+type[book.book_copies[i].book_copy_type] + '</td>';
	    			book_copies += '<td>'+copy_status[book.book_copies[i].book_copy_status] + '</td>';
	    			i++;
	    		}
	    		$('.book_copy_details_box').children('tbody').html(book_copies);
	    	});
	    });
		// Functions for Update Book URL form
		$(document).on('click', '.update_book_url', function() {
			var url = site_url + 'user/book/update_book_url/' + $(this).attr('book_id');
			$('#book_url_input').val($(this).attr('book_url'));
			$('#update_book_url_Modal_form').attr('action', url);
			$('#update_book_url_Modal').removeClass('hide').addClass('show');
		});
	    // Functions for Book Copy View Form
        $(document).on('click', '.accession_anchor', function() { 
        	var book_copy_accession_no = $(this).html();
        	if(book_copy_accession_no != '') {
        		url = site_url + 'user/issue/issue_by_book_copy/' + book_copy_accession_no;
        		$('#view_copy_footer').children('a.history').attr('href', url);
        		url = site_url + 'user/book/copy_details/' + book_copy_accession_no;
    	    	$.post(url, function(data) {
    	    		if(data) {
    			    	$('#viewModal').removeClass('show');
    			    	$('#viewModal').addClass('hide');
    			    	$('#viewCopyModal').removeClass('hide');
    			    	$('#viewCopyModal').addClass('show');
    		    		var copy_status = ['Issued', 'Available'];
    		    		var status = ['Inactive', 'Active'];
	    				var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
    		    		var source = ['', 'Purchase', 'Donation', 'Others'];
    		    		var book = $.parseJSON(data);
			    		var deleted = '';
			    		if(book.book_copy_is_deleted == 1) deleted = '<button class="btn btn-sm btn-danger" type="button">Deleted</button>';
			    		$('.view_title').html(book.book_title + ' ' + deleted);
    		    		$('.view_isbn').html(book.book_isbn);
    		    		$('.view_publication').html(book.publication_name);
    		    		$('.view_edition').html(book.book_edition);
    		    		$('.view_place_of_publication').html(book.book_place_of_pub);
    		    		$('.view_year_of_publication').html(book.book_year_of_pub);
    		    		$('.view_total_pages').html(book.book_pages);
    		    		$('.view_status').html(status[book.book_status]);
    		    		$('.view_stock').html(book.book_stock);
    		    		$('.view_available').html(book.book_available);
    		    		$('.view_remarks').html(book.book_remarks);
    		    		var authors = '<ul>';
    		    		var i=0;
    		    		while(i<book.authors.length) {
    		    			authors += '<li>'+book.authors[i++].author_name + '</li>';
    		    		}
    		    		authors += '</ul>';
    		    		$('.view_author').html(authors);

    		    		var categories = '<ul>';
    		    		var i=0;
    		    		while(i<book.categories.length) {
    		    			categories += '<li>'+book.categories[i++].category_name + '</li>';
    		    		}
    		    		categories += '</ul>';
    		    		$('.view_category').html(categories);

    		    		$('.view_accession_no').html(book.book_copy_accession_no);
    		    		$('.view_copy_type').html(type[book.book_copy_type]);
    		    		$('.view_copy_status').html(copy_status[book.book_copy_status]);
    		    		$('.view_copy_manager').html(book.manager_name);
    		    		$('.view_copy_date').html(book.book_copy_date);
    		    		$('.view_copy_price').html('BDT ' + book.book_copy_price);
    		    		$('.view_copy_source').html(source[book.book_copy_source]);
    		    		$('.view_add_date').html(book.book_add_date);
    		    		$('.view_copy_remarks').html(book.book_copy_remarks);
    	    		}
    	    	});
        	}
        });

	    <?php } ?>

	    <?php if($page == 'book_copy') { ?> //============= Book_copy Page JS Functions
	    
	    // Functions for Book Copy View Form
	    $( "#get_copy_details" ).submit(function( event ) {
	    	var book_copy_accession_no = $('#book_copy_accession_no').val();
	    	if(book_copy_accession_no != '') {
        		url = site_url + 'user/issue/issue_by_book_copy/' + book_copy_accession_no;
        		$('#view_copy_footer').children('a.history').attr('href', url);
        		url = site_url + 'user/book/copy_details/' + book_copy_accession_no;
		    	$.post(url, function(data) {
		    		if(data) {
				    	$('#viewModal').removeClass('hide');
				    	$('#viewModal').addClass('show');
			    		var copy_status = ['Issued', 'Available'];
			    		var status = ['Inactive', 'Active'];
	    				var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
			    		var source = ['', 'Purchase', 'Donation', 'Others'];
			    		var book = $.parseJSON(data);
			    		var deleted = '';
			    		if(book.book_copy_is_deleted == 1) deleted = '<button class="btn btn-sm btn-danger" type="button">Deleted</button>';
			    		$('.view_title').html(book.book_title + ' ' + deleted);
			    		$('.view_isbn').html(book.book_isbn);
			    		$('.view_publication').html(book.publication_name);
			    		$('.view_edition').html(book.book_edition);
			    		$('.view_place_of_publication').html(book.book_place_of_pub);
			    		$('.view_year_of_publication').html(book.book_year_of_pub);
			    		$('.view_total_pages').html(book.book_pages);
			    		$('.view_status').html(status[book.book_status]);
			    		$('.view_stock').html(book.book_stock);
			    		$('.view_available').html(book.book_available);
			    		$('.view_remarks').html(book.book_remarks);
			    		var authors = '<ul>';
			    		var i=0;
			    		while(i<book.authors.length) {
			    			authors += '<li>'+book.authors[i++].author_name + '</li>';
			    		}
			    		authors += '</ul>';
			    		$('.view_author').html(authors);

			    		var categories = '<ul>';
			    		var i=0;
			    		while(i<book.categories.length) {
			    			categories += '<li>'+book.categories[i++].category_name + '</li>';
			    		}
			    		categories += '</ul>';
			    		$('.view_category').html(categories);

			    		$('.view_accession_no').html(book.book_copy_accession_no);
			    		$('.view_copy_type').html(type[book.book_copy_type]);
			    		$('.view_copy_status').html(copy_status[book.book_copy_status]);
			    		$('.view_copy_manager').html(book.manager_name);
			    		$('.view_copy_date').html(book.book_copy_date);
			    		$('.view_copy_price').html('BDT ' + book.book_copy_price);
			    		$('.view_copy_source').html(source[book.book_copy_source]);
			    		$('.view_add_date').html(book.book_add_date);
			    		$('.view_copy_remarks').html(book.book_copy_remarks);
		    		}
		    		else showFlash('Invalid Accession Number', 'danger');
		    	});
	    	}
	    	event.preventDefault();
	    });

	    <?php } ?>

	    <?php if($page == 'issue') { ?> //============= Issue Requests Page JS Functions
	   	// Function for Expanding the menu
	   	$(document).ready(function() {
	   		//$('#issue_nav_button').click();
			   $('.issue_datetime_th').click();
			   $('.issue_datetime_th').click();
	   	});
	    // Functions for Issue Add Form
	    $(document).on('blur', '.book_code_field', function() {
	    	var book = $(this).val().split('-')[0];
	    	$(this).val(book);
	    });

	    $(document).on('click', 'button#book_plus', function() {
	    	var n = $('.add_form_inputs').children('input[name="num_of_books"]').val();
	    	n++;

	    	$('.add_form_inputs').children('.book_box').append('<input list="booklist" required type="text" class="col-sm-8 col-sm-offset-4 book_code_field" name="book_'+n+'" placeholder="Book '+n+' Code"/>');
	    	$('.add_form_inputs').children('input[name="num_of_books"]').val(n);
	    });

	    $(document).on('click', 'button#book_minus', function() {
	    	var n = $('.add_form_inputs').children('input[name="num_of_books"]').val();
	    	if(n==1) return;
	    	var name = 'book_' + n;
	    	$('.add_form_inputs').children('.book_box').children('input[name="'+name+'"]').remove();
	    	n--;
	    	$('.add_form_inputs').children('input[name="num_of_books"]').val(n);
	    });

	    $('#add_issue_form').submit(function(event) {
	    	$('.book_code_field').each(function() {
		    	var book = $(this).val().split('-')[0];
		    	$(this).val(book);
	    	});

	    	if(!confirm("Are you sure to issue?")) {
	    		event.preventDefault;
	    		return false;
	    	}
	    	// $('.add_form_inputs').children('input[name="user_library_code_primary"]').val();
	    	// $('.add_form_inputs').children('input[name="user_library_code"]').val($('.add_form_inputs').children('input[name="user_library_code_primary"]').val());
	    	// $('.add_form_inputs').children('input[name="user_library_code_primary"]').val('');
	    });

	    var issue = '';
	    var user_details = '';
	    var book_details = '';

	    // Functions for Issue View Modal
	    $(document).on('click', '.view_issue', function() {
	    	var issue_id = $(this).attr('issue_id');
	    	var url = site_url + 'user/issue/single_issue_details/' + issue_id;
	    	$.post(url, function(data) {
	    		if(data) {
	    			issue = $.parseJSON(data);
	    			$('#issue_id').html('Issue #' + issue.issue_id);
	    			$('#issue_datetime').html(issue.issue_datetime);
	    			$('#issue_auto_expire_datetime').html(issue.issue_auto_expire_datetime);
	    			$('#issue_return_datetime').html(issue.issue_return_datetime);
	    			$('#issue_deadline').html(issue.issue_deadline);
	    			$('#issue_overdue').html(issue.issue_overdue);


	    			if(issue.is_teacher == 0) {
	    				user_details = '<b>User ID: '+issue.user_id+'<br />'+issue.user_name + '</b><br />' + issue.user_dept + '-' + issue.user_roll + ' (Session: ' + issue.user_session + '-' + ((parseInt(issue.user_session) + 1)%2000) + ')<br />' + issue.user_phone + '<br />' + issue.user_email;
	    			}
	    			else {
	    				user_details = '<b>User ID: '+issue.user_id+'<br />'+issue.user_name + '</b><br /><button type="button" class="btn btn-danger btn-sm">' + issue.teacher_designation + '</button><br />' + 'Department: ' +issue.user_dept + '<br />ID: ' + issue.teacher_id + '<br />' + issue.user_phone + '<br />' + issue.user_email;
	    			}
	    			
	    			$('#user_details').html(user_details);
	    			book_details = '<b>(#'+issue.book_id+') ' + issue.book_title + '</b><br />Accession No: ' + issue.issue_book_copy_accession_no;
	    			$('#book_details').html(book_details);
	    			var options = '';
	    			var issue_status = '';
	    			var i_status = parseInt(issue.issue_status);
	    			if(i_status == -1) {
	    				issue_status = '<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Overdue</button>';
	    			}
	    			else if(i_status == 9) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Requested</button>';
	    			}
	    			else if(i_status == -3) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Expired</button>';
	    			}
	    			else if(i_status == 1) {
	    				issue_status = '<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Active</button>';
	    			}
	    			else if(i_status == 2) {
	    				issue_status = '<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-calendar-times-o"></i> Received Without Fine</button>';
	    			}
	    			else if(i_status == 3) {
	    				issue_status = '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Completed</button>';
	    			}
	    			else if(i_status == 0) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i> Confirmed but not Issued</button>';
	    			}
	    			if(i_status == 0 || i_status == 9)
	    				options = '<a href="'+ site_url +'user/issue/delete/'+ issue_id +'" class="delete btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i> Delete</a><div class="clearfix"></div>';
	    			$('#issue_status').html(issue_status);
	    			$('#issue_fine').html(issue.issue_fine);
	    			$('#issue_remarks').html(issue.issue_remarks);
	    			$('#issue_view_modal_footer').html(options);
	    			// Processing Secret Code Display
	    			$('#issue_receive_admin_code').html('N/A');
	    			$('#issue_fine_admin_code').html('N/A');

	    			$('#issue_lend_user_code').html(issue.issue_lend_user_code);
    				$('#issue_receive_user_code').html(issue.issue_receive_user_code);
    				$('#issue_fine_user_code').html(issue.issue_fine_user_code);
    				$('#issue_renew_user_code').html(issue.issue_renew_user_code);

	    			
    				if(i_status == 2 || i_status == 3) 
		    			$('#issue_receive_admin_code').html(issue.issue_receive_admin_code);
		    		if(i_status == 3)
	    				$('#issue_fine_admin_code').html(issue.issue_fine_admin_code);	    			
	    		}
    	    });
	    });
	    <?php } ?>

	    <?php if($page == 'user') { ?> //============= Issue Requests Page JS Functions

	    	$('#change_pass_form').submit(function() {
	    		var pass_1 = $('#pass_1').val();
	    		var pass_2 = $('#pass_2').val();
	    		if(pass_1 != pass_2) {
	    			alert("Passwords don't match!");
	    			return false;
	    		}
	    		if(!confirm("Are you sure to submit?")) return false;
	    	});

	    	$('#new_code_form').submit(function() {
	    		if(!confirm("Are you sure to generate new code?")) return false;
	    	});

	    <?php } ?>

	    <?php if($page == 'login') { ?> //============= Issue Requests Page JS Functions
			$(document).on('click', '#forgot_button', function() {
				$('#password_reset_modal').removeClass('hide');
				$('#password_reset_modal').addClass('show');
			});
		<?php } ?>
	});
</script>