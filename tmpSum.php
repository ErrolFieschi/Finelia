<?php
ini_set('display_errors', 1);
include('header.php');
include('select.php');

?>

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
    <tr>
        <th scope="col">NOM</th>
        <th scope="col">PRÉNOM</th>
        <th scope="col">MOYENNE</th>
    </tr>
    </thead>
    <?php
    $req = selectStudent();
    while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <tbody>
    <tr>
        <th scope="row"><a href="personalSum.php?id=<?= $result['id'] ?>"><?= $result["lastname"] ?></a></th>
        <td><?= $result["name"] ?></td>
        <td><?php
            }


            $dbManager = new DatabasesManager();
            $total_coef = 0;
            $moyenne = 0;
            $tmpMoyenne = 0;
            $coefDiv = 0;

            $reqMatiere = $dbManager->getPdo()->prepare("SELECT id,ects FROM matiere");
            $reqMatiere->execute();

            while ($rMatiere = $reqMatiere->fetch()) {
                $total_coef += $rMatiere['ects'];
            }
            $classe = $dbManager->getPdo()->prepare("SELECT id,ects FROM matiere");
            $classe->execute();
            while ($classroom = $classe->fetch()) {

                $idClasses[] = $classroom['id'];
                $ectsMatiere[] = $classroom['ects'];

                }

            $etudiant = $dbManager->getPdo()->prepare("SELECT * FROM etudiant");
            $etudiant->execute();
            while ($reqEtudiant = $etudiant->fetch()) {



                $idStudent = $reqEtudiant['id'];


                for($i=0 ; $i<count($idClasses) ; $i++){

                $idC = $idClasses[$i];


                    $note= $dbManager->getPdo()->prepare("SELECT * FROM note WHERE fk_etudiant = ?  AND fk_matiere = ?  ");
                    $note->execute([$idStudent, $idC]);


                        while ($notation = $note->fetch()) {

                            $moyenne += ($notation['value'] * $notation['coef']);
                            $coefDiv += $notation['coef'];

                        }
                }
                echo  $tmpMoyenne = $moyenne / $coefDiv . "<br>";
                //echo $tmpMoyenne = $moyenne / $coefDiv;

               // echo "<br>";
               // echo $moyenne /= $coefDiv . "<br>";
                //$finish = $toto / $totalCoef;
               // echo $finish . "<br>";
            }

            ?></td>

    </tr>

    </tbody>
</table>