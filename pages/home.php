<?php
include '../connexion/coockies.php';
include "../app/CrudUser.php";

$users = new User;

if(isset($_POST['login'], $_POST['pass'])) {
    $name = $_POST['login'];
    $pass = $_POST['pass'];
    
    // DEBUG
    // echo $name . " and " . $pass;

    $users->checkUser($name, $pass);

    header("Location: index.php?p=resume");
}
?>
<h1 class="font-weight-bold text-center">Bienvenue sur Track'alories</h1>

<div class="row  align-items-center custom-line">
    <img src="../public/media/fruits.jpg" class="float-right img-fluid col col-sm-12 col-md-6" alt="fruits">
    <div class="align-middle col col-sm-12 col-md-6">
        <p>Track'alories est une application pour vous aidez à suivre les calories que vous consommez pendant les fêtes !!!</p>
        <p> calculer votre IMC, pour savoir où vous en êtes!</p>
    </div>
</div>
<div class="row  align-items-center custom-line">
    <div class="col col-sm-12 col-md-6">
        <p>Stabiliser votre poids et évitez les effets yo-yo:</p>
        <p> Suivez votre métabolisme de base pour que votre corps fonctionne sans se priver.</p>
        <p>Respectez vos besoins de base pour ne pas grossir.</p>
        <p>Gardez votre profil à jour pour un suivi optimum! </p>
    </div>
    <img src="../public/media/calculette.jpg" class="img-fluid col-sm-12 col-md-6" alt="calc" >
</div>




<?php
if(isset($userinfo)) {
    echo "Bonjour, ". $userinfo['userName'] . " !"; 
}else {
?>
<div class="text-center form-signin card card-selecolor">
    <form action="" method="post">
        <h2 class="h2 mb-3 fw-normal">Se Connecter</h2>
        <div class="bm-3">
            <label for="login" class="form-label">Nom</label>
            <div class="form-floating">
                <input type="text" class="form-control" name="login" id="login" placeholder="Nom">
            </div>
        </div>

        <div class="bm-3">
            <label for="pass" class="form-label">Mot de passe</label>
            <div class="form-floating">
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Mot de passe">
            </div>
        </div>

        <div class="mb-3">
            <button type="submit" class=" btn btn-lg bg-firstcolor" name="formconnection">Se connecter</button>
        </div>

        <p>OU</p>
    </form> 
    
    <div class="mb-3">
        <button class=" btn btn-lg bg-firstcolor" ><a  class="textdeconone" href="../public/index.php?p=signin">S'inscrire</a></button>
    </div>
</div>


<?php } ?>