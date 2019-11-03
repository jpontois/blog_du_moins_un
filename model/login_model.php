<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$hadTry = $_POST['hadTry'];

if (valide_data($username) && valide_data($password)) {
    try {
        $db_access = db_connect();
        $request = $db_access->prepare('
                SELECT COUNT(*) AS check_entry
                FROM users 
                WHERE username = ? AND password = ?
            ');
        $request->execute(array($username, $password));
        $data_fetch = $request->fetch();

        if (0 !== intval($data_fetch['check_entry'])) {
            $_SESSION['username'] = $username;
        } else {
            $msg_info = 'Identifiant ou mot de passe incorrect';
        }

    } catch (PDOException $error_pdo) {
        $msg_info = 'Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage();
    }
} else {
    if (isset($hadTry) && empty($username)) {
        $err_username = 'Veuillez renseigner votre identifiant';
    }
    if (isset($hadTry) && empty($password)) {
        $err_password = 'Veuillez renseigner votre mot de passe';
    }
}

function valide_data ($data_to_check)
{
    if (isset($data_to_check) && !empty($data_to_check)) {
        return 1;
    };
    return 0;
}