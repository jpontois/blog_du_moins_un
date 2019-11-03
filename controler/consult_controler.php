<?php
require_once('model/consult_model.php');

//intval($idArticle);
if (checkArticleExist($idArticle)) {
    require_once('view/consult_view.php');
} else {
    require_once('view/general/404.php');
}