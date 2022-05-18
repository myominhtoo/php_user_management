<?php 
    include("../vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\HTTP;
    use Helpers\Auth;
    use Helpers\UpdateSession;

    $auth = Auth::check();

    if(isset($_GET) || isset($_POST)){
       $fileName = "";
       $target = "";
       $shouldWrite = true;// if did not update image , to be able to store original and doesn't not write any more
       $success = false;

       $file = $_FILES['photo'];

       if($file['size']  > 0){
           $fileName = $file['name'];
           $target = "./photos/$fileName";
           $shouldWrite = false;
       }
    
       //to check , file does not include , will set the previous name
       if($fileName == ""){
           $fileName = $auth['photo'];
           $shouldWrite = false;
       }       

       $table = new UsersTable(new MySQL());
       //for email check
       $user = $table->findByEmail($_POST['email']);

       if(!$user || ($user && $user->email == $auth['email'])){
            $status = $table->update($_GET['id'] , $_POST['name'] , $_POST['email'] , $_POST['phone'] , $_POST['address'] , $fileName);

            if($shouldWrite){
                move_uploaded_file($file['tmp_name'],$target);
                if(unlink("./photos".$auth['photo'])){
                    $success = true;
                }
            }
    
            if($success || $status){
                session_start();
                $updater = new UpdateSession($auth['id']);
                $updater->update();
                HTTP::redirect("/profile.php","success=true&msg=Successfullly Updated!");       
            }else{
                HTTP::redirect("/profile.php","error=true&msg=Error Occured");       
            }   
       }else{
            HTTP::redirect("/profile.php","error=true&msg=Duplicate email error!");       
       }
    }