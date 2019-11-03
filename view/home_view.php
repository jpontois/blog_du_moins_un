<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet">
    <title>Accueil</title>
</head>

<body>
    <?php include_once('general/nav.php'); ?>

    <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="edition">Créer un article</a>';
        }
    ?>
    
    <section class="sec">
        <?php
            while ($data_fetch = $request->fetch()) {

                $id         = $data_fetch['id'];
                $title      = $data_fetch['title'];
                $category   = $data_fetch['category'];
                $username   = $data_fetch['username'];
                $image      = $data_fetch['image'];

                echo <<< EOT
                    <article>
                        <a href="/article/$id">
                            <h2>$title</h2>
                            <p>$username - $category </p>
                        </a>
                    </article>
EOT;
            }
        ?>
    </section>

    <?php include_once('general/footer.php'); ?>    
</body>
</html>