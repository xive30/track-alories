<?php
require_once 'database.php';

class Meals extends Database{

    // date("jj/mm");

    // create meals
    function setMeal($userid, $meal, $kal) {
        try {
            $con = $this->getDatabaseConnexion();
            $sql = "INSERT INTO meals(userid, meal, calories)
                    VALUES ('$userid','$meal',  '$kal')";
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
        $req = "SELECT sum(calories) AS total , DATE_FORMAT(created, '%d/%m/%Y') AS jour
            FROM meals 
            WHERE userid = '$userid' 
            GROUP BY DATE_FORMAT(created, '%d/%m/%Y')
            ORDER BY jour DESC
            LIMIT 0, 10";
        $rows = $con->query($req);
        return $rows;
    }
    
    // get kals for the day
    function getKals($userid){
        $con = $this->getDatabaseConnexion();
        $req = "SELECT sum(calories) AS total , DATE_FORMAT(created, '%d/%m/%Y') AS jour
            FROM meals 
            WHERE userid = '$userid' 
            GROUP BY DATE_FORMAT(created, '%d/%m/%Y')
            ORDER BY jour DESC
            LIMIT 0, 1";
        $totals = $con->query($req);
        foreach($totals as $total){
            return $total[0];
        }
    }

    public function deleteRepas(){
        $sql = "DELETE FROM repas WHERE date <= current_date -11" ;
        $req = $this->getDatabaseConnexion()->prepare($sql);
        $req -> execute();
    }
}