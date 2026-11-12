<?php

require "connection.php";

$authorId = $_POST['author-id'] ?? null;
$bookId = $_POST['book-id'] ?? null;

$stmt = $pdo->prepare('
    INSERT INTO book_authors (book_id, author_id)
    VALUES (:book_id, :author_id)
');

$stmt->execute([
    'book_id'   => $bookId,
    'author_id' => $authorId,
]);

header("Location: book.php?id=$bookId&update=success");
exit;