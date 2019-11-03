<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

if (isset($_SESSION['username'])) {
    $isLogged = 1;
}

try {

    $db_access = db_connect();

    $request = $db_access->prepare('
        SELECT posts.id AS idArticle, imagePath AS image, title, content, categories.name AS category, username
        FROM posts
        JOIN users ON idUser = users.id
        JOIN categories ON idCategory = categories.id
        WHERE posts.id = ?
    ');

    $request->execute(array($idArticle));
    $data_fetch = $request->fetch();

    $title      = $data_fetch['title'];
    $category   = $data_fetch['category'];
    $username   = $data_fetch['username'];
    $image      = $data_fetch['image'];
    $content    = $data_fetch['content'];

    $comment = $_POST['comment'];

    if (1 === $isLogged && isset($comment) && !empty($comment)) {
        $request = $db_access->prepare('
            INSERT INTO comments(content, idPost)
            VALUES(
                ?,
                ?
            )
        ');

        $request->execute(array($comment, $idArticle));
    }

    $delete = $_POST['delete'];

    if (1 === $isLogged && isset($delete)) {
        $request = $db_access->prepare('
            DELETE FROM comments
            WHERE id = ?
        ');

        $request->execute(array($delete));
    }

    $request_comment = $db_access->prepare('
        SELECT content, id
        FROM comments
        WHERE idPost = ?
    ');

    $request_comment->execute(array($idArticle));

} catch (PDOException $error_pdo) {
    $msg_info = 'Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage();
}

function checkArticleExist (int $idToCheck) {
    $db_access = db_connect();

    $request = $db_access->prepare('
        SELECT COUNT(*) AS check_entry
        FROM posts
        WHERE id = ?
    ');

    $request->execute(array($idToCheck));
    $data_fetch = $request->fetch();
    return $data_fetch['check_entry'];
}