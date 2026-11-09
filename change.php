<?php

require "connection.php";

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare('SELECT id, title, release_date, cover_path, price, summary, language, pages, stock_saldo, type FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare(
   'SELECT authors.id, authors.first_name, authors.last_name 
    FROM authors 
    JOIN book_authors ON authors.id = book_authors.author_id 
    WHERE book_authors.book_id = :id
');

$stmt->execute(['id' => $id]);
$bookAuthors = $stmt->fetchAll();

$authorStmt = $pdo->prepare(
    'SELECT a.first_name, a.last_name
     FROM book_authors ba
     JOIN authors a ON ba.author_id = a.id
     WHERE ba.book_id = :id'
);
$authorStmt->execute(['id' => $id]);
$authors = $authorStmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button onclick="window.location.href='book.php?id=<?= $book['id'] ?>'">Back</button>
    <form method="post" action="update_book.php">
        <input type='hidden' name='id' value='<?= $id; ?>'/>
         <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?= $book['title'] ?>"><br><br>
    <label for="release_date">Release date:</label>
    <input type="text" id="release_date" name="release_date" value="<?= $book['release_date'] ?>"><br><br>
        <label for="cover_path">Cover path:</label>
    <input type="text" id="cover_path" name="cover_path" value="<?= $book['cover_path'] ?>"><br><br>
        <label for="language">Language:</label>
    <input type="text" id="language" name="language" value="<?= $book['language'] ?>"><br><br>
        <label for="summary">Summary:</label>
    <input type="text" id="summary" name="summary" value="<?= $book['summary'] ?>"><br><br>
        <label for="price">Price:</label>
    <input type="text" id="price" name="price" value="<?= $book['price'] ?>"><br><br>
        <label for="stock_saldo">Stock saldo:</label>
    <input type="text" id="stock_saldo" name="stock_saldo" value="<?= $book['stock_saldo'] ?>"><br><br>
        <label for="pages">Pages:</label>
    <input type="text" id="pages" name="pages" value="<?= $book['pages'] ?>"><br><br>
        <button type='submit'>Submit</button>
    </form>
    </body>
</html>

  <h2>Authors:</h2>
    <h3>Add author:</h3>
        <a for="authors">All authors:</a>
        <form method="post" action="add_author.php">
          <input type="hidden" name="book-authors-id" value="<?= $book['id'] ?>">
        <li>
            <?php foreach ($authors as $author) { ?>
                <input type="hidden" name="id" value="<?= $book['id'] ?>">
                <?=$author['first_name'] . ' ' . $author['last_name'] ?>
            <?php } ?>
        </li>
        <button type="submit">Add</button>
    </form>
      <h3>Remove author:</h3>

    <?php foreach ($authors as $author) { ?>
    <form method="post" action="delete_author.php">
        <li>
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <?=$author['first_name'] . ' ' . $author['last_name'] ?>
            <button type="submit">Remove</button>
        </li>
    </form>
<?php } ?>