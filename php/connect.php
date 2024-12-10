<?php
try{
    // Connexion à la base de données du resto (db_resto)
    $db = new PDO('mysql:host=localhost;dbname=db_resto', 'root', '');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}
