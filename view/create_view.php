<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Créer un article</title>
</head>
<body>
    <?php include_once('general/nav.php'); ?>

    <?php echo $msg_err ?>

    <form method="POST" action="/creation">
        <label for="title">Titre</label>
        <br/>
        <input type="text" name="title"/>
        <br/><br/>
        <label for="category">Catégorie</label>
        <br/>
        <input type="text" name="category"/>
        <br/><br/>
        <label for="content">Corps</label>
        <br/>
        <textarea name="content"></textarea>
        <br/>
        <input type="submit" value="Valider">
    </form>


    <?php include_once('general/footer.php'); ?>    
</body>
</html>