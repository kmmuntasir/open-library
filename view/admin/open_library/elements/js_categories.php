$(document).on('click', '.edit_category', function() {
	$('.edit_form_inputs').children('input[name="category_name"]').val($(this).attr('category'));
	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('category_id');
	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
});