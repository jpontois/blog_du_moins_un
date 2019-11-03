<?php
if (isset($_SESSION['username'])) {
    if ('admin' === $_SESSION['username']) {
        require_once('model/admin_model.php');
        require_once('view/admin_view.php');
    } else {
        require_once('view/general/404.php');
    }
} else {
    require_once('view/general/404.php');
}