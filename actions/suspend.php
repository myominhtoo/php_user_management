<?php 
    include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $table = new UsersTable(new MySQL());
        $status = $table->suspend($id);

        if($status){
            HTTP::redirect("/admin.php","success=true&msg=Successfully Changed!");
        }else{
            HTTP::redirect("admin.php","success=false&msg=Error Occured!");
        }
    }