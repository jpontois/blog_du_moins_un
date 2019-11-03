    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <?php
                if (isset($_SESSION['username'])) {
                    echo '<li><a href="/deconnexion">Déconnexion</a></li>';
                    if ('admin' === $_SESSION['username']) {
                        echo '<li><a href="/admin">Espace admin</a></li>';
                    }
                    echo '<li>Connecté en tant que <b>' . $_SESSION['username'] . '</b></li>';
                } else {
                    echo '<li><a href="/connexion">Connexion</a></li>';
                    echo '<li><a href="/inscription">Inscription</a></li>';
                }
            ?>
        </ul>
    </nav>