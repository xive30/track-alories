<?php
require_once 'database.php';

class Meals extends Database{

    // create meals
    function setMeal($meal, $userid, $kal, $date) {
        try {
            $con = $this->getDatabaseConnexion();
            $sql = "INSERT INTO meals(meal, userid, calories, created)
                    VALUES ('$meal', '$userid', '$kal', '$date')";
            $con->exec($sql);
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    // get the last ten meals
    function getAllMeals($userid){
        $con = $this->getDatabaseConnexion();
        $req = "SELECT created, calories,  meal
                FROM meals 
                WHERE userid = '$userid'
                ORDER BY created DESC
                LIMIT 0, 10";
        $rows = $con->query($req);
        return $rows;
    }
    
    // get kals for the last ten days
    function getKalByDay($userid){
        $con = $this->getDatabaseConnexion();
        $req = "SELECT sum(calories) AS total , created AS jour
            FROM meals 
            WHERE userid = '$userid' 
            GROUP BY jour
            ORDER BY jour DESC
            LIMIT 0, 10";
        $rows = $con->query($req);
        return $rows;
    }
    
    // get kals for the day
    function getKals($userid, $now ){
        $con = $this->getDatabaseConnexion();
        $req = "SELECT sum(calories) AS total , created
            FROM meals 
            WHERE userid = '$userid' AND created = '$now'
            GROUP BY created
            ORDER BY created DESC
            LIMIT 0, 1";
        $totals = $con->query($req);
        if ($totals === null){
            return 0;
        }else {
            foreach($totals as $total){
                return $total[0];
            }
        }
    }

    public function deleteAllMeals($id){
        $con = $this->getDatabaseConnexion();
        $sql = "DELETE FROM meals WHERE userid = '$id'";
        $req = $con->prepare($sql);
        $req -> execute();
    }
    // $sql = 'DELETE FROM repas WHERE date <= current_date -11';
}