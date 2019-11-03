<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$username   = $_SESSION['username'];

if (valide_data($title) && valide_data($category) && valide_data($content) && isset($_SESSION['username'])) {
    try {
        $db_access = db_connect();

        $request = $db_access->prepare('
            INSERT INTO posts(title, idCategory, content, imagePath, idUser)
            VALUES(
                ?,
                (SELECT id FROM categories WHERE name = ?),
                ?,
                ?,
                (SELECT id FROM users WHERE username = ?)
            )
        ');

        $request->execute(array($title, $category, $content, $image, $username));
        $msg_err = 'Votre article a été crée';

    } catch (PDOException $error_pdo) {
        print('Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage());
    }
} else {
    if (!isset($username)) {
        $msg_err = 'veuillez vous connecter pour publier un article';
    } else {
        $msg_err = 'veuillez renseigner tous les champs';
    }
}

function valide_data ($data_to_check)
{
    if (isset($data_to_check) && !empty($data_to_check)) {
        return 1;
    };
    return 0;
}