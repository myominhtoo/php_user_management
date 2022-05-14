<?php
    namespace Libs\Database;
    
    use PDOException;
    use PDO;

    class MySQL{
        private $db_host;
        private $db_name;
        private $db_user;
        private $db_pass;
        private $db = null;

        public function __construct($db_host = "localhost:3306",$db_name ="php_project" ,$db_user = "lionel", $db_pass ="Mmh28803#"){
            $this->db_host = $db_host;
            $this->db_name   = $db_name;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
        }

        public function connect(){
            try{
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ];
                $this->db = new PDO(
                    "mysql:host=$this->db_host;dbname=$this->db_name",
                    $this->db_user,
                    $this->db_pass,
                    $options
                );
                return $this->db;
            }catch(PDOException $e){
                 return $e->getMessage();
            }
        }
    }
