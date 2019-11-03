<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Modification d'article</title>
</head>
<body>
    <?php include_once('general/nav.php'); ?>

    <?php echo $msg_info ?>

    <form method="POST" action="/edition">
        <label for="title">Titre</label>
        <br/>
        <input type="text" name="title" value="<?php echo $title ?>"/>
        <br/><br/>
        <label for="category">Catégorie</label>
        <br/>

        <select name="category">

            <?php
                while ($data_fetch = $request->fetch()) {
                    $categoryList = $data_fetch['category'];

                    if ($categoryList === $category) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = '';
                    }

                    echo '<option valeur="' . $categoryList . '" ' . $selected . '>' . $categoryList . '</option>';
                }
            ?>
        </select>

        <br/><br/>
        <label for="content">Corps</label>
        <br/>
        <textarea name="content"><?php echo $content ?></textarea>
        <br/>
        <input type="hidden" name="isModified" value="1">
        <input type="hidden" name="idArticle" value="<?php echo $idArticle ?>">
        <input type="submit" value="Valider">
    </form>

    <?php include_once('general/footer.php'); ?>    
</body>
</html>