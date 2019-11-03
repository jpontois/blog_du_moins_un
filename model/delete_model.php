<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$idArticle = $_POST['idArticle'];
$username = $_SESSION['username'];

try {
    if (isset($username)) {
        
        $db_access = db_connect();

        $request = $db_access->prepare('
            DELETE FROM posts
            WHERE id = ?
        ');

        $request->execute(array($idArticle));

        $msg_info = 'Article supprimé avec succés';
    } else {
        $msg_info = 'Veuillez vous connecter pour effectuer cette opération';
    }

} catch (PDOException $error_pdo) {
    print('Erreur lors de la mise à jour des donnée dans la table : <br/>' . $error_pdo->getMessage());
}