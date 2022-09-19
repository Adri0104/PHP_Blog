<?php
$dns = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=localhost;dbname=blog;';
$user = 'root';
$pwd = 'root';

try {
    $pdo = new PDO($dns, $user, $pwd, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    throw new Exception($e->getMessage());
}

return $pdo;