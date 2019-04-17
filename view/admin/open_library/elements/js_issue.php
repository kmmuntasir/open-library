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
			else if(i_status == 6) {
				issue_status = '<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-hand-paper-o"></i> Demanded</button>';
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

			if(i_status != 9 && i_status != 0 && i_status != 6) {
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
	$('.library_code_curtain').html('');
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
	$('.library_code_curtain').html('');
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

var user_type_class = ['info', 'danger'];
var user_type = ['Student', 'Teacher'];

function post_process_issue_requests_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var book = $(this).children('td:nth-child(3)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(3)').html(book);
			}

			var stat = $(this).children('td:nth-child(6)').html();

			var status_button = '<button type="button" class="btn btn-xs btn-'+issue_status_class(stat)+'">'+issue_status(stat)+'</button>';
			$(this).children('td:nth-child(6)').html(status_button);

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(7)').html(action_buttons);
		}

	});
}

function post_process_active_issues_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var book = $(this).children('td:nth-child(3)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') ('+book_json[2]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(3)').html(book);
			}

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(6)').html(action_buttons);
		}

	});
}


function post_process_overdue_issues_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var book = $(this).children('td:nth-child(3)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') ('+book_json[2]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(3)').html(book);
			}

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(7)').html(action_buttons);
		}

	});
}

function post_process_completed_issues_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var book = $(this).children('td:nth-child(3)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') ('+book_json[2]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(3)').html(book);
			}

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(6)').html(action_buttons);
		}

	});
}


function issue_status(stat) {
	if		(stat == 0) 	return 'Confirmed';
	else if (stat == 1) 	return 'Active';
	else if (stat == 2)		return 'Fine Due';
	else if (stat == 3) 	return 'Completed';
	else if (stat == 6)		return 'Demanded';
	else if (stat == 8)		return 'Expired';
	else if (stat == 9) 	return 'Requested';
	else if (stat == -1)	return 'Overdue';
}
function issue_status_class(stat) {
	if		(stat == 0) 	return 'primary';
	else if (stat == 1) 	return 'warning';
	else if (stat == 2)		return 'info';
	else if (stat == 3) 	return 'success';
	else if (stat == 6)		return 'danger';
	else if (stat == 8)		return 'default';
	else if (stat == 9) 	return 'info';
	else if (stat == -1)	return 'danger';
}

function post_process_all_issues_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var book = $(this).children('td:nth-child(3)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') ('+book_json[2]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(3)').html(book);
			}

			var stat = $(this).children('td:nth-child(9)').html();

			var status_button = '<button type="button" class="btn btn-xs btn-'+issue_status_class(stat)+'">'+issue_status(stat)+'</button>';
			$(this).children('td:nth-child(9)').html(status_button);		

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(10)').html(action_buttons);
		}

	});
}


function post_process_issue_by_user_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var book = $(this).children('td:nth-child(2)').html();
			if(book != null) {
				var book_json = $.parseJSON(book);
				//console.log(book_json);
				book = '<a href="'+site_url+'admin/issue/issue_by_book/'+book_json[0]+'" title="View History for this Book">(#'+book_json[0]+') ('+book_json[2]+') '+book_json[1]+'</a>';
				$(this).children('td:nth-child(2)').html(book);
			}

			var stat = $(this).children('td:nth-child(8)').html();

			var status_button = '<button type="button" class="btn btn-xs btn-'+issue_status_class(stat)+'">'+issue_status(stat)+'</button>';
			$(this).children('td:nth-child(8)').html(status_button);			

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(9)').html(action_buttons);
		}

	});
}


function post_process_issue_by_book_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var stat = $(this).children('td:nth-child(8)').html();

			var status_button = '<button type="button" class="btn btn-xs btn-'+issue_status_class(stat)+'">'+issue_status(stat)+'</button>';
			$(this).children('td:nth-child(8)').html(status_button);			

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(9)').html(action_buttons);
		}

	});
}


function post_process_issue_by_book_copy_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null) {
			var user = $(this).children('td:nth-child(2)').html();
			if(user != null) {
				var user_json = $.parseJSON(user);
				//console.log(user_json);
				user = '<span class="btn btn-xs btn-'+user_type_class[user_json[2]]+'">'+user_type[user_json[2]]+'</span> <a title="View Issue History for this User" href="'+site_url+'admin/issue/issue_by_user/'+user_json[0]+'">'+user_json[1]+'</a>';;
				$(this).children('td:nth-child(2)').html(user);
			}
			var stat = $(this).children('td:nth-child(8)').html();

			var status_button = '<button type="button" class="btn btn-xs btn-'+issue_status_class(stat)+'">'+issue_status(stat)+'</button>';
			$(this).children('td:nth-child(8)').html(status_button);			

			var action_buttons = '<a href="#" title="View Issue Details" issue_id="'+id+'" class="view_issue btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

			$(this).children('td:nth-child(9)').html(action_buttons);
		}

	});
}

$(document).on('input', 'input[name=user_library_code]', function() {
	var code = $(this).val();
	var star = '';
	for(var i=0; i< code.length; i++) star += '*';
	$(this).siblings('.library_code_curtain').html(star);
});

$(document).on('input', 'input[name=user_pin]', function() {
	var code = $(this).val();
	var star = '';
	for(var i=0; i< code.length; i++) star += '*';
	$(this).siblings('.library_code_curtain').html(star);
});

$(document).on('change', '#secret_code_method_changer', function() {
	var method_status = $(this).prop('checked');

	if(method_status) { // Use PIN instead of Barcode
		$('#secret_code_input_label').html("User PIN");
		$('#secret_code_input').val('');
		$('.library_code_curtain').html("");
		$('#secret_code_input').attr('name', "user_pin");
		$('#secret_code_input').attr('maxlength', "4");
		$('#secret_code_input').attr('placeholder', "Type User Pin (Example: 1234)");
		$('#user_id_box').show();
		$('#user_id_text_input').attr('required', 'required');
	}
	else {
		$('#secret_code_input_label').html("User Library Code");
		$('#secret_code_input').val('');
		$('.library_code_curtain').html("");
		$('#secret_code_input').attr('name', "user_library_code");
		$('#secret_code_input').removeAttr('maxlength');
		$('#secret_code_input').attr('placeholder', "User Library Code (use barcode machine)");
		$('#user_id_box').hide();
		$('#user_id_text_input').removeAttr('required');
	}
});

$(document).on('click', '#issue_add_super_admin', function(){ 
	$('#issue_add_super_admin_modal').removeClass('hide');
	$('#issue_add_super_admin_modal').addClass('show');
});