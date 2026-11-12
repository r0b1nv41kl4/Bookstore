<?php

require "connection.php";

$bookId = $_POST['id'] ?? null;

$stmt = $pdo->prepare('
    DELETE FROM books
    WHERE book_id = :book_id
');

$stmt->execute([
    'book_id'   => $bookId,
]);

header("Location: book.php?id=$bookId&update=success");