<?php
ini_set('display_errors', 1);
include('select.php');
include('header.php');

$req = selectClasses();

while ($resultat = $req->fetch(PDO::FETCH_ASSOC)) {
    $options[] = $resultat['name'];
}

?>

<div class="card text-center">
    <div class="card-header">

    </div>
    <div class="card-body">
        <form role="form"  method="post" action="formulaire.php?">
            <div class="form-group d-flex justify-content-center">
                <div class="col-4 ">
                    <label>Choix de la matiere</label>
                    <select  class="form-control" name="classes_select">
                        <?php
                        foreach ($options as $opt) {
                            echo '<option  value = "' . $opt . '" >' . $opt . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group d-flex justify-content-center">
                <div class="col-4">
                    <label>Coef</label>
                    <input style="text-align: center;" type="text" class="form-control" name="coef"
                           placeholder="2">
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-4">Valider</button>
        </form>
    </div>


</div>