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