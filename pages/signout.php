<?php
include_once '../connexion/coockies.php';
include '../app/CrudUser.php';
include '../app/CrudMeal.php';

$meals = new Meals;
$user = new User;
$msg = '';

if (isset($_POST['No'])) {
    echo'<script>alert("Retour au résumé" );window.location.href = "../public/index.php?p=resume";</script>';
} elseif (isset($_POST['Yes'])) {
    $meals->deleteAllMeals($userinfo['id']);
    $user->deleteUser($userinfo['id']);
    echo'<script>alert("Compte supprimé." );window.location.href = "../public/index.php?p=deconnexion";</script>';
}
?>

<div class="content">
	<h2>Delete Contact #<?=$userinfo['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Etes vous sure de vouloir supprimer le compte de <?=$userinfo['userName']?>?</p>
    <form action="" method="post">
        <button type="submit" class="btn btn-success" name="Yes" value="Yes">Yes</button>
        <button type="submit" class="btn btn-danger" name="No" value="No">No</button>
    </form>
    <?php endif; ?>
</div>




