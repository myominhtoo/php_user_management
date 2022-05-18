<?php
    namespace Libs\Database;

    use PDOException;

    class UsersTable{
        private $db = null;

        public function __construct(MySQL $db){
            $this->db = $db->connect();
        }

        public function insert($datas){
            try{
                $query = "INSERT INTO users (name,email,phone,password,address,role_id) 
                          VALUES(:name,:email,:phone,:password,:address,:role_id)";
                $stm =  $this->db->prepare($query);
                $stm->execute($datas);

                return $this->db->lastInsertId();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function getAll(){
            try{    
                $query = "SELECT users.* , roles.name AS role  FROM users LEFT JOIN roles ON users.role_id = roles.id";
                
                $stm = $this->db->prepare($query);
                $stm->execute();

                return $stm->fetchAll();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }

        public function findById(int $id){
            try{
                $stm = $this->db->prepare("SELECT users.*,roles.name AS role FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.id = :id");
                $stm->execute([":id"=>$id]);

                $row = $stm->fetch();

                return $row ?? false;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function findByEmail(string $email){
            try{
                $stm = $this->db->prepare("SELECT users.*,roles.name AS role FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.email = :email");
                $stm->execute([":email"=>$email]);

                $row = $stm->fetch();

                return $row ?? false;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function findByEmailAndPassword(string $email , string $password){
            try{
                $stm = $this->db->prepare("SELECT users.* , roles.name AS role FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.email = :email AND users.password = :password");
                $stm->execute([":email"=>$email , ":password" => $password]);

                $row = $stm->fetch();

                return $row ?? false;
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function delete(int $id){
            try{
                $stm = $this->db->prepare("DELETE FROM users WHERE id = :id");
                $stm->execute([":id"=>$id]);

                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function suspend(int $id){
            try{    
                $stm = $this->db->prepare("UPDATE users SET suspend = 1 WHERE id = :id");
                $stm->execute([
                    ":id" => $id,
                ]);

                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function unSuspend(int $id){
            try{    
                $stm = $this->db->prepare("UPDATE users SET suspend = 0 WHERE id = :id");
                $stm->execute([
                    ":id" => $id,
                ]);

                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function changeRole(int $id , int $role){
            try{
                $stm = $this->db->prepare("UPDATE users SET role_id = :role WHERE id = :id");
                $stm->execute([
                    ":role" => $role,
                    ":id" => $id
                ]);

                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function uploadImage(int $id , string $image){
            try{
                $stm = $this->db->prepare("UPDATE users SET image = :image WHERE id = :id");
                $stm->execute([
                    ":image" => $image,
                    ":id" => $id
                ]);
                
                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }


        //the following  method should not be, args are mush more than need , later will try with obj 
        public function update(int $id , string $name , string $email , string $phone , string $address , string $image){
            try{
                $stm = $this->db->prepare("UPDATE users SET name =:name , email =:email , phone =:phone , address =:address , image =:image WHERE id = :id ");
                $stm->execute([
                    ":name" => $name,
                    ":email" => $email,
                    ":phone" => $phone,
                    ":address" => $address,
                    ":image" => $image,
                    ":id" => $id
                ]);
                return $stm->rowCount();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }