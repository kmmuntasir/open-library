// Function for Expanding the menu
	$(document).ready(function() {
		//$('a#issue_nav_button').click();
		$('.issue_datetime_th').click();
		$('.issue_datetime_th').click();
	});
// Functions for Issue Add Form

$(document).on('click', 'button#book_plus', function() {
	var n = $('.add_form_inputs').children('input[name="num_of_books"]').val();
	n++;

	$('.add_form_inputs').children('.book_box').append('<input required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="book_'+n+'" placeholder="Book '+n+' Accession No."/>');
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
	if(!confirm("Are you sure to issue?")) {
		event.preventDefault;
		return false;
	}
	$('.add_form_inputs').children('input[name="user_library_code_primary"]').val();
	$('.add_form_inputs').children('input[name="user_library_code"]').val($('.add_form_inputs').children('input[name="user_library_code_primary"]').val());
	$('.add_form_inputs').children('input[name="user_library_code_primary"]').val('');
});

var issue = '';
var user_details = '';
var book_details = '';

// Functions for Issue View Modal
$(document).on('click', '.view_issue', function() {
	var issue_id = $(this).attr('issue_id');
	var url = site_url + 'admin/issue/single_issue_details/' + issue_id;
	$.post(url, function(data) {
		if(data) {
			issue = $.parseJSON(data);
			$('#issue_id').html('Issue #' + issue.issue_id);
			$('#issue_datetime').html(issue.issue_datetime);
			$('#issue_auto_expire_datetime').html(issue.issue_auto_expire_datetime);
			$('#issue_return_datetime').html(issue.issue_return_datetime);
			(issue.is_teacher == 0)?$('#issue_deadline').html(issue.issue_deadline):$('#issue_deadline').html('N/A');
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
			$('#manager_details').html(issue.manager_name);
			var options = '';
			var issue_status = '';
			var i_status = parseInt(issue.issue_status);
			if(i_status == -1) {
				issue_status = '<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Overdue</button>';
				options = '<button status="-1" id="issue_renew_button" issue_id="'+issue.issue_id+'" class="btn btn-sm btn-success pull-right"><i class="fa fa-book"></i> Renew</button><button type="button" fine="true" id="issue_receive_with_fine_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive with Fine</button>';
			}
			else if(i_status == 9) {
				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Requested</button>';
			}
			else if(i_status == -3) {
				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Expired</button>';
			}
			else if(i_status == 1) {
				issue_status = '<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Active</button>';
				options = '<button status="1" id="issue_renew_button" issue_id="'+issue.issue_id+'" class="btn btn-sm btn-success pull-right"><i class="fa fa-book"></i> Renew</button><button type="button" fine="false" id="issue_receive_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive</button>';
			}
			else if(i_status == 2) {
				issue_status = '<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-calendar-times-o"></i> Received Without Fine</button>';
				options = '<button type="button" fine="true" id="fine_receive_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive Fine</button>';
			}
			else if(i_status == 3) {
				issue_status = '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Completed</button>';
			}
			else if(i_status == 0) {
				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i> Confirmed but not Issued</button>';
				options = '<button type="button" fine="false" id="issue_activate_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Activate Issue</button>';
			}
			//if(i_status == 0) options = '<a href="'+ site_url +'admin/issue/delete/'+ issue_id +'" class="delete btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i> Delete</a>' + options +'<div class="clearfix"></div>';
			if(i_status == 0) options = options +'<div class="clearfix"></div>';
			$('#issue_status').html(issue_status);
			$('#issue_fine').html(issue.issue_fine);
			$('#issue_remarks').html(issue.issue_remarks);
			$('#issue_view_modal_footer').html(options);
			// Processing Secret Code Display
			$('#issue_lend_user_code').html('N/A');
			$('#issue_receive_user_code').html('N/A');
			$('#issue_fine_user_code').html('N/A');
			$('#issue_renew_user_code').html('N/A');

			if(i_status != 9 && i_status != 0) {
				if(i_status > 0 || i_status == -1) 
	    			$('#issue_lend_user_code').html(issue.issue_lend_user_code);
	    		if(i_status > 1)
    				$('#issue_receive_user_code').html(issue.issue_receive_user_code);
    			if(i_status > 2) {
    				$('#issue_fine_user_code').html(issue.issue_fine_user_code);
    				$('#issue_renew_user_code').html(issue.issue_renew_user_code);
    			}
    		}
			$('#issue_receive_admin_code').html(issue.issue_receive_admin_code);
			$('#issue_fine_admin_code').html(issue.issue_fine_admin_code);
			
		}
    });
});

// Functions for Issue Receive Operations
// issue_renew_button
$(document).on('click', '#issue_renew_button', function() {
	if($(this).attr('status') == -1) $('#renew_alert').removeClass('hide').addClass('show');
	else $('#renew_alert').removeClass('show').addClass('hide');
	var url = site_url + 'admin/issue/renew/' + $(this).attr('issue_id');
	$('#renewModal_form').attr('action', url);
	$('#viewModal').removeClass('show').addClass('hide');
	$('#renewModal').removeClass('hide').addClass('show');
});

// $('#renewModal_form').submit(function(event) {
// 	var renew_code = $('#renew_code_input').val();
	//var url = site_url + 'admin/issue/renew/' + $(this).attr('issue_id');
	// $.post(url, {'issue_renew_user_code':renew_code}, function(data) {
	// 	if(data=='success') {
	// 		showFlash('Successfully Activated Issue', 'success');
	// 		$('#activateModal').removeClass('show').addClass('hide');
	// 	}
	// 	else showFlash(data, 'danger');
	// });
	// event.preventDefault();
//});
// issue_receive_with_fine_button

$(document).on('click', '#issue_receive_with_fine_button', function() {
	$('#fineModal_body').children('.user_details').html(user_details);
	$('#fineModal_body').children('.book_details').html(book_details + '<br /><br ><button id="receive_with_fine_final" href="'+ site_url +'admin/issue/receive/'+issue.issue_id+'/1" class="btn btn-success btn-lg">Fine: ' + issue.issue_fine+ '<br/><span class="fine_receive_button">Receive with Fine</span></button>');
	var url = site_url + 'admin/issue/receive/' + issue.issue_id;
	$('#receive_issue_final').fadeIn(0);
	$('#receive_issue_final').attr("href", url);
	$('#viewModal').removeClass('show');
	$('#viewModal').addClass('hide');
	$('#fineModal').removeClass('hide');
	$('#fineModal').addClass('show');
});

$(document).on('click', '#receive_with_fine_final', function() {
	if(!confirm("Are you sure you received the fine?")) return false;
	var url = $(this).attr('href');
	$.post(url, function(data) {
		if(data=='success') {
			showFlash('Successfully Received', 'success');
			$('#fineModal').removeClass('show');
			$('#fineModal').addClass('hide');
		}
		else showFlash(data, 'danger');
	});
	return false;
});


$(document).on('click', '#receive_issue_final', function() {
	if(!confirm("Are you sure?")) return false;
	var url = $(this).attr('href');
	$.post(url, function(data) {
		if(data=='success') {
			showFlash('Successfully Received', 'success');
			$('#fineModal').removeClass('show');
			$('#fineModal').addClass('hide');
		}
		else showFlash(data, 'danger');
	});
	return false;
});



// issue_receive_button
$(document).on('click', '#issue_receive_button', function() {
	$('#fineModal_body').children('.user_details').html(user_details);
	$('#fineModal_body').children('.book_details').html(book_details + '<br />');
	var url = site_url + 'admin/issue/receive/' + issue.issue_id;
	$('#receive_issue_final').fadeIn(0);
	$('#receive_issue_final').attr("href", url);
	$('#viewModal').removeClass('show');
	$('#viewModal').addClass('hide');
	$('#fineModal').removeClass('hide');
	$('#fineModal').addClass('show');
});

// fine_receive_button
$(document).on('click', '#fine_receive_button', function() {
	$('#fineModal_body').children('.user_details').html(user_details);
	$('#fineModal_body').children('.book_details').html(book_details + '<br /><br ><button id="receive_with_fine_final" href="'+ site_url +'admin/issue/receive/'+issue.issue_id+'/1" class="btn btn-danger btn-lg">Fine: ' + issue.issue_fine+ '<br/><span class="fine_receive_button">Receive Fine</span></button>');
	$('#receive_issue_final').fadeOut(0);
	$('#viewModal').removeClass('show');
	$('#viewModal').addClass('hide');
	$('#fineModal').removeClass('hide');
	$('#fineModal').addClass('show');
});

// Functions for Issue Activation Operation
// issue_activate_button
$(document).on('click', '#issue_activate_button', function() {
	$('#viewModal').removeClass('show').addClass('hide');
	$('#activateModal').removeClass('hide').addClass('show');
	var url = site_url + 'admin/issue/activate/' + issue.issue_id;
	$('#activateModal_form').attr('action', url);
});

$('#activateModal_form').submit(function(event) {
	var user_library_code = $('#user_library_code_input').val();
	var ac_no = $('#issue_book_copy_accession_no_input').val();
	var url = site_url + 'admin/issue/activate/' + issue.issue_id;
	$.post(url, {'user_library_code':user_library_code, 'issue_book_copy_accession_no':ac_no}, function(data) {
		if(data=='success') {
			showFlash('Successfully Activated Issue', 'success');
			$('#activateModal').removeClass('show').addClass('hide');
		}
		else showFlash(data, 'danger');
	});
	event.preventDefault();
});