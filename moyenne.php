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
        <th scope="col">ECTS</th>
        <th scope="col">MOYENNE</th>
    </tr>
    </thead>
    <?php
    $req = selectStudent();
    while ($result = $req->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <tbody>
    <tr>
        <th scope="row"><a href="personalSum.php?<?= $result['id'] ?>"><?= $result["lastname"] ?></a></th>
        <td><?= $result["name"] ?></td>
        <td>0</td>
        <td><?php
           echo sumCalcul($result['id']);
            ?></td>
    </tr>
    <?php
    } ?>
    </tbody>
</table>