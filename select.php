<?php
require_once __DIR__ . '/config/DatabasseManager.php';
require_once __DIR__ . 'pdo.env';



    $dbManager = new DatabasesManager();
    $std = $dbManager->getPdo()->prepare("SELECT * FROM etudiant");
    $std->execute();


    while ($resultat = $std->fetch(PDO::FETCH_ASSOC)) {

        echo $resultat['id'] . "<br>";
        echo $resultat['name'] . "<br>";
        echo $resultat['prenom'] . "<br>";

    }
