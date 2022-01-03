<?php

function getDatabaseConnexion() {
    try {
        $user = "root";
        $pass = "root";
        $pdo = new PDO('mysql:host=localhost;dbname=keep_track; port=3307', $user, $pass);
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

}

function getAllUsers() {
    $con = getDatabaseConnexion();
    $req = 'SELECT * FROM users';
    $rows = $con->query($req);
    return $rows;
}

function readUser($id) {
    $con = getDatabaseConnexion();
		$req = "SELECT * from users where id = '$id' ";
		$stmt = $con->query($req);
		$row = $stmt->fetchAll();
		if (!empty($row)) {
			return $row[0];
		}
}

function checkUser($name, $pass) {
    $con = getDatabaseConnexion();
	$req = $con->prepare("SELECT userPass FROM users WHERE userName = ?");
    $req->execute(array($name));
    $userexist = $req->rowCount();
    
    if($userexist == 1) {
        $userinfo = $req->fetch();
        $verifmdp = $userinfo['userPass'];
        
    }
    if(password_verify($pass, $verifmdp) == TRUE) {
        $requser = $con->prepare("SELECT * FROM users WHERE userName = ?");
        $requser->execute(array($pass));
        $userexist = $requser->rowCount();
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            setcookie('userinfo',json_encode($userinfo), time()+36000);
        } else {
            $erreur = "Tous les champs doivent être complétés !";
            echo"$erreur";
            die;
        }
    } else {
         $erreur = '<script>alert("Adresse ou mot de passe érroné");</script>';
         echo"$erreur";
         die;
    }       
}


function createUser($name, $gender, $birthday, $height, $weight, $activity, $password) {
    try {
        $con = getDatabaseConnexion();
        $sql = "INSERT INTO users(userName, gender, birthday, height, weight, activity, userPass)
                VALUES ('$name', '$gender', '$birthday', '$height', '$weight', '$activity', '$password')";
        $con->exec($sql);
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

// function updateUser($id, $name, $gender, $birthday, $height, $weight, $activity, $password) {
//     // A voir
// }

// function DeleteUser() {
//     // A voir
// }


function getAllMeals($userid){
    $con = getDatabaseConnexion();
    $req = "SELECT created, calories,  meal
            FROM meals 
            WHERE userid = '$userid'
            LIMIT 0, 10";
    $rows = $con->query($req);
    return $rows;
}


function getKalByDay($userid){
    $con = getDatabaseConnexion();
    $req = "SELECT sum(calories) AS total , DATE_FORMAT(created, '%d/%m/%Y') AS jour
        FROM meals 
        WHERE userid = '$userid' 
        GROUP BY DATE_FORMAT(created, '%d/%m/%Y')
        LIMIT 0, 10";
    $rows = $con->query($req);
    return $rows;
}

function getKals($userid){
    $con = getDatabaseConnexion();
    $req = "SELECT sum(calories) AS total , DATE_FORMAT(created, '%d/%m/%Y') AS jour
        FROM meals 
        WHERE userid = '$userid' 
        GROUP BY DATE_FORMAT(created, '%d/%m/%Y')
        LIMIT 0, 1";
    $totals = $con->query($req);
    foreach($totals as $total){
        return $total[0];
    }
}

function setMeal($userid, $meal, $kal) {
    try {
        $con = getDatabaseConnexion();
        $sql = "INSERT INTO meals(userid, meal, calories)
                VALUES ('$userid','$meal',  '$kal')";
        $con->exec($sql);
    }
    catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}