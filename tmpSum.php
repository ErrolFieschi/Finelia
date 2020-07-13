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

            $reqTotalCoef = $dbManager->getPdo()->prepare("SELECT id,ects FROM matiere");
            $reqTotalCoef->execute();
            while ($rTotalCoef = $reqTotalCoef->fetch()) {
                $total_coef += $rTotalCoef['ects'];
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

                $reqMatiere = $dbManager->getPdo()->prepare("SELECT id,ects FROM matiere");
                $reqMatiere->execute();

                while ($rMatiere = $reqMatiere->fetch()) {
                    $total_coef += $rMatiere['ects'];

                    $note = $dbManager->getPdo()->prepare("SELECT * FROM note WHERE fk_etudiant = ?  AND fk_matiere = ?  ");
                    $note->execute([$idStudent, $rMatiere['id']]);

                    while ($notation = $note->fetch()) {

                        $info += 1;
                        $moyenne += $notation['value'] * $notation['coef'];
                        $coefDiv += $notation['coef'];

                    }
                    $moyenne += $moyenne * $rMatiere['ects'];
                }
                $info = 0;
                echo $tmpMoyenne = ($moyenne / $coefDiv ) /( $total_coef * 6 ). "<br>";
                $moyenne = 0;
                $coefDiv = 0;
            }

            ?></td>

    </tr>

    </tbody>
</table>