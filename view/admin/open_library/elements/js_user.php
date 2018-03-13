

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

		
		$('#user_dept_update').children('option').each(function() {
			if(user.user_dept == $(this).html()) 
				$(this).attr('selected', 'selected');
		});
	});
});

$(document).on('click', '.delete_user', function() {
	var user_id = $(this).attr('user_id');
	var url = '<?php echo $controller; ?>' + '/delete/' + user_id;
	if(!confirm("Are you sure to delete?")) return false;
	window.location.replace(url);
});

// Function for Expanding the menu
$(document).ready(function() {
	//$('#user_submenu_button').click();
});