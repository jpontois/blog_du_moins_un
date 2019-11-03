<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Espace Administration</title>
</head>
<body>
    <?php include_once('general/nav.php'); ?>

    <?php echo $msg_info ?>

    <h1>Espace admin</h1>
    <h2>Gestion des catégories</h2>

    <?php
        while ($data_fetch = $requestCategory->fetch()) {

            $category = $data_fetch['category'];
            $idCategory = $data_fetch['id'];

            echo <<< EOT
                <form method="POST" action="/admin">
                    <label>$category</label>
                    <input name="delete" value="$idCategory" type="hidden">
                    <input value="Supprimer" type="submit">
                </form>
                <br/>
EOT;
        }
    ?>

    <form method="POST" action="/admin">
        <input type="text" name="newCategory">
        <input type="submit" value="Ajouter une nouvelle catégorie">
    </form>


    <?php include_once('general/footer.php'); ?>
</body>
</html>