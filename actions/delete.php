<?php
    require("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    $table = new UsersTable(new MySQL());

    if(isset($_GET['id'])){
        $status = $table->delete($_GET['id']);

        if($status){
            HTTP::redirect("/admin.php","success=true&msg=Successfully Deleted!");
        }
    }