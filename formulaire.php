<?php
ini_set('display_errors', 1);
include('header.php');
include('select.php');

$coef = $_POST['coef'];
$classes = $_POST['classes_select'];

if (!empty($_POST['coef']) && isset($_POST['coef']) && !empty($_POST['classes_select']) && isset($_POST['classes_select'])) {
?>

<form method="post" action="insert.php?coef=<?=$coef?>&classes=<?=$classes?>">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col"></th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Note</th>
            <th scope="col">coef</th>
            <th scope="col"><?= $classes ?></th>
        </tr>
        </thead>
        <?php
        $req = selectStudent();
        while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
        ?>
        <tbody>
        <tr>
            <th scope="row"><?= $result["id"] ?></th>
            <td><?= $result["name"] ?></td>
            <td><?= $result["lastname"] ?></td>
            <td>
                <div class="col-2">
                    <input type="text" class="form-control" name="mark[]">
                </div>
            </td>
            <td><?= $coef ?></td>
            <td><?= $classes ?></td>
        </tr>
        <?php
        } ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button type="submit" class="btn btn-primary my-4">Valider</button>
        </td>


        </tbody>

        <?php
        } else {
            header('Location: preForm.php?error=emptyvalue');
            exit();
        }
        ?>
    </table>
</form>