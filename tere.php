<?php

print("Hello, World!");

require 'connection.php';

$stmt = $pdo->query('SELECT first_name FROM authors');
while ($row = $stmt->fetch())
{
    echo $row['first_name'] . "\n";
}