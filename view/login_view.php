<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
    <?php include_once('general/nav.php'); ?>

    <?php echo $msg_info ?>

    <?php
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $content = <<< EOT
                <h1>Connexion réussi, bienvenu $username</h1>
                <a href="/">Retour à l'accueil</a>
EOT;
        } else {
            $content = <<< EOT
                <h1>Connexion</h1>
                <form method="POST" action="/connexion">
                    <label for="username">Identifiant</label>
                    <input type="text" name="username">
                    $err_username
                    <br/>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password">
                    $err_password
                    <br/>
                    <input type="hidden" name="hadTry" value="1">
                    <input type="submit" value="Se connecter">
                </form>
EOT;
        }
        echo $content;
    ?>
    <?php include_once('general/footer.php'); ?>
</body>
</html>