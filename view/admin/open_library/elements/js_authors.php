    $(document).on('click', '.edit_author', function() {
    	$('.edit_form_inputs').children('input[name="author_name"]').val($(this).attr('author'));
    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('author_id');
    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	});