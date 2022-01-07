<?php
include '../connexion/coockies.php';
include '../app/CrudMeal.php';

$meals = new Meals;
$userid = $userinfo['id'];
$userName = $userinfo['userName'];

if (isset($_POST['meal'], $_POST['kal'])) {
    $meal = $_POST['meal'];
    $kal = $_POST['kal'];
    // echo $userName . ", l'utilisateur n°" . $userid . " a consommé/e " . $kal . " calories, au repas " . $meal;

    $meals->updateMeal($userid, $meal, $kal);
    
    echo'<script>alert("Repas enregistré." );window.location.href = "../public/index.php?p=resume";</script>';
}
?>


<form action="" class="text-center" method="post">
    <h2>Nouvelle entrée</h2>
    <div class="mb-3">
        <label for="meal" class="form-label">Repas</label>
        <select class="form-select" name="meal" id="meal">
            <option value="1">Petit-dejeuner</option>
            <option value="2">Déjeuner</option>
            <option value="3">Souper</option>
            <option value="4">Autre</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="kal" class="form-label">Calories</label>
        <input type="number" class="form-control" name="kal">
    </div>
    <div class="mb-3"> 
        <input type="submit" class="btn btn-danger" value="Soumettre">
    </div>
</form>