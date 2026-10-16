<?php

require "connection.php";

$id = $_GET['id'] ?? null;

$stmt = $pdo->prepare('SELECT id, title, release_date, cover_path, price, summary, language, pages, stock_saldo, type FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

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
