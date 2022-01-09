<?php 


if(isset($_GET['p'])) {
    $p = $_GET['p'];
}else{
    $p = 'home';
}

ob_start();
if ($p === 'home') {
    require '../pages/home.php';
} elseif ($p === 'resume') {
    require '../pages/resume.php';
} elseif ($p === 'meal') {
    require '../pages/meal.php';
} elseif ($p === 'signin') {
    require '../pages/signin.php';
} elseif ($p === 'umeal') {
    require '../pages/updateMeals.php';
} elseif ($p === 'uuser') {
    require '../pages/updateUser.php';
} elseif ($p === 'deconnexion') {
    require '../connexion/deconnexion.php';
} elseif ($p === 'signout') {
    require '../pages/signout.php';
} else {
    require '../pages/home.php';
}
$content = ob_get_clean();
require '../pages/template/default.php';
