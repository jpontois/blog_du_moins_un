<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$username   = $_SESSION['username'];
$title      = htmlspecialchars($_POST['title']);
$category   = htmlspecialchars($_POST['category']);
$content    = htmlspecialchars($_POST['content']);
$image      = NULL;
$idArticle  = htmlspecialchars($_POST['idArticle']);
$isModified = $_POST['isModified'];

$db_access = db_connect();

if (valide_data($title) && valide_data($category) && valide_data($content) && isset($_SESSION['username']) && isset($isModified)) {

    try {
        $request = $db_access->prepare('
            UPDATE posts
            SET
                title = ?,
                idCategory = (SELECT id FROM categories WHERE name = ?),
                content = ?,
                imagePath = ?
            WHERE id = ?
        ');

        $request->execute(array($title, $category, $content, $image, $idArticle));

        $msg_info = 'Votre article a été mis à jour';

    } catch (PDOException $error_pdo) {
        $msg_info = 'Erreur lors de la mise à jour des données dans la table : <br/>' . $error_pdo->getMessage();
    }

} else {

    if (!isset($username)) {
        $msg_info = 'Veuillez vous connecter pour publier un article';
    } else {
        if (isset($isModified)) {
            $msg_info = 'Veuillez renseigner tous les champs';
        }
    }
}

$request = $db_access->prepare('
    SELECT name AS category
    FROM categories
');

$request->execute(array($quelquechose));


function valide_data ($data_to_check)
{
    if (isset($data_to_check) && !empty($data_to_check)) {
        return 1;
    };
    
    return 0;
}