<?php
   
   include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

   if(isset($_POST)){
        $datas = [
            ":name" => $_POST['name'] ?? 'unknown',
            ":email" => $_POST['email'] ?? 'unknown',
            ":phone" => $_POST['phone'] ?? 'unknown',
            ":password" => md5( $_POST['password']) ?? 'unknown',
            ":address" => $_POST['address'] ?? 'unknown',
            ":role_id" => $_POST['role'] ?? 1,
        ];
        
        $table = new UsersTable(new MySQL());

        $user = $table->findByEmail($_POST['email']);

        if(!$user){
           $table->insert($datas);
            HTTP::redirect("/index.php","registered=true");
        }else{
            HTTP::redirect("/register.php","error=true");
        }
   }
