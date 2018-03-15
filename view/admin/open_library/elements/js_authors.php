    $(document).on('click', '.edit_author', function() {
    	$('.edit_form_inputs').children('input[name="author_name"]').val($(this).attr('author'));
    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('author_id');
    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	});


function post_process_authors_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(2)').html();
		if(id != null) {
			var author_name = $(this).children('td:nth-child(1)').html();
			author = '<a href="'+site_url+'/admin/book/book_by_filter/1/'+id+'" title="View All Books by this Author">'+author_name+'</a>';
			$(this).children('td:nth-child(1)').html(author)

			$(this).children('td:nth-child(2)').html('')
			var buttons = '<a href="#" author="'+author_name+'" author_id="'+id+'" class="edit edit_author btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> <a href="'+site_url+'/admin/author/delete/'+id+'" class="delete btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>';

			$(this).children('td:nth-child(2)').html(buttons);

		}

	});
}