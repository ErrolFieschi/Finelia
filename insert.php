<?php
ini_set('display_errors', 1);
require_once __DIR__ . '/config/DatabasseManager.php';
require_once __DIR__ . '/select.php';


function secureData($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$reqClasses = specialClasses($_GET['classes']);
while ($result= $reqClasses->fetch(PDO::FETCH_ASSOC)) {
    $fk_matiere = $result['id'];
}

$notation[] = ($_POST['mark']);
$coef = $_GET['coef'];

$reqStudent = selectStudent();
while($student = $reqStudent->fetch(PDO::FETCH_ASSOC)){
    $std[] = $student['id'];
}
$year = "2020-10-10";

foreach ($notation as $item){
    $j = 0;
    foreach ($item as $i){
        $row[] = "(" . $coef . "," . $i . ","  . $fk_matiere . "," . $std[$j] .  ','. "'" . $year . "'" . ')';
        $j++;
    }
}

$sqlReq = implode(",",$row);

$dbManager = new DatabasesManager();
$insMarks = $dbManager->getPdo()->prepare("INSERT INTO note (coef,value,fk_matiere,fk_etudiant,year) VALUES " . $sqlReq . ";");
$insMarks->execute();

header('Location: preForm.php?success=ok');
exit();

//echo $sqlReq;
//echo "<br>" . $fk_matiere ."<br>" . $coef;
