<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$limit = 10;
$offset = 0;

try {
    $db_access = db_connect();

    $request = $db_access->prepare('
        SELECT posts.id AS id, imagePath AS image, title, categories.name AS category, username
        FROM posts
        JOIN users ON idUser = users.id
        JOIN categories ON idCategory = categories.id
        ORDER BY id
        LIMIT 10 OFFSET 0
    ');

    $request->execute(array($limit, $offset));

} catch (PDOException $error_pdo) {
    print('Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage());
}