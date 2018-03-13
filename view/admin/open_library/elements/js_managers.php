$('.manager_addform').submit(function() {
	var pass_1 = $('input.add_pass_1').val();
	var pass_2 = $('input.add_pass_2').val();
	if(pass_1 != pass_2) { 
		alert("Passwords don't match!");
		return false;
	}
});

$('.manager_updateform').submit(function() {
	var pass_1 = $('input.update_pass_1').val();
	var pass_2 = $('input.update_pass_2').val();
	if(pass_1 != pass_2) { 
		alert("Passwords don't match!");
		return false;
	}
});

$(document).on('click', '.edit_manager', function() {
	var man_id = $(this).attr('manager');
	var url = '<?php echo $controller; ?>' + '/update/' + man_id;
	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	url = site_url + 'admin/manager/single_manager/' + man_id;
	$.post(url, function(data) {
		var man = $.parseJSON(data);
		$('.edit_form_inputs').children('input[name="manager_name"]').val(man.manager_name);
		$('.edit_form_inputs').children('input[name="manager_phone"]').val(man.manager_phone);
		$('.edit_form_inputs').children('input[name="manager_email"]').val(man.manager_email);
		$('.edit_form_inputs').children('input[name="manager_user"]').val(man.manager_user);
	});
});