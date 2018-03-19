<div class="row">
	<div class="col-sm-12 table-responsive">
		<table class="table table-striped datatable" data-page="books" data-source="<?php echo $source; ?>">
			<thead>
				<tr>
          <th>Code</th>
					<th>Title</th>
					<th>Author(s)</th>
					<th class="narrow_column">Edition</th>
          <th>ISBN</th>
					<th>Publisher</th>
					<th class="narrow_column">Stock</th>
					<th class="narrow_column">Available</th>
          <th class="narrow_column">Online Reading</th>
					<th class="">Options</th>
				</tr>
			</thead>
      <?php if(0) { ?>
			<tbody>
				<?php foreach($books as $key => $book) { ?>
				<tr>
          <td><?php echo $book->book_id; ?></td>
					<td <?php if(!$book->book_status) echo 'style="color:#f00;" title="Inactive"'; ?>><a title="View Issue History for this Book" href="<?php echo site_url().'/user/issue/issue_by_book/'.$book->book_id; ?>"><?php echo $book->book_title; ?></a></td>
					<td>
            <?php
              foreach($book->authors as $a_key => $author) {
                echo '<a title="View All Books by this Author" href="'.$controller.'/book_by_filter/1/'.$author->author_id.'">'.$author->author_name.'</a><br />';
              }
            ?>     
          </td>
					<td><?php echo $book->book_edition; ?></td>
          <td><?php echo $book->book_isbn; ?></td>
					<td><a title="View All Books by this Publisher" href="<?php echo $controller.'/book_by_filter/3/'.$book->publication_id; ?>"><?php echo $book->publication_name; ?></a></td>
					<td><?php echo $book->book_stock; ?></td>
					<td><?php echo $book->book_available; ?></td>
					<td>
            <a title="View Book Details" href="#" book_id="<?php echo $book->book_id; ?>" class="view_book btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>

            <a title="Request for this book" href="<?php echo site_url($module).'/issue/add_issue/book_page/'.$book->book_id; ?>" book_id="<?php echo $book->book_id; ?>" class="issue_book btn btn-xs btn-info"><i class="fa fa-credit-card"></i></a>

            <?php if($book->book_url != NULL) { ?>
            <a target="_blank" title="You can read this book online. Click this button to read this book in a new tab" href="<?php echo site_url($module).'/book/read_online/'.$book->book_id; ?>" book_id="<?php echo $book->book_id; ?>" class="read_book btn btn-xs btn-success"><i class="fa fa-book"></i></a>
            <?php } ?>

            <?php if($book->book_url_unlocked) { ?>
            <a title="Update book url" book_url="<?php echo $book->book_url; ?>" book_id="<?php echo $book->book_id; ?>" class="update_book_url btn btn-xs btn-default">
              <i class="fa fa-refresh"></i>
            <?php } ?>
            </a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
      <?php } ?>
		</table>
	</div>
</div>

<!-- Modal for Viewing Single Book -->
<div id="viewModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
  <form class="lib_form" action="hello.php">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title view_title">Book Title Here</h4>
      </div>
      <div class="modal-body modal-scroll book_view_modal">
          <table class="table table-striped">
            <tr>
              <td>Book Code</td>
              <td class="view_code">Book Code</td>
            </tr>
            <tr>
              <td class="prop_column">Title</td>
              <td class="view_title">Book Title</td>
            </tr>
            <tr>
              <td>ISBN</td>
              <td class="view_isbn">Book ISBN</td>
            </tr>
            <tr>
              <td>Author(s)</td>
              <td class="view_author">
                Author one, two and three
              </td>
            </tr>
            <tr>
              <td>Category(s)</td>
              <td class="view_category">
                One, Two, Three
              </td>
            </tr>
            <tr>
              <td>Publisher</td>
              <td class="view_publication">Book Publisher</td>
            </tr>
            <tr>
              <td>Edition</td>
              <td class="view_edition">Book Edition</td>
            </tr>
            <tr>
              <td>Place of Publication</td>
              <td class="view_place_of_publication">Book Place of Publication</td>
            </tr>
            <tr>
              <td>Year of Publication</td>
              <td class="view_year_of_publication">Book Year of Publication</td>
            </tr>
            <tr>
              <td>Total Pages</td>
              <td class="view_total_pages">Book Total Pages</td>
            </tr>
            <tr>
              <td>Status</td>
              <td class="view_status">Book Status</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td class="view_stock">40</td>
            </tr>
            <tr>
              <td>Available</td>
              <td class="view_available">37</td>
            </tr>
            <tr>
              <td>Remarks</td>
              <td class="view_remarks">Book Remarks</td>
            </tr>
          </table>
          <table class="table table-striped book_copy_details_box">
            <thead>
              <tr>
                <th>Acc. No.</th>
                <th>Copy Type</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
      </div>
      <div class="modal-footer">

      </div>
    </div>
    </form>
  </div>
</div>

<!-- Modal for Viewing Single Copy -->
<div id="viewCopyModal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title view_title">Book Title Here</h4>
      </div>
      <div class="modal-body modal-scroll book_copy_view_modal">
          <table class="table table-striped">
            <tr>
              <td class="prop_column">Accession No.</td>
              <td class="view_accession_no">Book Title</td>
            </tr>
            <tr>
              <td>ISBN</td>
              <td class="view_isbn">Book ISBN</td>
            </tr>
            <tr>
              <td class="prop_column">Title</td>
              <td class="view_title">Book Title</td>
            </tr>
            <tr>
              <td>Edition</td>
              <td class="view_edition">Book Edition</td>
            </tr>
            <tr>
              <td>Author(s)</td>
              <td class="view_author">
                Author one, two and three
              </td>
            </tr>
            <tr>
              <td>Category(s)</td>
              <td class="view_category">
                One, Two, Three
              </td>
            </tr>
            <tr>
              <td>Publisher</td>
              <td class="view_publication">Book Publisher</td>
            </tr>
            <tr>
              <td>Copy Type</td>
              <td class="view_copy_type">Book Copy type</td>
            </tr>
            <tr>
              <td>Year of Publication</td>
              <td class="view_year_of_publication">Book Year of Publication</td>
            </tr>
            <tr>
              <td>Place of Publication</td>
              <td class="view_place_of_publication">Book Place of Publication</td>
            </tr>
            <tr>
              <td>Total Pages</td>
              <td class="view_total_pages">Book Total Pages</td>
            </tr>
            <tr>
              <td>Copy Status</td>
              <td class="view_copy_status">Book Copy Status</td>
            </tr>
            <tr>
              <td>Copy Added By</td>
              <td class="view_copy_manager">Book Copy Manager</td>
            </tr>
            <tr>
              <td>Copy Add Date</td>
              <td class="view_copy_date">Book Copy Add Date</td>
            </tr>
            <tr>
              <td>Price</td>
              <td class="view_copy_price">Book Copy Price</td>
            </tr>
            <tr>
              <td>Source</td>
              <td class="view_copy_source">Book Copy Source</td>
            </tr>
            <tr>
              <td>Copy Remarks</td>
              <td class="view_copy_remarks">Book Copy Remarks</td>
            </tr>
            <tr><td></td><td></td></tr>
            <tr>
              <td>Book Add Date</td>
              <td class="view_add_date">Book Add Date</td>
            </tr>
            <tr>
              <td>Book Status</td>
              <td class="view_status">Book Status</td>
            </tr>
            <tr>
              <td>Book Remarks</td>
              <td class="view_remarks">Book Remarks</td>
            </tr>
            <tr>
              <td>Stock</td>
              <td class="view_stock">40</td>
            </tr>
            <tr>
              <td>Available</td>
              <td class="view_available">37</td>
            </tr>
          </table>
      </div>
      <div id="view_copy_footer" class="modal-footer">
          <a href="#" class="history btn btn-sm btn-primary pull-right"><i class="fa fa-book"></i> Issue History</a>
          <div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Renewing Issue -->
<div id="update_book_url_Modal" class="modal hide" role="dialog">
  <div class="modal-dialog">
    <form id="update_book_url_Modal_form" action="#" method="post">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Book URL</h4>
      </div>
      <div class="modal-body">
          <label class="col-sm-4" for="book_url">Book URL</label>
          <input autofocus="" required="" id="book_url_input" type="text" class="col-sm-8" name="book_url" placeholder="PDF Link or URL from Google Books"/>
          <div class="clearfix"></div><br />
          <div class="alert alert-md alert-success">
              <h5>Most preferable way of inserting online link is from Google Books. <br>Find the book on <a target="_blank" style="color:#ff0; font-family:'Arial';" href="https://books.google.com">books.google.com</a> and insert the book url here.<br><br>You can also insert direct PDF link.</h5>
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-refresh"></i> Update</button>
          <div class="clearfix"></div>
      </div>
    </div>
    </form>
  </div>
</div>
