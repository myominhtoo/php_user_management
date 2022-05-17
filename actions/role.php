<?php   
    include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    if(isset($_GET['id']) || isset($_GET['role'])){
        $table = new UsersTable(new MySQL());

        $status = $table->changeRole($_GET['id'],$_GET['role']);

        if($status){
            HTTP::redirect("/admin.php","success=true&msg=Successfully Changed!");
        }else{
            HTTP::redirect("/admin.php","success=false&msg=Unchanged Data!");
        }
    }