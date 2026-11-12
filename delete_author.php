<?php

require 'connection.php';

$bookId = $_POST['id'] ?? null;
$bookAuthorId = $_POST['book-author-id'] ?? null;


$stmt = $pdo->prepare('DELETE FROM book_authors WHERE id = :id');
$stmt->execute(['id' => $bookAuthorId]);

header("Location: book.php?id=$bookId&delete=success");













