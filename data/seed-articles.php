<?php
$articles = json_decode(file_get_contents('./articles.json'), true);

$dns = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;host=localhost;dbname=blog;';
$user = 'root';
$pwd = 'root';

$pdo = new PDO($dns, $user, $pwd);

try {
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$statement = $pdo->prepare('
  INSERT INTO article (
    title,
    category,
    content,
    image
  ) VALUES (
    :title,
    :category,
    :content,
    :image
)');

foreach ($articles as $article) {
    $statement->bindValue(':title', $article['title']);
    $statement->bindValue(':category', $article['category']);
    $statement->bindValue(':content', $article['content']);
    $statement->bindValue(':image', $article['image']);
    $statement->execute();
}