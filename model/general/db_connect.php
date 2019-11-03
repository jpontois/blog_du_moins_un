<?php

require_once('config/config.php');

function db_connect () {
    try {
        return new PDO(
            sprintf('mysql:host=%s;dbname=%s;charset=UTF8',DATABASE_CONFIG['host'],DATABASE_CONFIG['database']),
            DATABASE_CONFIG['user'],
            DATABASE_CONFIG['password']
        );
    } catch (PDOException $error_pdo) {
        print('Erreur lors de la connexion à la base de donnée : <br/>' . $error_pdo->getMessage());
        die();
    }
}