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
			var buttons = '<a href="#" publication="'+publication_name+'" publication_id="'+id+'" class="edit edit_publication btn btn-sm btn-info"><i class="fa fa-pencil"></i></a> <a href="'+site_url+'/admin/publication/delete/'+id+'" class="delete btn btn-sm btn-danger"><i class="fa fa-remove"></i></a> <a id="merge_button_'+id+'" title="Add to Merge List" href="#" publication="'+publication_name+'" publication_id="'+id+'" class="add_merge_publication btn btn-sm btn-default"><i class="fa fa-compress"></i></a>';

			$(this).children('td:nth-child(2)').html(buttons);

		}

	});
}

var total_merge_number = 0;
var add_merge_flag = true;


$(document).on('click', '.add_merge_publication', function() {
	if(add_merge_flag == false) return;
	if(total_merge_number == 0) {
		$('.merge_alert').hide();
	}
	else if(total_merge_number == 1) {
		$('#total_merge_button').show();
	}
	$(this).hide();
	var id = $(this).attr('publication_id');
	var name = $(this).attr('publication');


	var alert = '<div class="merge_item alert alert-sm alert-warning" id="merge_item_'+id+'" publication_id="'+id+'">'+name+' ('+id+')<button class="remove_from_merge_list pull-right btn btn-xs btn-danger" publication_id="'+id+'"><i class="fa fa-remove"></button></div>';
	$('#merge_list').append(alert);
	total_merge_number++;
});

$(document).on('click', '.remove_from_merge_list', function() {
	if(total_merge_number == 1) {
		$('.merge_alert').show();
		$('#total_merge_button').hide();
	}
	var id = $(this).attr('publication_id');
	var item = 'merge_item_'+id;
	var merge_button = 'merge_button_'+id;

	$('#'+item).remove();
	$('#'+merge_button).show();

	total_merge_number--;
});

$(document).on('click', '#total_merge_button', function() {
	$(this).hide();
	add_merge_flag = false;
	$('#merge_target_select').html('');
	$('.remove_from_merge_list').hide();
	$('.merge_item').each(function() {
		var text = $(this).html();
		var id = $(this).attr('publication_id');
		var option = '<option value="'+id+'">'+text+'</option>';
		$('#merge_target_select').append(option);
	});


	$('#merge_target_div').show();
});

$(document).on('click', '#back_to_list', function() {
	add_merge_flag = true;
	$('#merge_target_select').html('');
	$('#merge_target_div').hide();
	$('.remove_from_merge_list').show();
	$('#total_merge_button').show();
});

$(document).on('click', '#confirm_merge', function() {
	var target = $('#merge_target_select').val();
	var merge_items = [];
	$('.merge_item').each(function() {
		var id = $(this).attr('publication_id');
		if(id != target) merge_items.push(id);
	});
	//merge_items.push(target);

	var post_data = JSON.stringify(merge_items);
	var url = site_url + 'admin/publication/merge/' + target;

	var reloader = function() {
		location.reload();
	}

	$.post( url, {'merge_items':post_data}, function( response ) { 
		if(response == 'success') {
			showFlash('<b>Merge Success<br>Reloading Page</b>', 'success');
			setTimeout(reloader, 2000);
		}
		else showFlash('Merge Failed', 'danger')
	});

});