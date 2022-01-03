<?php
include '../connexion/coockies.php';
include "../app/Crud.php";

if(isset($_POST['login'], $_POST['pass'])) {
    $name = $_POST['login'];
    $pass = $_POST['pass'];
    
    // DEBUG
    // echo $name . " and " . $pass;

    checkUser($name, $pass);

    header("Location: index.php?p=resume");
}

if(isset($userinfo)) {
    echo "Bonjour, ". $userinfo['userName'] . " !"; 
}else {
?>
<div>
    <p>Track'alories est une application pour vous aidez à suivre les calories que vous consommez pendant les fêtes !!!</p>
</div>
<div class="text-center form-signin">
    <form action="" method="post">
        <h2 class="h2 mb-3 fw-normal">Se Connecter</h2>
        <div class="form-floating">
            <input type="text" class="form-control" name="login" id="login" placeholder="Nom">
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="pass" id="pass" placeholder="Mot de passe">
        </div>
        <div class="mb-3">
            <button type="submit" class="w-100 btn btn-lg btn-danger" name="formconnection">Se connecter</button>
        </div>
        <p>OU</p>
        <div class="mb-3">
            <button class="w-100 btn btn-lg btn-danger" >S'inscrire'</button>
        </div>
    </form> 
</div>


<?php } ?>