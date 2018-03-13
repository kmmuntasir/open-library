// Functions for Delete Copy Range Form
$('#delete_copy_range_form').submit(function(event){
	if(!confirm('Are you sure to delete?')) event.preventDefault();
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
		    	$('#viewModal').removeClass('hide');
		    	$('#viewModal').addClass('show');
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