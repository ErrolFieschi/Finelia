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
    if($sum->rowCount() != 0) {
        while ($moy = $sum->fetch(PDO::FETCH_ASSOC)) {
            $sumResult += $moy['coef'] * $moy['value'];
            $moyCoef += $moy['coef'];
        }
        $sumResult /= $moyCoef ;
        return round($sumResult, 2);
    }else{
        return "aucune note";
    }
}

function personalMarks($id){
    $dbManager = new DatabasesManager();
    $marks = $dbManager->getPdo()->prepare("SELECT * FROM note WHERE fk_etudiant = ? ORDER BY fk_matiere");
    $marks->execute([$id]);
    return $marks;
}