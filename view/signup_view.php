<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Inscription</title>
</head>
<body>
<?php include_once('general/nav.php'); ?>

    <h1>Création de compte</h1>
    <form method="POST" action="/inscription">
        <label for="username">Identifiant</label>
        <input type="text" name="username">
        <?php echo $err_username; ?>
        <br/>
        <label for="password">Mot de passe</label>
        <input type="password" name="password">
        <?php echo $err_password; ?>
        <br/>
        <input type="submit" value="Créer le compte">
    </form>
    <?php
        //Envoi des infos a cette même page pour afficher un message de validation et un bouton vers l'accueil
    ?>

    <?php include_once('general/footer.php'); ?>
</body>
</html>