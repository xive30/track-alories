<?php
include '../connexion/coockies.php';
include '../app/Crud.php';
include '../app/calc.php';

//DEBUG
// var_dump($userinfo);


if(isset($userinfo)){
    $age = calcAge($userinfo['birthday'], $date);$gender = 0;
    $gender = $userinfo['gender'];
        
    $base = calckal($gender, $userinfo['weight'], $userinfo['height'], $age);
    $need = $base *  $userinfo['activity'];

    // review informations of the connected personne
?>
<div border="1" class="text-center">
    <h2 class="mt-4">Résumé</h2>
    <div class="row mb-3">
        <div class="col-4 themed-grid-col">
            <?= $userinfo['userName'];  ?>
        </div>
        <div class="col-4 themed-grid-col">
            <?php 
            if ($gender == 0) {
                echo "Femme";
            } elseif ($gender == 1) {
                echo "Homme";
            } 
            ?>
        </div>
        <div class="col-4 themed-grid-col">
            <?= $age . " ans"; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-6 themed-grid-col">
            <?= $userinfo['height']."cm "; ?>
        </div>
        <div class="col-6 themed-grid-col">
            <?= $userinfo['weight']."kg"; ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col themed-grid-col">
        <?php 
        echo "Niveau d'activité = ";
        if ($userinfo['activity'] == 1.2) {
            echo "Sédentaire";
        } elseif ($userinfo['activity'] == 1.55) {
            echo "Activité moyenne";
        } elseif ($userinfo['activity'] == 1.725) {
            echo "Sportif";
        }
        ?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col themed-grid-col">
            <?= "Vous avez un IMC de ".calcImc($userinfo['height'], $userinfo['weight']); ?>
        </div>
    
    </div>
    <div class="row mb-3">
        <div class="col-md-6 themed-grid-col">
            <?= "Métabolisme de base : ". $base . "kcal"; ?>
        </div>
        <div class="col-md-6 themed-grid-col">
            <?= "Besoin en calories : " . $need . "kcal"; ?>
        </div>
    </div>
</div>

<hr>
<h2 class="mt-4 text-center">Dernières entrées</h2>

<?php
    include '../app/functionsTable.php';
    $userid = $userinfo['id'];
    $rows = getAllMeals($userid);
    
    // Table of the last meals
    $headers = ["Enregister le", "Calories", "Repas"];
    printMeals($rows, $headers);

    // Total for the day
    $totals = getKals($userid);
    
?>

<div class="progress "style="height: 30px";>
    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <?= $totals. " Calories "; ?></div>
    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
</div>

<div class="text-center">
    <h3 class="mt-4 ">Rajouter une entrée </h3>
    <h2><a class="ajout" href="index.php?p=meal">+</a></h2>
</div>

<div class="text-center">
    <h2 class="mt-4">Total des calories des derniers jours</h2>
</div>
<?php

    $days = getKalByDay($userid);
    // Table of kals by day
    $headers = ["total", "jour"];
    printMeals($days, $headers );
    // var_dump($days);
    // echo "<br><br>";
    // foreach($days as $day){
    //     $i = 0;
    //     var_dump($day[$i]);
    //    $i++;
    // }

} else {
    echo "<a href='index.php?p=index'>retour</a>";
}







$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{

	$con = getDatabaseConnexion();
    $handle = $con->prepare("  SELECT sum(calories) AS total , DATE_FORMAT(created, '%d/%m/%Y') AS jours
                                FROM meals 
                                WHERE userid = '$userid' 
                                GROUP BY DATE_FORMAT(created, '%d/%m/%Y')
                                LIMIT 0, 10"); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->jours, "y"=> $row->total));
    }
	$con = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	
?>
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "PHP Column Chart from Database"
	},
	data: [{
		type: "pie", //change type to bar, line, area, pie, etc  
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   