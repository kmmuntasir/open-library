    $(document).on('click', '.edit_publication', function() {
    	$('.edit_form_inputs').children('input[name="publication_name"]').val($(this).attr('publication'));
    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('publication_id');
    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	});



function post_process_publications_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(2)').html();
		if(id != null) {
			var publication_name = $(this).children('td:nth-child(1)').html();
			publication = '<a href="'+site_url+'/admin/book/book_by_filter/3/'+id+'" title="View All Books by this Publisher">'+publication_name+'</a>';
			$(this).children('td:nth-child(1)').html(publication)

			$(this).children('td:nth-child(2)').html('')
			var buttons = '<a href="#" publication="'+publication_name+'" publication_id="'+id+'" class="edit edit_publication btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> <a href="'+site_url+'/admin/publication/delete/'+id+'" class="delete btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>';

			$(this).children('td:nth-child(2)').html(buttons);

		}

	});
}