<?php
include '../app/Crud.php';
if(isset($_POST['userName'])) {
    $name = $_POST['userName'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $activity = $_POST['activity'];
    $password = password_hash($_POST['userPass'], PASSWORD_DEFAULT);
    
    // echo $name . ", ". $gender . ", né le" . $birthday . ", " . $height . "cm, " . $weight . "kg, niveau d'activité physique :" . $activity;
    // echo "<br>";
    
    $users = createUser($name, $gender, $birthday, $height, $weight, $activity, $password);
}
?>

<form action="" method="post">
    <h2>S'inscrire</h2>
    <div class=mb-3>
        <label for="name" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="name" name="userName">
    </div>    
    <div class=mb-3>
        <label for="birthday" class="form-label">Date de naissance :</label>
        <input type="date" class="form-control" name="birthday" id="birthday">
    </div>
    <div class=mb-3>
        <p class="form-label">Sexe :</p>
        <input type="radio" class="col-xs-3" name="gender" id="woman" value=0>
        <label for="gender" class="form-label">Femme</label>
        <input type="radio" class="col-xs-3" name="gender" id="man" value=1>
        <label for="gender" class="form-label">Homme</label>
    </div>
    <div class=mb-3>
        <label for="height" class="form-label">Taille :</label>
        <input type="number" class="form-control" name="height" id="height" min="100" max="220">
    </div>
    <div class=mb-3>
        <label for="weight" class="form-label">Poids :</label>
        <input type="float" class="form-control" name="weight" id="weight" min=40 max="200">
    </div>
    <div class=mb-3>
        <label for="activity" class="form-label">Activité physique :</label>
        <select class="form-select" name="activity" id="activity">
            <option selected>--select--</option>
            <option value="1.2">Sedentaire</option>
            <option value="1.55">Activité moyenne</option>
            <option value="1.725">Sportif</option>
        </select>
    </div>
    <div class=mb-3>
        <label for="password" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" name="userPass" id="password">
    </div>
    <div class=mb-3> 
        <input type="submit" class="btn btn-danger" value="Soumettre">
    </div>
</form>    