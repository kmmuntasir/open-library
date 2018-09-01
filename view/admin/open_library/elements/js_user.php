$(document).on('submit', '#importform', function() {
	if(!confirm("Are you sure?")) 
		event.preventDefault();

	return;
});

$(document).on('click', '#import_user', function() {
    $('#importModal').removeClass('hide');
    $('#importModal').addClass('show');
});

$('.user_addform').submit(function() {
	var pass_1 = $('input.add_pass_1').val();
	var pass_2 = $('input.add_pass_2').val();
	if(pass_1 != pass_2) { 
		alert("Passwords don't match!");
		return false;
	}
	var dept = $('select#user_dept_add').val();
	if(dept == 'nothing') {
		alert("Please select a department!");
		return false;
	}
});

$('.user_updateform').submit(function() {
	var pass_1 = $('input.update_pass_1').val();
	var pass_2 = $('input.update_pass_2').val();
	if(pass_1 != pass_2) { 
		alert("Passwords don't match!");
		return false;
	}
	var dept = $('select#user_dept_update').val();
	if(dept == 'nothing') {
		alert("Please select a department!");
		return false;
	}
});

$(document).on('click', '.edit_user', function() {
	var user_id = $(this).attr('user_id');
	var url = '<?php echo $controller; ?>' + '/update/' + user_id;
	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	url = site_url + 'admin/user/single_user/' + user_id;

	$.post(url, function(data) {
		var user = $.parseJSON(data);
		$('.edit_form_inputs').children('input[name="user_name"]').val(user.user_name);
		if(user.is_teacher == 0) {
			$('.edit_form_inputs').children('input[name="user_session"]').val(user.user_session);
			$('.edit_form_inputs').children('input[name="user_roll"]').val(user.user_roll);
		}
		else $('.edit_form_inputs').children('input[name="teacher_designation"]').val(user.teacher_designation);

		$('.edit_form_inputs').children('input[name="user_phone"]').val(user.user_phone);
		$('.edit_form_inputs').children('input[name="user_email"]').val(user.user_email);
		$('.edit_form_inputs').children('input[name="user_username"]').val(user.user_username);
		//$('.edit_form_inputs').children('input[name="user_session"]').val(user.user_dept);

		$('#user_dept_update').val(user.user_dept);
	});
});

$(document).on('click', '.delete_user', function() {
	var user_id = $(this).attr('user_id');
	var url = '<?php echo $controller; ?>' + '/delete/' + user_id;
	if(!confirm("Are you sure to deactivate this user?")) return false;
	window.location.replace(url);
});


$(document).on('click', '.reactivate_user', function() {
	var user_id = $(this).attr('user_id');
	var url = '<?php echo $controller; ?>' + '/reactivate/' + user_id;
	if(!confirm("Are you sure to reactivate this user?")) return false;
	window.location.replace(url);
});


function post_process_students_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(9)').html();
		if(id != null) {
			$(this).children('td:nth-child(9)').html('')
			//alert(id);
			var buttons = '<a title="Edit" href="#" user_id="'+id+'" class="edit edit_user btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> ';

			<?php if($page_title != 'Deactivated Students') { ?>
				buttons += '<a title="Deactivate" user_id="'+id+'" href="#" class="delete_user btn btn-sm btn-danger"><i class="fa fa-ban"></i></a>';
			<?php } else { ?>
				buttons += '<a title="Reactivate" user_id="'+id+'" href="#" class="reactivate_user btn btn-sm btn-success"><i class="fa fa-check"></i></a>';
			<?php } ?>
			
			$(this).children('td:nth-child(9)').html(buttons);
		}

		var name = $(this).children('td:nth-child(2)').html();
		$(this).children('td:nth-child(2)').html('');
		var name = '<a href="'+site_url+'/admin/issue/issue_by_user/'+id+'" title="View All Books by this User">'+name+'</a>';
		$(this).children('td:nth-child(2)').html(name);
	});
}


function post_process_teachers_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(8)').html();
		if(id != null) {
			$(this).children('td:nth-child(8)').html('')
			//alert(id);
			var buttons = '<a title="Edit" href="#" user_id="'+id+'" class="edit edit_user btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> ';

			<?php if($page_title != 'Deactivated Teachers') { ?>
				buttons += '<a title="Deactivate" user_id="'+id+'" href="#" class="delete_user btn btn-sm btn-danger"><i class="fa fa-ban"></i></a>';
			<?php } else { ?>
				buttons += '<a title="Reactivate" user_id="'+id+'" href="#" class="reactivate_user btn btn-sm btn-success"><i class="fa fa-check"></i></a>';
			<?php } ?>
			
			$(this).children('td:nth-child(8)').html(buttons);
		}

		var name = $(this).children('td:nth-child(2)').html();
		$(this).children('td:nth-child(2)').html('');
		var name = '<a href="'+site_url+'/admin/issue/issue_by_user/'+id+'" title="View All Books by this User">'+name+'</a>';
		$(this).children('td:nth-child(2)').html(name);
	});
}