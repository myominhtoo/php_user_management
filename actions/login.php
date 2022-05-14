<?php
    include("../vendor/autoload.php");

    use Helpers\HTTP;
    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;

    if(isset($_POST)){
        $table = new UsersTable(new MySQL());

        $status = $table->findByEmailAndPassword($_POST['email'],md5($_POST['password']));

        if($status){
            session_start();
       
            $user = [
                "id" => $status->id,
                "name" => $status->name,
                "email" => $status->email,
                "role" => $status->role
            ];

            $_SESSION['user'] = $user;
            HTTP::redirect("/admin.php");
        }else{
            $data = [
                "email" => $_POST['email'],
                "password" => $_POST['password']
            ];
            HTTP::redirect("/index.php","error=true&data=$data");
        }

    }