<?php
require_once(__DIR__ . '/general/db_connect.php');
require_once('config/config.php');

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if (valide_data($username) && valide_data($password)) {
    try {
        $db_access = db_connect();
        $request = $db_access->prepare('SELECT COUNT(*) AS check_entry FROM users WHERE username = ?');
        $request->execute(array($username));
        $data_fetch = $request->fetch();

        if (0 !== intval($data_fetch['check_entry'])) {
            echo 'Cet identifiant est déjà utilisé. Veuillez en choisir un autre';
        } else {
            $request = $db_access->prepare('INSERT INTO users(username, password) VALUES(?,?)');
            $request->execute(array($username, $password));
            $data_fetch = $request->fetch();            
            echo 'Votre compte a été crée';
        }

    } catch (PDOException $error_pdo) {
        print('Erreur lors de la création de donnée dans la table : <br/>' . $error_pdo->getMessage());
    }
} else {
    if (isset($username) && empty($username) && !isset($_SESSION['username'])) {
        $err_username = 'Veuillez renseigner votre identifiant';
    }
    if (isset($password) && empty($password) && !isset($_SESSION['username'])) {
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