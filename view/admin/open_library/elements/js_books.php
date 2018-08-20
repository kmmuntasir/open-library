// Functions for Book View Form
$(document).on('click', '.view_book', function() { 
	var book_id = $(this).attr('book_id');
	url = site_url + 'admin/book/single_book/' + book_id;
	$.post(url, function(data) {
		var book = $.parseJSON(data);
		$('.view_code').html(book.book_id);
		$('.view_title').html(book.book_title);
		$('.view_isbn').html(book.book_isbn);
		$('.view_publication').html(book.publication_name);
		$('.view_edition').html(book.book_edition);
		$('.view_place_of_publication').html(book.book_place_of_pub);
		$('.view_year_of_publication').html(book.book_year_of_pub);
		$('.view_total_pages').html(book.book_pages);
		var status = ['Inactive', 'Active'];
		$('.view_status').html(status[book.book_status]);
		$('.view_stock').html(book.book_stock);
		$('.view_available').html(book.book_available);
		$('.view_remarks').html(book.book_remarks);
		$('.view_book_add_date').html(book.book_add_date);
		$('.view_book_last_updated').html(book.timestamp);
		$('.view_book_manager').html(book.manager_name);
		
		var read_button = '<a target="_blank" href="<?php echo site_url('user/book/read_online'); ?>/'+book.book_id+'" title="'+book.book_url+'" class="btn btn-primary">Open Reading Window</a>';
	
		if(book.book_url != '' && book.book_url != null) $('.view_url').html(read_button);
		else $('.view_url').html('URL Not Available');

		
		if(book.book_url_unlocked == 1) $('.view_url_unlocked').html('Enabled');
		else $('.view_url_unlocked').html('Disabled');

		var authors = '';
		var i=0;
		while(i<book.authors.length) {
			authors += book.authors[i++].author_name + '<br />';
		}
		$('.view_author').html(authors);

		var categories = '';
		var i=0;
		while(i<book.categories.length) {
			categories += book.categories[i++].category_name + '<br />';
		}
		$('.view_category').html(categories);


		var copy_status = ['Issued', 'Available'];
		var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
	    var source = ['', 'Purchase', 'Donation', 'Others'];
		var book_copies = '';
		var i=0;
		while(i<book.book_copies.length) {
			var style = '';
			if(book.book_copies[i].book_copy_status == 0) style = 'style="color:#f00;"';
			book_copies += '<tr id="copy_row_'+book.book_copies[i].book_copy_accession_no+'" '+style+ '><td><a title="View Details" class="accession_anchor" href="#">'+book.book_copies[i].book_copy_accession_no + '</a></td>';
			book_copies += '<td>'+type[book.book_copies[i].book_copy_type] + '</td>';
			book_copies += '<td>'+copy_status[book.book_copies[i].book_copy_status] + '</td>';
			book_copies += '<td>'+book.book_copies[i].book_copy_date + '</td>';
			book_copies += '<td>'+book.book_copies[i].book_copy_price + '/-</td>';
			book_copies += '<td>'+source[book.book_copies[i].book_copy_source] + '</td>';
			if(book.book_copies[i].book_copy_remarks != null) var remarks = book.book_copies[i].book_copy_remarks;
			else var remarks = ' ';
			book_copies += '<td>'+ remarks + '</td>';
			var copy_options = "";

			copy_options += '<a title="Edit this copy" book_copy_accession_no="'+book.book_copies[i].book_copy_accession_no+'" class="editCopy btn btn-warning btn-xs" href="#"><i class="fa fa-pencil"></i></a>';


			var delete_url = site_url + 'admin/book/delete_copy_ajax/' + book.book_copies[i].book_copy_accession_no;

			copy_options += '<button title="Delete this copy" style="margin-left: 2px;" class="delete_copy_ajax btn btn-danger btn-xs" delete_url="'+ delete_url +'" ac_no="'+book.book_copies[i].book_copy_accession_no+'"><i class="fa fa-remove"></i></button>';

			// copy_options = "";

			book_copies += '<td>'+ copy_options + '</td></tr>';


			i++;
		}
		$('.book_copy_details_box').children('tbody').html(book_copies);
		$('#addCopyModalButton').attr('book_id', book.book_id);
	});
});

// Functions for Book Copy View Form
$(document).on('click', '.accession_anchor', function() { 
	var book_copy_accession_no = $(this).html();
	if(book_copy_accession_no != '') {

		var url = site_url + 'admin/book/delete_copy/' + book_copy_accession_no;
		$('#view_copy_footer').children('a.delete').attr('href', url);

		url = site_url + 'admin/issue/issue_by_book_copy/' + book_copy_accession_no;
		$('#view_copy_footer').children('a.history').attr('href', url);

		$('#view_copy_footer').children('button.editCopy').attr('book_copy_accession_no', book_copy_accession_no);
		url = site_url + 'admin/book/copy_details/' + book_copy_accession_no;

    	$.post(url, function(data) {
    		if(data) {
		    	$('#viewModal').removeClass('show');
		    	$('#viewModal').addClass('hide');
		    	$('#viewCopyModal').removeClass('hide');
		    	$('#viewCopyModal').addClass('show');
	    		var copy_status = ['Issued', 'Available'];
	    		var status = ['Inactive', 'Active'];
				var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
	    		var source = ['', 'Purchase', 'Donation', 'Others'];
	    		var book = $.parseJSON(data);
	    		var deleted = '';
	    		if(book.book_copy_is_deleted == 1) deleted = '<button class="btn btn-sm btn-danger" type="button">Deleted</button>';
	    		$('.view_title').html(book.book_title + ' ' + deleted);
	    		$('.view_isbn').html(book.book_isbn);
	    		$('.view_publication').html(book.publication_name);
	    		$('.view_edition').html(book.book_edition);
	    		$('.view_place_of_publication').html(book.book_place_of_pub);
	    		$('.view_year_of_publication').html(book.book_year_of_pub);
	    		$('.view_total_pages').html(book.book_pages);
	    		$('.view_status').html(status[book.book_status]);
	    		$('.view_stock').html(book.book_stock);
	    		$('.view_available').html(book.book_available);
	    		$('.view_remarks').html(book.book_remarks);
	    		var authors = '<ul>';
	    		var i=0;
	    		while(i<book.authors.length) {
	    			authors += '<li>'+book.authors[i++].author_name + '</li>';
	    		}
	    		authors += '</ul>';
	    		$('.view_author').html(authors);

	    		var categories = '<ul>';
	    		var i=0;
	    		while(i<book.categories.length) {
	    			categories += '<li>'+book.categories[i++].category_name + '</li>';
	    		}
	    		categories += '</ul>';
	    		$('.view_category').html(categories);

	    		$('.view_accession_no').html(book.book_copy_accession_no);
	    		$('.view_copy_type').html(type[book.book_copy_type]);
	    		$('.view_copy_status').html(copy_status[book.book_copy_status]);
	    		$('.view_copy_manager').html(book.manager_name);
	    		$('.view_copy_date').html(book.book_copy_date);
	    		$('.view_copy_price').html('BDT ' + book.book_copy_price);
	    		$('.view_copy_source').html(source[book.book_copy_source]);
	    		$('.view_add_date').html(book.book_add_date);
	    		$('.view_copy_remarks').html(book.book_copy_remarks);
    		}
    	});
	}
});

// Function for delete_copy_ajax
$(document).on('click', '.delete_copy_ajax', function() { 
	var url = $(this).attr('delete_url');
	var ac_no = $(this).attr('ac_no');

	if(!confirm("Are you sure to delete Accession No: "+ac_no+"?")) {
		event.preventDefault();
		return;
	}

	// alert(url);

	if(url != '' && url != null) {
    	$.post(url, function(data) {
    		if(data == 'success') {
    			$('#copy_row_'+ac_no).fadeOut(300, function() {
    				$(this).remove();
	    		});
    			showFlash('Successfully Deleted', 'success');
	    	}
	    	else {
    			showFlash(data, 'danger');
		    }
    	});
	}


	event.preventDefault();
});


// Functions for Book Copy Edit Form
$(document).on('click', '.editCopy', function() { 
	var book_copy_accession_no = $(this).attr('book_copy_accession_no');
	var url = site_url + 'admin/book/update_copy/' + book_copy_accession_no;
	$('.edit_copy_form').attr('action', url);
	//alert(book_copy_accession_no);
	if(book_copy_accession_no != '') {
		url = site_url + 'admin/book/copy_details/' + book_copy_accession_no;
    	$.post(url, function(data) {
    		if(data) {
		    	$('#viewModal').removeClass('show');
		    	$('#viewModal').addClass('hide');
		    	$('#viewCopyModal').removeClass('show');
		    	$('#viewCopyModal').addClass('hide');
		    	$('#copyEditModal').removeClass('hide');
		    	$('#copyEditModal').addClass('show');
	    		var book = $.parseJSON(data);
	    		var deleted = '';
	    		if(book.book_copy_is_deleted == 1) deleted = '<button class="btn btn-sm btn-danger" type="button">Deleted</button>';

	    		$('#edit_copy_modal_title').html('Edit Copy: '+book.book_title + ' ' + deleted);

	    		$('#edit_copy_type').children('option').removeAttr('selected');
	    		
	    		if(book.book_copy_type == 1) $('#edit_copy_type').children('option.book_copy_type_normal').attr('selected', 'selected');
	    		else $('#edit_copy_type').children('option.book_copy_type_reference').attr('selected', 'selected');

	    		$('#edit_copy_remarks').val(book.book_copy_remarks);
    		}
    	});
	}
});


// Functions for Book Add Form

$(document).on('click', 'button#add_author_plus', function() {
	var n = $('.add_form_inputs').children('input[name="num_of_authors"]').val();
	n++;

	$('.add_form_inputs').children('.author_box').append('<input list="author_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="author_'+n+'" placeholder="Type author '+n+' name here"/>');
	$('.add_form_inputs').children('input[name="num_of_authors"]').val(n);
});

$(document).on('click', 'button#add_author_minus', function() {
	var n = $('.add_form_inputs').children('input[name="num_of_authors"]').val();
	if(n==1) return;
	var name = 'author_' + n;
	$('.add_form_inputs').children('.author_box').children('input[name="'+name+'"]').remove();
	n--;
	$('.add_form_inputs').children('input[name="num_of_authors"]').val(n);
});


$(document).on('click', 'button#add_category_plus', function() {
	var n = $('.add_form_inputs').children('input[name="num_of_categories"]').val();
	n++;

	$('.add_form_inputs').children('.category_box').append('<input list="category_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="category_'+n+'" placeholder="Type Category '+n+' name here"/>');
	$('.add_form_inputs').children('input[name="num_of_categories"]').val(n);
});

$(document).on('click', 'button#add_category_minus', function() {
	var n = $('.add_form_inputs').children('input[name="num_of_categories"]').val();
	if(n==1) return;
	var name = 'category_' + n;
	$('.add_form_inputs').children('.category_box').children('input[name="'+name+'"]').remove();
	n--;
	$('.add_form_inputs').children('input[name="num_of_categories"]').val(n);
});
// Functions for Book Edit Form
$(document).on('click', '.edit_book', function() { 
	var book_id = $(this).attr('book_id');
	var url = '<?php echo $controller; ?>' + '/update/' + book_id;
	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	url = site_url + 'admin/book/single_book/' + book_id;
	$.post(url, function(data) {
		var book = $.parseJSON(data);
		$('.edit_form_inputs').children('input[name="book_title"]').val(book.book_title);
		$('.edit_form_inputs').children('input[name="book_isbn"]').val(book.book_isbn);
		$('.edit_form_inputs').children('input[name="publication_id"]').val(book.publication_id);
		$('.edit_form_inputs').children('input[name="publication_name"]').val(book.publication_name);
		$('.edit_form_inputs').children('input[name="book_edition"]').val(book.book_edition);
		$('.edit_form_inputs').children('input[name="book_place_of_pub"]').val(book.book_place_of_pub);
		$('.edit_form_inputs').children('input[name="book_year_of_pub"]').val(book.book_year_of_pub);
		$('.edit_form_inputs').children('input[name="book_pages"]').val(book.book_pages);
		$('.edit_form_inputs').children('select[name="book_status"]').children('option').removeAttr('selected');
		$('.edit_form_inputs').children('input[name="book_url"]').val(book.book_url);
		$('.edit_form_inputs').children('select[name="book_url_unlocked"]').children('option').removeAttr('selected');

		if(book.book_url_unlocked == 1) 
			$('.edit_form_inputs').children('select[name="book_url_unlocked"]').children('option.active_url').attr('selected', 'selected');
		else
			$('.edit_form_inputs').children('select[name="book_url_unlocked"]').children('option.inactive_url').attr('selected', 'selected');

		if(book.book_status == 1)
			$('.edit_form_inputs').children('select[name="book_status"]').children('option.active_book').attr('selected', 'selected');
		else
			$('.edit_form_inputs').children('select[name="book_status"]').children('option.inactive_book').attr('selected', 'selected');

		$('.edit_form_inputs').children('div').children('textarea[name="book_remarks"]').val(book.book_remarks);

		var n = $('.edit_form_inputs').children('input[name="num_of_authors"]').val();
		while(n>1) {
    		var name = 'author_' + n;
    		$('.edit_form_inputs').children('.author_box').children('input[name="'+name+'"]').remove();
    		n--;
    		$('.edit_form_inputs').children('input[name="num_of_authors"]').val(n);
    	}

		var n = book.authors.length;
		$('.edit_form_inputs').children('input[name="num_of_authors"]').val(n);
		$('.edit_form_inputs').children('.author_box').children('input[name="author_1"]').val(book.authors[0].author_name);
		var i =1;
		while(i<n) {
			var name = 'author_' + (i+1);
			$('.edit_form_inputs').children('.author_box').append('<input list="author_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="'+name+'" placeholder="Type author '+i+' name here"/>')
			$('.edit_form_inputs').children('.author_box').children('input[name="'+name+'"]').val(book.authors[i].author_name);
			i++;
		}

		var n = $('.edit_form_inputs').children('input[name="num_of_categories"]').val();
		while(n>1) {
    		var name = 'category_' + n;
    		$('.edit_form_inputs').children('.category_box').children('input[name="'+name+'"]').remove();
    		n--;
    		$('.edit_form_inputs').children('input[name="num_of_categories"]').val(n);
    	}

		var n = book.categories.length;
		$('.edit_form_inputs').children('input[name="num_of_categories"]').val(n);
		$('.edit_form_inputs').children('.category_box').children('input[name="category_1"]').val(book.categories[0].category_name);
		var i =1;
		while(i<n) {
			var name = 'category_' + (i+1);
			$('.edit_form_inputs').children('.category_box').append('<input list="category_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="'+name+'" placeholder="Type category '+i+' name here"/>')
			$('.edit_form_inputs').children('.category_box').children('input[name="'+name+'"]').val(book.categories[i].category_name);
			i++;
		}

	});
});

$(document).on('click', 'button#author_plus', function() {
	var n = $('.edit_form_inputs').children('input[name="num_of_authors"]').val();
	n++;

	$('.edit_form_inputs').children('.author_box').append('<input list="author_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="author_'+n+'" placeholder="Type author '+n+' name here"/>');
	$('.edit_form_inputs').children('input[name="num_of_authors"]').val(n);
});

$(document).on('click', 'button#author_minus', function() {
	var n = $('.edit_form_inputs').children('input[name="num_of_authors"]').val();
	if(n==1) return;
	var name = 'author_' + n;
	$('.edit_form_inputs').children('.author_box').children('input[name="'+name+'"]').remove();
	n--;
	$('.edit_form_inputs').children('input[name="num_of_authors"]').val(n);
});


$(document).on('click', 'button#category_plus', function() {
	var n = $('.edit_form_inputs').children('input[name="num_of_categories"]').val();
	n++;

	$('.edit_form_inputs').children('.category_box').append('<input list="category_names" required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="category_'+n+'" placeholder="Type Category '+n+' name here"/>');
	$('.edit_form_inputs').children('input[name="num_of_categories"]').val(n);
});

$(document).on('click', 'button#category_minus', function() {
	var n = $('.edit_form_inputs').children('input[name="num_of_categories"]').val();
	if(n==1) return;
	var name = 'category_' + n;
	$('.edit_form_inputs').children('.category_box').children('input[name="'+name+'"]').remove();
	n--;
	$('.edit_form_inputs').children('input[name="num_of_categories"]').val(n);
});

// Functions for Book Copy Add Form
$(document).on('click', '.addCopy', function() { 
	var book_id = $(this).attr('book_id');
	var url = site_url + 'admin/book/single_book/' + book_id;
	$.post(url, function(data) {
		var book = $.parseJSON(data);
		$('.add_copy_book_title').html('Add copies: '+book.book_title);
	});

	url = '<?php echo $controller; ?>' + '/add_copy/' + book_id;
	$('.add_copy_form').attr('action', url);
	url = site_url + 'admin/book/last_accession_number';
	//alert(url);
	$.post(url, function(ac_no) {
		$('#starting_accession').val(ac_no);
	});
});


function post_process_books_table() {

	$('.datatable tbody tr').each(function(){ 
		var p_flag = $(this).attr('rendered');
		if(p_flag != null) return;
		$(this).attr('rendered', 'yes');

		var id = $(this).children('td:nth-child(1)').html();

		if(id != null && id != '#') {
			//console.log(id);
			var title = $(this).children('td:nth-child(2)').html();
			title = '<a title="View Issue History for this Book" href="'+site_url+'/admin/issue/issue_by_book/'+id+'">'+title+'</a>';
			$(this).children('td:nth-child(2)').html(title);

			var authors = $(this).children('td:nth-child(3)').html();

			if(authors != null && authors != "") {
				var authors_for_book = authors.split("\n");
				var author_link = '';
				for(var i=0; i < authors_for_book.length; i++) {
					var single_author = authors_for_book[i].split("\t");
				    author_link += '<a title="View All Books by this Author" href="'+site_url+'/admin/book/book_by_filter/1/'+single_author[0]+'">'+single_author[1]+'</a><br />';

				}
				$(this).children('td:nth-child(3)').html(author_link);
			}



			var pub = $(this).children('td:nth-child(6)').html();

			
			if(pub != null) {
				var publications = pub.split("\t");
				pub = '<a title="View All Books by this Publisher" href="'+site_url+'/admin/book/book_by_filter/3/'+publications[0]+'">'+publications[1]+'</a>';
				$(this).children('td:nth-child(6)').html(pub);
			}


			var read = $(this).children('td:nth-child(9)').html();
			if(read == 1) {
				button = '<a target="_blank" href="'+site_url+'/admin/book/read_online/'+id+'" title="" class="btn btn-primary btn-xs">Read</a>';
				$(this).children('td:nth-child(9)').html(button);
			}
			else $(this).children('td:nth-child(9)').html('N/A');


			var url_unlocked = $(this).children('td:nth-child(10)').html();
			if(url_unlocked == 1) $(this).children('td:nth-child(10)').html('<code>Yes</code>');
			else $(this).children('td:nth-child(10)').html('<code>No</code>');

			var action_buttons = '<a title="View Book Details" href="#" book_id="'+id+'" class="view_book btn btn-xs btn-primary"><i class="fa fa-eye"></i></a> <a title="Add Copies for this Book" href="#" book_id="'+id+'" class="addCopy btn btn-xs btn-success"><i class="fa fa-copy"></i></a> <a title="Edit Book Details" href="#" book_id="'+id+'" class="edit edit_book btn btn-xs btn-info"><i class="fa fa-pencil"></i></a> <a title="Delete Book" href="'+site_url+'/admin/book/delete/'+id+'" class="delete btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>';
			$(this).children('td:nth-child(11)').html(action_buttons);
		}

	});
}

$(document).on('click', '#book_copy_details_button', function() {
	$('#copy_entry_Modal').removeClass('hide');
	$('#copy_entry_Modal').addClass('show');
});


// Functions for Book Copy View Form
$( "#get_copy_details" ).submit(function( event ) {

	var book_copy_accession_no = $('#book_copy_accession_no').val();
	if(book_copy_accession_no != '') {
		var url = site_url + 'admin/book/delete_copy/' + book_copy_accession_no;
		$('#view_copy_footer').children('a.deleted').attr('href', url);

		url = site_url + 'admin/issue/issue_by_book_copy/' + book_copy_accession_no;
		$('#view_copy_footer').children('a.history').attr('href', url);

		$('#view_copy_footer').children('button.editCopy').attr('book_copy_accession_no', book_copy_accession_no);
		url = site_url + 'admin/book/copy_details/' + book_copy_accession_no;
		
    	$.post(url, function(data) {
    		if(data) {
		    	$('#viewCopyModal').removeClass('hide');
		    	$('#viewCopyModal').addClass('show');
	    		var copy_status = ['Issued', 'Available'];
	    		var status = ['Inactive', 'Active'];
				var type = ['<button type="button" class="btn btn-xs btn-primary">Reference</button>', 'Normal'];
	    		var source = ['', 'Purchase', 'Donation', 'Others'];
	    		var book = $.parseJSON(data);
	    		var deleted = '';
	    		if(book.book_copy_is_deleted == 1) {
					deleted = '<button class="btn btn-sm btn-danger" type="button">Deleted</button>';
					$('a.delete').addClass('hide');
				}
				else {
					$('a.delete').removeClass('hide');
					$('a.delete').attr("href", site_url + 'admin/book/delete_copy/' + book_copy_accession_no);
				}
	    		$('.view_title').html(book.book_title + ' ' + deleted);
	    		$('.view_isbn').html(book.book_isbn);
	    		$('.view_publication').html(book.publication_name);
	    		$('.view_edition').html(book.book_edition);
	    		$('.view_place_of_publication').html(book.book_place_of_pub);
	    		$('.view_year_of_publication').html(book.book_year_of_pub);
	    		$('.view_total_pages').html(book.book_pages);
	    		$('.view_status').html(status[book.book_status]);
	    		$('.view_stock').html(book.book_stock);
	    		$('.view_available').html(book.book_available);
	    		$('.view_remarks').html(book.book_remarks);
	    		var authors = '<ul>';
	    		var i=0;
	    		while(i<book.authors.length) {
	    			authors += '<li>'+book.authors[i++].author_name + '</li>';
	    		}
	    		authors += '</ul>';
	    		$('.view_author').html(authors);

	    		var categories = '<ul>';
	    		var i=0;
	    		while(i<book.categories.length) {
	    			categories += '<li>'+book.categories[i++].category_name + '</li>';
	    		}
	    		categories += '</ul>';
	    		$('.view_category').html(categories);

	    		$('.view_accession_no').html(book.book_copy_accession_no);
	    		$('.view_copy_type').html(type[book.book_copy_type]);
	    		$('.view_copy_status').html(copy_status[book.book_copy_status]);
	    		$('.view_copy_manager').html(book.manager_name);
	    		$('.view_copy_date').html(book.book_copy_date);
	    		$('.view_copy_price').html('BDT ' + book.book_copy_price);
	    		$('.view_copy_source').html(source[book.book_copy_source]);
	    		$('.view_add_date').html(book.book_add_date);
	    		$('.view_copy_remarks').html(book.book_copy_remarks);
    		}
    		else showFlash('Invalid Accession Number', 'danger');


    		$('#copy_entry_Modal').removeClass('show');
    		$('#copy_entry_Modal').addClass('hide');
    		$('#get_copy_details')[0].reset();
    	});
	}
	event.preventDefault();
});