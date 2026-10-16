<?php

require "connection.php";

$id = $_POST['id'] ?? null;

// var_dump($id);

$stmt = $pdo->prepare('UPDATE books SET title = :title WHERE id = :id;');
$stmt->execute([
    'id' => $id, 
    'title' => $_POST['title']
]);

header("Location: book.php?id=$id&update=success");
exit;