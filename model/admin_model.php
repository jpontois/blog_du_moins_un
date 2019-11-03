<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

try {
    $db_access = db_connect();
// --------------------------------------------------------------------------------

    $delete = $_POST['delete'];
    if (isset($delete)) {
        $request = $db_access->prepare('
            SELECT COUNT(*) AS check_entry
            FROM posts
            WHERE idCategory = ?
        ');

        $request->execute(array($delete));
        $data_fetch = $request->fetch();

        if (0 === intval($data_fetch['check_entry'])) {

            $request = $db_access->prepare('
                DELETE FROM categories
                WHERE id = ?
            ');
        } else {
            $msg_info = 'Cette catégorie est utilisé dans certains articles publiés. Veuillez d\'abord mettre a jour ces articles pour finaliser cette opération';
        }

        $request->execute(array($delete));
    }
// --------------------------------------------------------------------------------

$newCategory = $_POST['newCategory'];

if (isset($newCategory)) {
    $request = $db_access->prepare('
        INSERT INTO categories(name)
        VALUES(
            ?
        )
    ');

    $request->execute(array($newCategory));
}

// --------------------------------------------------------------------------------

$requestCategory = $db_access->prepare('
SELECT name AS category, id
FROM categories
');

$requestCategory->execute();

$category   = $data_fetch['category'];


} catch (PDOException $error_pdo) {
    $msg_info = 'Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage();
}