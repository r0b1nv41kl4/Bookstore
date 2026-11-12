<?php

require "connection.php";

$bookId = $_POST['id'] ?? null;

$stmt = $pdo->prepare('
    UPDATE books
    SET is_deleted = 1
    WHERE id = :id
');

$stmt->execute(['id' => $bookId]);

header("Location: book.php?id=$bookId&delete=success");