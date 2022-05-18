<?php
    include("../vendor/autoload.php");

    use Helpers\HTTP;
    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    if(isset($_POST)){
        $table = new UsersTable(new MySQL());

        $email = $_POST['email'];
        $password = $_POST['password'];

        $status = $table->findByEmailAndPassword($email,md5($password));

        if($status){
            session_start();
       
            $user = [
                "id" => $status->id,
                "name" => $status->name,
                "phone" => $status->phone,
                "address" => $status->address,
                "email" => $status->email,
                "role" => $status->role,
                "suspend" => $status->suspend,
                "photo" => $status->image,
                "created_at" => $status->created_at,
            ];

            if($user['suspend'] === 1){
                HTTP::redirect("/index.php","error=true&msg=Your account was blocked!&email=$email&password=$password");
            }

            $_SESSION['user'] = $user;
            
            if($user['role'] === "Admin" || $user['role'] === "Manager" || $user['role'] === "Lead"){
                 HTTP::redirect("/admin.php");
            }
            else{
                 HTTP::redirect("/profile.php");
            }
        }else{
            $data = [
                "email" => $_POST['email'],
                "password" => $_POST['password']
            ];
            HTTP::redirect("/index.php","error=true&msg=Invalid email or password!&email=$email&password=$password");
        }

    }