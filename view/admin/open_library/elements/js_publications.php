    $(document).on('click', '.edit_publication', function() {
    	$('.edit_form_inputs').children('input[name="publication_name"]').val($(this).attr('publication'));
    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('publication_id');
    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	});