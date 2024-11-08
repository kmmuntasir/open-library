<title>Books by Category: <?php echo $category->category_name; ?></title>

<h3>Books by Category: <i><?php echo $category->category_name; ?></i></h3>
<p>Total Records: <?php echo count($books) ?></p>


<style type="text/css">
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table td, table th {
        border: solid 1px #000;
    }

</style>

<table>
    <thead>
        <tr>
            <th>Acc. No</th>
            <th>Title</th>
            <th>Author</th>
            <th>Edition</th>
            <th>Publication</th>
            <th>Year</th>
            <th>Place</th>
            <th>Type</th>
            <th>Total Pages</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo $book->ac_no; ?></td>
                <td><?php echo $book->book_title; ?></td>
                <td><?php echo $book->author_name; ?></td>
                <td><?php echo $book->book_edition; ?></td>
                <td><?php echo $book->publication_name; ?></td>
                <td><?php echo $book->book_year_of_pub; ?></td>
                <td><?php echo $book->book_place_of_pub; ?></td>
                <td><?php echo $book->copy_type; ?></td>
                <td><?php echo $book->book_pages; ?></td>
                <td><?php echo $book->book_stock; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
