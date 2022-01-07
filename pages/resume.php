<?php
include '../connexion/coockies.php';
include '../app/CrudUser.php';
include '../app/CrudMeal.php';
include '../app/calc.php';

$users = new User;
$meals = new Meals;

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

    <!-- a link a page to change your weight and height -->
    <h2 class="mt-4 text-center"><a href="index.php?p=uuser">Je veux changer mon poids ou ma taille</a></h2>
    <p>ne fonctionne pas resume line 83</p>

    <!-- a grid to keep track of the last entries -->
    <h2 class="mt-4 text-center">Dernières entrées</h2>

    <?php
        include '../app/functionsTable.php';
        $userid = $userinfo['id'];
        $rows = $meals->getAllMeals($userid);
        
        // Table of the last meals
        $headers = ["Enregister le", "Calories", "Repas"];
        printMeals($rows, $headers);

        // Total for the day
        $totals = $meals->getKals($userid);
        
    ?>

    <!-- progress bar-->
    <?php $kalsOfTheDay =  round($totals/$need*100);?>
    <div class="progress "style="height: 30px";>
        <?php if ($totals < $base) {
            echo '<div class="progress-bar bg-success" role="progressbar" style="width:' . $kalsOfTheDay . '%" aria-valuenow=' . $kalsOfTheDay . ' aria-valuemin="0" aria-valuemax="100">' . $totals . ' Calories</div>';
        } elseif ($totals > $base && $totals < $need) {
            echo '<div class="progress-bar bg-warning" role="progressbar" style="width: ' . $kalsOfTheDay . '%" aria-valuenow=' . $kalsOfTheDay . ' aria-valuemin="0" aria-valuemax="100">' . $totals . ' Calories</div>';
        } else {
            echo '<div class="progress-bar bg-danger" role="progressbar" style="width: ' . $kalsOfTheDay . '%" aria-valuenow=' . $kalsOfTheDay . ' aria-valuemin="0" aria-valuemax="100">' . $totals . ' Calories</div>';
        }
        ?>
    </div>

    <!-- New entry-->
    <div class="text-center">
        <h3 class="mt-4 ">Rajouter une entrée </h3>
        <h2><a class="ajout" href="index.php?p=meal">+</a></h2>
    </div>
    

    <!-- sum up the calories by days for the last ten days-->
    <div class="text-center">
        <h2 class="mt-4">Total des calories des derniers jours</h2>
    </div>
    <?php

        $days = $meals->getKalByDay($userid);
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


    // a graphics for the last ten days 
    $dataPoints = array();
    try{
        $handle = $meals->getKalByDay($userid);
        $handle->execute(); 
        $result = $handle->fetchAll(\PDO::FETCH_OBJ);
            
        foreach($result as $row){
            array_push($dataPoints, array("x"=> $row->jour, "y"=> $row->total));
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
            type: "bar", //change type to bar, line, area, pie, etc  
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
<?php

} else {
    echo "<a href='index.php?p=index'>retour</a>";
}






