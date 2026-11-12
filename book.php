<?php

require "connection.php";

$id = $_GET['id'] ?? null;

$isDeleted = $_GET['delete'] ?? null;

$bookStmt = $pdo->prepare('SELECT id, title, release_date, cover_path, language, summary, price, stock_saldo, pages, type FROM books WHERE id = :id');
$bookStmt->execute(['id' => $id]);
$book = $bookStmt->fetch();

$authorStmt = $pdo->prepare(
    'SELECT a.first_name, a.last_name
     FROM book_authors ba
     JOIN authors a ON ba.author_id = a.id
     WHERE ba.book_id = :id'
);

if (!$book) {
    http_response_code(404);
    exit('Book not found.');
}



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
        <button onclick="window.location.href='index.php'">Back</button>
        <h1><?= $book['title'] ?></h1>
        <h3>ID: <?= $book['id'] ?></h3>
        <h2>Authors:</h2>

        <ul>
            <?php foreach ($authors as $author) { ?>
                <li><?= $author['first_name'] ?> <?= $author['last_name'] ?></li>
            <?php } ?>
        </ul>

        <img src="<?= $book['cover_path'] ?>">
        <p><?= $book['summary'] ?></p>
        <p><?= $book['language'] ?></p>
        <p><?= round($book['price'], 2)."€" ?></p>
        <a href="change.php?id=<?= $book['id'] ?>">Change</a>
    </body>
</html>