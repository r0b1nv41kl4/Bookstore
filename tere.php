<?php

print("Hello, World!");

require 'connection.php';

$stmt = $pdo->query('SELECT id, title FROM books');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
</head>
<body>
    <ul>
    <?php while ($book = $stmt->fetch())
{ ?> 
    <li>
   <a href="book.php?id=<?= $book['id'] ?>">
    <?= $book['title']; ?>
    </li>
<? } ?>
    </ul>
</body>
</html>
