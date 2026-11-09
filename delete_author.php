<?php

require "connection.php";

$authorId = $_POST['author'] ?? null;
$bookId = $_POST['id'] ?? null;

$stmt = $pdo->prepare('
    DELETE FROM book_authors
    WHERE book_id = :book_id AND author_id = :author_id
');

$stmt->execute([
    'book_id'   => $bookId,
    'author_id' => $authorId,
]);

header("Location: book.php?id=$bookId&update=success");