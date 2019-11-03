<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Consultation d'article</title>
</head>
<body>
    <?php include_once('general/nav.php'); ?>

    <?php
        if (1 === $isLogged) {
            echo <<< EOT
                <form method="POST" action="/edition">
                    <input type="hidden" name="idArticle" value="$idArticle">
                    <input type="hidden" name="title" value="$title">
                    <input type="hidden" name="category" value="$category">
                    <input type="hidden" name="content" value="$content">
                    <input type="hidden" name="image" value="$image">
                    <input type="submit" value="Modifier l'article">
                </form>
                <form method="POST" action="/suppression">
                    <input type="hidden" name="idArticle" value="$idArticle">
                    <input type="submit" value="Supprimer l'article">
                </form>
EOT;
        }
    ?>

    <section>
        <h1><?php echo $title ?></h1>
        <p><?php echo $content ?></p>
        <p><?php echo $username ?> - <?php echo $category ?></p>
    </section>

    <?php
        if (1 === $isLogged) {
            $delete = '<input type="submit" value="Supprimer">';
        }

        while ($data_fetch = $request_comment->fetch()) {

            $comment = $data_fetch['content'];
            $idComment = $data_fetch['id'];

            echo <<< EOT
                <form method="POST" action="/article/$idArticle">
                    <label>$comment</label>
                    <input name="delete" value="$idComment" type="hidden">
                    $delete
                </form>
                <br/>
EOT;
        }
    ?>

    <?php
        if ($isLogged) {
            echo <<< EOT
            <form method="POST" action="/article/$idArticle">
                <textarea name="comment"></textarea>
                <br/>
                <input type="submit" value="Publier un commentaire">
            </form>
EOT;
        }
    ?>

    <?php include_once('general/footer.php'); ?>
</body>
</html>