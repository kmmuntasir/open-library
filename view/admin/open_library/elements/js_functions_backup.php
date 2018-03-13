<script>
//window.open('http://localhost/library.ist.edu.bd','IST Library','toolbar=no, menubar=no, resizable=yes');
	$(document).ready(function(){
		var site_url = "<?php echo site_url(); ?>/";
		// Datatables Functions
	    $('.datatable').DataTable();

	    $(document).on('click', '#add_button', function() {
	    	$('#myModal').removeClass('hide');
	    	$('#myModal').addClass('show');
	    });

	    $(document).on('click', 'button.close', function() {
	    	$('.modal').removeClass('show');
	    	$('.modal').addClass('hide');
	    });

	    $(document).on('click', '.edit', function() {
	    	$('#editModal').removeClass('hide');
	    	$('#editModal').addClass('show');
	    });

	    
	    $(document).on('click', 'i.fa-eye', function() {
	    	$('#viewModal').removeClass('hide');
	    	$('#viewModal').addClass('show');
	    });

	    $(document).on('click', '.addCopy', function() {
	    	$('#viewModal').removeClass('show');
	    	$('#viewModal').addClass('hide');
	    	$('#copyModal').removeClass('hide');
	    	$('#copyModal').addClass('show');
	    });

	    $('.flash_message').delay(5000).fadeOut(5000);
	    var flash = 1;
	    $('.flash_message').each(function() {
	    	var margin = (flash * 10 + (flash-1) * 50) + 'px';
	    	$(this).css('margin-top', margin);
	    	++flash;
	    });

	    function showFlash(msg, type) {
	    	$('.standby_flash').children('div').removeAttr('class');
	    	$('.standby_flash').children('div').addClass('alert alert-' + type);
	    	$('.standby_flash').children('div').html(msg);
	    	$('.standby_flash').fadeIn(0, function() {
	    		$('.standby_flash').delay(5000).fadeOut(5000);
	    	});
	    }


	    $(document).one('click', '.delete', function() {
	    	if(!confirm("Are you sure to delete?")) return false;
	    });
	    
	    //============= Page Depended Functions =================

	    <?php if($page == 'managers') { ?> //============= Manager Page JS Functions

	    $(document).on('click', '.manager_add', function() {
	    	var pass_1 = $('input.add_pass_1').val();
	    	var pass_2 = $('input.add_pass_2').val();
	    	if(pass_1 != pass_2) { 
	    		alert("Passwords don't match!");
	    		return false;
	    	}
	    });

	    $(document).on('click', '.manager_update', function() {
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
	    <?php } ?>

	    <?php if($page == 'categories') { ?> //============= Category Page JS Functions
	    
	    $(document).on('click', '.edit_category', function() {
	    	$('.edit_form_inputs').children('input[name="category_name"]').val($(this).attr('category'));
	    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('category_id');
	    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
	    });
	    <?php } ?>


	    <?php if($page == 'authors') { ?> //============= Author Page JS Functions

	    $(document).on('click', '.edit_author', function() {
	    	$('.edit_form_inputs').children('input[name="author_name"]').val($(this).attr('author'));
	    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('author_id');
	    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
		});
	    <?php } ?>


	    <?php if($page == 'publications') { ?> //============= Publication Page JS Functions

	    $(document).on('click', '.edit_publication', function() {
	    	$('.edit_form_inputs').children('input[name="publication_name"]').val($(this).attr('publication'));
	    	var url = '<?php echo $controller; ?>' + '/update/' + $(this).attr('publication_id');
	    	$('#editModal').children('.modal-dialog').children('form.lib_form').attr('action', url);
		});
	    <?php } ?>

	    <?php if($page == 'books') { ?> //============= Book Page JS Functions
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
	    			book_copies += '<tr '+style+ '><td><a title="View Details" class="accession_anchor" href="#">'+book.book_copies[i].book_copy_accession_no + '</a></td>';
	    			book_copies += '<td>'+type[book.book_copies[i].book_copy_type] + '</td>';
	    			book_copies += '<td>'+copy_status[book.book_copies[i].book_copy_status] + '</td>';
	    			book_copies += '<td>'+book.book_copies[i].book_copy_date + '</td>';
	    			book_copies += '<td>'+book.book_copies[i].book_copy_price + '/-</td>';
	    			book_copies += '<td>'+source[book.book_copies[i].book_copy_source] + '</td>';
	    			if(book.book_copies[i].book_copy_remarks != null) var remarks = book.book_copies[i].book_copy_remarks;
	    			else var remarks = ' ';
	    			i++;
	    			book_copies += '<td>'+ remarks + '</td></tr>';
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

	    <?php } ?>

	    <?php if($page == 'book_copy') { ?> //============= Book_copy Page JS Functions
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
	    <?php } ?>

	    <?php if($page == 'issue' || $page == 'dashboard') { ?> //============= Issue Requests Page JS Functions
	   	// Function for Expanding the menu
	   	$(document).ready(function() {
	   		$('#issue_nav_button').click();
	   	});
	    // Functions for Issue Add Form

	    $(document).on('click', 'button#book_plus', function() {
	    	var n = $('.add_form_inputs').children('input[name="num_of_books"]').val();
	    	n++;

	    	$('.add_form_inputs').children('.book_box').append('<input required type="text" class="col-sm-8 col-sm-offset-4 col-xs-12" name="book_'+n+'" placeholder="Book '+n+' Accession No."/>');
	    	$('.add_form_inputs').children('input[name="num_of_books"]').val(n);
	    });

	    $(document).on('click', 'button#book_minus', function() {
	    	var n = $('.add_form_inputs').children('input[name="num_of_books"]').val();
	    	if(n==1) return;
	    	var name = 'book_' + n;
	    	$('.add_form_inputs').children('.book_box').children('input[name="'+name+'"]').remove();
	    	n--;
	    	$('.add_form_inputs').children('input[name="num_of_books"]').val(n);
	    });

	    $('#add_issue_form').submit(function(event) {
	    	if(!confirm("Are you sure to issue?")) {
	    		event.preventDefault;
	    		return false;
	    	}
	    	$('.add_form_inputs').children('input[name="user_library_code_primary"]').val();
	    	$('.add_form_inputs').children('input[name="user_library_code"]').val($('.add_form_inputs').children('input[name="user_library_code_primary"]').val());
	    	$('.add_form_inputs').children('input[name="user_library_code_primary"]').val('');
	    });

	    var issue = '';
	    var user_details = '';
	    var book_details = '';

	    // Functions for Issue View Modal
	    $(document).on('click', '.view_issue', function() {
	    	var issue_id = $(this).attr('issue_id');
	    	var url = site_url + 'admin/issue/single_issue_details/' + issue_id;
	    	$.post(url, function(data) {
	    		if(data) {
	    			issue = $.parseJSON(data);
	    			$('#issue_id').html('Issue #' + issue.issue_id);
	    			$('#issue_datetime').html(issue.issue_datetime);
	    			$('#issue_auto_expire_datetime').html(issue.issue_auto_expire_datetime);
	    			$('#issue_return_datetime').html(issue.issue_return_datetime);
	    			$('#issue_deadline').html(issue.issue_deadline);
	    			$('#issue_overdue').html(issue.issue_overdue);
	    			user_details = '<b>User ID: '+issue.user_id+'<br />'+issue.user_name + '</b><br />' + issue.user_dept + '-' + issue.user_roll + ' (Session: ' + issue.user_session + '-' + ((parseInt(issue.user_session) + 1)%2000) + ')<br />' + issue.user_phone + '<br />' + issue.user_email;
	    			$('#user_details').html(user_details);
	    			book_details = '<b>(#'+issue.book_id+') ' + issue.book_title + '</b><br />Accession No: ' + issue.issue_book_copy_accession_no;
	    			$('#book_details').html(book_details);
	    			$('#manager_details').html(issue.manager_name);
	    			var options = '';
	    			var issue_status = '';
	    			var i_status = parseInt(issue.issue_status);
	    			if(i_status == -1) {
	    				issue_status = '<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i> Overdue</button>';
	    				options = '<button status="-1" id="issue_renew_button" issue_id="'+issue.issue_id+'" class="btn btn-sm btn-success pull-right"><i class="fa fa-book"></i> Renew</button><button type="button" fine="true" id="issue_receive_with_fine_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive with Fine</button>';
	    			}
	    			else if(i_status == 9) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Requested</button>';
	    			}
	    			else if(i_status == -3) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-hand-paper-o"></i> Expired</button>';
	    			}
	    			else if(i_status == 1) {
	    				issue_status = '<button type="button" class="btn btn-warning btn-sm"><i class="fa fa-refresh"></i> Active</button>';
	    				options = '<button status="1" id="issue_renew_button" issue_id="'+issue.issue_id+'" class="btn btn-sm btn-success pull-right"><i class="fa fa-book"></i> Renew</button><button type="button" fine="false" id="issue_receive_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive</button>';
	    			}
	    			else if(i_status == 2) {
	    				issue_status = '<button type="button" class="btn btn-primary btn-sm"><i class="fa fa-calendar-times-o"></i> Received Without Fine</button>';
	    				options = '<button type="button" fine="true" id="fine_receive_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-hand-o-right"></i> Receive Fine</button>';
	    			}
	    			else if(i_status == 3) {
	    				issue_status = '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Completed</button>';
	    			}
	    			else if(i_status == 0) {
	    				issue_status = '<button type="button" class="btn btn-default btn-sm"><i class="fa fa-thumbs-up"></i> Confirmed but not Issued</button>';
	    				options = '<button type="button" fine="false" id="issue_activate_button" class="btn btn-sm btn-primary pull-right"><i class="fa fa-check"></i> Activate Issue</button>';
	    			}
	    			if(i_status != 0) options = '<a href="'+ site_url +'admin/issue/delete/'+ issue_id +'" class="delete btn btn-sm btn-danger pull-right"><i class="fa fa-trash"></i> Delete</a>' + options +'<div class="clearfix"></div>';
	    			$('#issue_status').html(issue_status);
	    			$('#issue_fine').html(issue.issue_fine);
	    			$('#issue_remarks').html(issue.issue_remarks);
	    			$('#issue_view_modal_footer').html(options);
	    			// Processing Secret Code Display
	    			$('#issue_lend_user_code').html('N/A');
    				$('#issue_receive_user_code').html('N/A');
    				$('#issue_fine_user_code').html('N/A');
    				$('#issue_renew_user_code').html('N/A');

	    			if(i_status != 9 && i_status != 0) {
	    				if(i_status > 0 || i_status == -1) 
			    			$('#issue_lend_user_code').html(issue.issue_lend_user_code);
			    		if(i_status > 1)
		    				$('#issue_receive_user_code').html(issue.issue_receive_user_code);
		    			if(i_status > 2) {
		    				$('#issue_fine_user_code').html(issue.issue_fine_user_code);
		    				$('#issue_renew_user_code').html(issue.issue_renew_user_code);
		    			}
		    		}
	    			$('#issue_receive_admin_code').html(issue.issue_receive_admin_code);
	    			$('#issue_fine_admin_code').html(issue.issue_fine_admin_code);
	    			
	    		}
    	    });
	    });

		// Functions for Issue Receive Operations
		// issue_renew_button
		$(document).on('click', '#issue_renew_button', function() {
			if($(this).attr('status') == -1) $('#renew_alert').removeClass('hide').addClass('show');
			else $('#renew_alert').removeClass('show').addClass('hide');
			var url = site_url + 'admin/issue/renew/' + $(this).attr('issue_id');
			$('#renewModal_form').attr('action', url);
			$('#viewModal').removeClass('show').addClass('hide');
			$('#renewModal').removeClass('hide').addClass('show');
		});

		// $('#renewModal_form').submit(function(event) {
		// 	var renew_code = $('#renew_code_input').val();
			//var url = site_url + 'admin/issue/renew/' + $(this).attr('issue_id');
			// $.post(url, {'issue_renew_user_code':renew_code}, function(data) {
			// 	if(data=='success') {
			// 		showFlash('Successfully Activated Issue', 'success');
			// 		$('#activateModal').removeClass('show').addClass('hide');
			// 	}
			// 	else showFlash(data, 'danger');
			// });
			// event.preventDefault();
		//});
		// issue_receive_with_fine_button

		$(document).on('click', '#issue_receive_with_fine_button', function() {
			$('#fineModal_body').children('.user_details').html(user_details);
			$('#fineModal_body').children('.book_details').html(book_details + '<br /><br ><button id="receive_with_fine_final" href="'+ site_url +'admin/issue/receive/'+issue.issue_id+'/1" class="btn btn-danger btn-lg">Fine: ' + issue.issue_fine+ '<br/><span class="fine_receive_button">Receive with Fine</span></button>');
			var url = site_url + 'admin/issue/receive/' + issue.issue_id;
			$('#receive_issue_final').fadeIn(0);
			$('#receive_issue_final').attr("href", url);
			$('#viewModal').removeClass('show');
			$('#viewModal').addClass('hide');
			$('#fineModal').removeClass('hide');
			$('#fineModal').addClass('show');
		});

		$(document).on('click', '#receive_with_fine_final', function() {
			if(!confirm("Are you sure you received the fine?")) return false;
			var url = $(this).attr('href');
			$.post(url, function(data) {
				if(data=='success') {
					showFlash('Successfully Received', 'success');
					$('#fineModal').removeClass('show');
					$('#fineModal').addClass('hide');
				}
				else showFlash(data, 'danger');
			});
			return false;
		});


		$(document).on('click', '#receive_issue_final', function() {
			if(!confirm("Are you sure?")) return false;
			var url = $(this).attr('href');
			$.post(url, function(data) {
				if(data=='success') {
					showFlash('Successfully Received', 'success');
					$('#fineModal').removeClass('show');
					$('#fineModal').addClass('hide');
				}
				else showFlash(data, 'danger');
			});
			return false;
		});



		// issue_receive_button
		$(document).on('click', '#issue_receive_button', function() {
			$('#fineModal_body').children('.user_details').html(user_details);
			$('#fineModal_body').children('.book_details').html(book_details + '<br />');
			var url = site_url + 'admin/issue/receive/' + issue.issue_id;
			$('#receive_issue_final').fadeIn(0);
			$('#receive_issue_final').attr("href", url);
			$('#viewModal').removeClass('show');
			$('#viewModal').addClass('hide');
			$('#fineModal').removeClass('hide');
			$('#fineModal').addClass('show');
		});

		// fine_receive_button
		$(document).on('click', '#fine_receive_button', function() {
			$('#fineModal_body').children('.user_details').html(user_details);
			$('#fineModal_body').children('.book_details').html(book_details + '<br /><br ><button id="receive_with_fine_final" href="'+ site_url +'admin/issue/receive/'+issue.issue_id+'/1" class="btn btn-danger btn-lg">Fine: ' + issue.issue_fine+ '<br/><span class="fine_receive_button">Receive Fine</span></button>');
			$('#receive_issue_final').fadeOut(0);
			$('#viewModal').removeClass('show');
			$('#viewModal').addClass('hide');
			$('#fineModal').removeClass('hide');
			$('#fineModal').addClass('show');
		});

		// Functions for Issue Activation Operation
		// issue_activate_button
		$(document).on('click', '#issue_activate_button', function() {
			$('#viewModal').removeClass('show').addClass('hide');
			$('#activateModal').removeClass('hide').addClass('show');
			var url = site_url + 'admin/issue/activate/' + issue.issue_id;
			$('#activateModal_form').attr('action', url);
		});

		$('#activateModal_form').submit(function(event) {
			var lend_code = $('#lend_code_input').val();
			var ac_no = $('#issue_book_copy_accession_no_input').val();
			var url = site_url + 'admin/issue/activate/' + issue.issue_id;
			$.post(url, {'issue_lend_user_code':lend_code, 'issue_book_copy_accession_no':ac_no}, function(data) {
				if(data=='success') {
					showFlash('Successfully Activated Issue', 'success');
					$('#activateModal').removeClass('show').addClass('hide');
				}
				else showFlash(data, 'danger');
			});
			event.preventDefault();
		});

	    <?php } ?>
	});
</script>