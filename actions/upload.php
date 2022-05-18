<?php 
    include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;
    use Helpers\Auth;
    use Helpers\UpdateSession;

    $auth = Auth::check();

    if(isset($_GET) || isset($_POST)){
      $upload = $_FILES['photo'];

      $target = "./photos/".$upload['name'];
      $type = $upload['type'];  

      if(!$upload['error'] && ($type === "image/jpg" || $type === "image/jpeg" || $type === "image/png")){

          $table = new UsersTable(new MySQL());
          $status = $table->uploadImage($auth['id'],$upload['name']);

          if($status){
            move_uploaded_file($upload['tmp_name'],$target);
            session_start();
            $updater = new UpdateSession($auth['id']);
            $updater->update();
            HTTP::redirect("/profile.php","success=true&msg=Successfullly Uploaded!");       
          }else{
            HTTP::redirect("/profile.php","error=true&msg=Error occured in uploading!");
          }
      }else{
          HTTP::redirect("/profile.php","error=true&msg=Error occured in uploading!");
      }
    }