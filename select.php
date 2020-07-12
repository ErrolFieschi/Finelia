<?php
require_once __DIR__ . '/config/DatabasseManager.php';


function selectStudent()
{
    $dbManager = new DatabasesManager();
    $std = $dbManager->getPdo()->prepare("SELECT * FROM etudiant");
    $std->execute();
    return $std;
}

function selectClasses(){
    $dbManager = new DatabasesManager();
    $cls = $dbManager->getPdo()->prepare("SELECT * FROM matiere");
    $cls->execute();
    return $cls;
}

function specialClasses($name){
    $dbManager = new DatabasesManager();
    $scls = $dbManager->getPdo()->prepare("SELECT * FROM matiere WHERE name = ?");
    $scls->execute([$name]);
    return $scls;
}

function sumCalcul($id){
    $dbManager = new DatabasesManager();
    $sumResult = 0;
    $moyCoef = 0;
    $sum = $dbManager->getPdo()->prepare("SELECT coef,value FROM note WHERE fk_etudiant = ?");
    $sum->execute([$id]);
    while ($moy = $sum->fetch(PDO::FETCH_ASSOC)){
        $sumResult += $moy['coef'] * $moy['value'];
        $moyCoef += $moy['coef'];
    }
    $sumResult /= ($sum->rowCount() + $moyCoef);
    return round($sumResult,2);
}