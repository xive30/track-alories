<?php
include '../connexion/coockies.php';
include '../app/CrudUser.php';

$users = new User;

if(isset($_POST['height'], $_POST['weight'])){
    $height = $user->valid_datas($_POST['height']);
    $weight = $user->valid_datas($_POST['weight']);

    $users->updateuser();
    
    echo'<script>alert("Repas enregistré." );window.location.href = "../public/index.php?p=resume";</script>';
}
?>

<form action="" method="post">
    <h2>changement de poids et taille</h2>
    <div class=mb-3>
        <label for="height" class="form-label">Taille :</label>
        <input type="number" class="form-control" name="height" id="height" min="100" max="220">
    </div>
    <div class=mb-3>
        <label for="weight" class="form-label">Poids :</label>
        <input type="float" class="form-control" name="weight" id="weight" min=40 max="200">
    </div>
    <div class="mb-3"> 
        <input type="submit" class="btn btn-danger" value="Soumettre">
    </div>
</form>