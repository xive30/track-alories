<?php
require_once 'database.php';

class User extends Database{

    // create new user
    function createUser($name, $gender, $birthday, $height, $weight, $activity, $password) {
        try {
            $con = $this->getDatabaseConnexion();
            $sql = "INSERT INTO users(userName, gender, birthday, height, weight, activity, userPass)
                    VALUES ('$name', '$gender', '$birthday', '$height', '$weight', '$activity', '$password')";
            $con->exec($sql);
        }
        catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    
    // read all info about one user
    function readUser($id) {
        $con = $this->getDatabaseConnexion();
            $req = "SELECT * from users where id = '$id' ";
            $stmt = $con->query($req);
            $row = $stmt->fetchAll();
            if (!empty($row)) {
                return $row[0];
            }
    }
    
    // check if the name and password are equal to one user and get it
    function checkUser($name, $pass) {
        $con = $this->getDatabaseConnexion();
        $req = $con->prepare("SELECT userPass FROM users WHERE userName = ?");
        $req->execute(array($name));
        $userexist = $req->rowCount();
        
        if($userexist == 1) {
            $userinfo = $req->fetch();
            $verifmdp = $userinfo['userPass'];
            
        }
        if(isset($verifmdp) && password_verify($pass, $verifmdp) == TRUE) {
            $requser = $con->prepare("SELECT * FROM users WHERE userName = ?");
            $requser->execute(array($name));
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
    
    public function updateUser($id, $height, $weight){
        $con = $this->getDatabaseConnexion();
        $sql = "UPDATE users SET height='$height', weight='$weight' WHERE id='$id'";
        $req = $con->prepare($sql);
        $req -> execute();
        setcookie ("userinfo", "", time() - 36000);
        $requser = $con->prepare("SELECT * FROM users WHERE id = ?");
        $requser->execute(array($id));
        $userinfo = $requser->fetch();
        setcookie('userinfo',json_encode($userinfo), time()+36000);
        return "changement validé ";
    }      

    public function deleteUser($id){
        $con = $this->getDatabaseConnexion();
        $sql= "DELETE FROM users WHERE id = '$id'";
        $stmt = $con->prepare($sql);
            $stmt->execute();
    }
}    


