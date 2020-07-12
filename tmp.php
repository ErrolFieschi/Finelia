<?php
ini_set('display_errors', 1);

$notation[] = ($_POST['mark']);
$langage = 1;
$coef = 2;

foreach ($notation as $item){
    foreach ($item as $i){
        $row[] = "(" . $langage . "," . $coef . ","  . $i . ")";
    }
}

echo "insert into note (coef,value,fk,fk) VALUES " . $row[0];
echo $row[1] . "<br>";

$sqlReq = implode(",",$row);
echo $sqlReq;


// echo "insert into note (coef,value,fk,fk)" . 'VALUES' . '(' . $sqlReq . ')';


