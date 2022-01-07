<?php

/*
*Class Database 
*/
class Database{
    private $db_name = 'keep_track';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_host = 'localhost';
    private $db_port = '3307';
    public $pdo;


    public function getDatabaseConnexion() {
        try {
            if ($this->pdo === null) {
                $pdo = new PDO('mysql:host=' . $this->db_host .';dbname=' . $this->db_name . '; port=' . $this->db_port, $this->db_user, $this->db_pass);
                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $this->pdo = $pdo;
            }
            return $this->pdo;

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    
    }

    /*
    *@param $datas string entry's datas to clean
    *@return string
    */
    public function valid_datas($datas){
        $datas = trim($datas);
        $datas = stripslashes($datas);
        $datas = htmlspecialchars($datas);
        return $datas;
    }
}