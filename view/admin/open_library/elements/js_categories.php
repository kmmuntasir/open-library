$(document).on('click', '.edit_category', function() {
	$('.edit_form_inputs').children('input[name="category_name"]').val($(this).attr('category'));
	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('category_id');
	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
});

function post_process_categories_table() {
	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(2)').html();
		if(id != null) {
			var category_name = $(this).children('td:nth-child(1)').html();
			category = '<a href="'+site_url+'/admin/book/book_by_filter/2/'+id+'" title="View All Books of this Category">'+category_name+'</a>';
			$(this).children('td:nth-child(1)').html(category)

			$(this).children('td:nth-child(2)').html('')
			var buttons = '<a href="#" category="'+category_name+'" category_id="'+id+'" class="edit edit_category btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> <a href="'+site_url+'/admin/category/delete/'+id+'" class="delete btn btn-sm btn-danger"><i class="fa fa-remove"></i></a>';

			$(this).children('td:nth-child(2)').html(buttons);

		}

	});
}