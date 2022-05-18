<?php
    include("./vendor/autoload.php");
    
    // use Libs\Database\MySQL;
    // use Libs\Database\UsersTable;
    use Helpers\Auth;
    

    $auth = Auth::check();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile <?php echo $auth['name']; ?></title>
    <?php require("./js_css/links.php"); ?>
</head>
<style>

    #cover{
        width:250px;
        height:250px;
        border-radius:2px;
        box-shadow:0 0 0.5px rgba(0,0,0,0.75);
        border-radius:100%;
        border: 0.0001px solid rgba(0,0,0,0.25);
    }

    #plus{
        font-size: 50px;
        font-weight: bold;
        color:rgba(0,0,0,0.75);
    }

    #cover:hover,img:hover{
        cursor:pointer;
    }
    .text{
        color:rgba(0,0,0,0.75);
    }
</style>
<body style="height:100vh;max-height: 100vh;" class="d-flex flex-column justify-content-center align-items-center">
    <?php if(isset($_GET['error'])) :  ?>
        <p class="alert-danger fw-bold p-3"><?php echo $_GET['msg']; ?></p>
    <?php endif ; ?>

    <?php if(isset($_GET['success'])) :  ?>
        <p class="alert-success fw-bold p-3"><?php echo $_GET['msg']; ?></p>
    <?php endif ; ?>

    <main class="card w-75 p-3">
            <header id="header" class="w-100 card-title px-5 py-2 d-flex justify-content-between">
                <h1 class="h2">Users Management</h1>
                <div class="mx-3">
                    <a href="./profile.php" class="text-warning" data-bs-toggle="modal" data-bs-target="#update"><i class="fa-solid fa-gear"></i> Update </a><span>|</span><a href="./actions/logout.php" class="text-danger">Logout</a>
                </div>
            </header>
            <section class="card-body w-100 d-flex justify-content-center align-items-center g-1">
                <div id="profile-image" class="w-50 d-flex justify-content-center">
                    <?php if($auth['photo'] == "") { ?>
                        <div id="cover" class="d-flex justify-content-center align-items-center">
                            <span id="plus" data-bs-toggle="modal" data-bs-target="#upload">+</span>
                        </div>
                    <?php }else{ ?>
                        <img src="./actions/photos/<?php echo $auth['photo']; ?>" style="width:250px;height:250px;border-radius:100%;" alt="">
                    <?php } ?>
                </div>
                <div id="profile-info" class="w-50 d-flex flex-column gap-2">
                    <span class="h5 text fw-bold"><i class="fa-solid fa-user"></i> <?php echo $auth['name'] ?></span>
                    <span class="h5 text fw-bold"><i class="fa-solid fa-envelope"></i> <?php echo $auth['email'] ?></span>
                    <span class="h5 text fw-bold"><i class="fa-solid fa-square-phone"></i> <?php echo $auth['phone'] ?></span>
                    <span class="h5 text fw-bold"><i class="fa-solid fa-map-location-dot"></i> <?php echo $auth['address'] ?></span>
                    <span class="h5 text fw-bold"><i class="fa-brands fa-chrome"></i> <?php echo $auth['role'] ?></span>
                    <span class="h5 text fw-bold"><i class="fa-solid fa-calendar-days"></i> <?php echo $auth['created_at'] ?></span>
                </div>
            </section>
    </main>

    <!-- modal form upload image file -->
    <div class="modal fade" id="upload">
       <div class="modal-dialog modal-dialog-centered p-2">
           <div class="modal-content">
               <div class="modal-header">
                   <div class="modal-title d-flex justify-content-end w-100">
                       <p class="btn-close text-end" data-bs-dismiss="modal" data-bs-target="#uploadl"></p>
                    </div>
               </div>
               <form action="./actions/upload.php?id=<?php echo $auth['id']; ?>" class="modal-body" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                       <label for="" class="form-label fw-bold">Profile Photo</label>
                       <input type="file" class="form-control" name="photo" required/>
                    </div>

                    <div class="form-group my-2">
                        <button type="submit" class="btn btn-success w-100" data-bs-dismiss="modal" data-bs-target="#upload">Upload</button>
                    </div>
               </form>
           </div>
       </div>
    </div>

    <!-- modal for update datas -->
    <div class="modal fade" id="update">
        <div class="modal-dialog  modal-dialog-centered">
           <div class="modal-content p-2">
                <div class="modal-header">
                        <div class="modal-title w-100 text-end">
                            <span class="btn-close" data-bs-dismiss="modal" data-bs-target="#update"></span>
                        </div>
                    </div>
                    <form action="./actions/update.php?id=<?php echo $auth['id']; ?>"  method="post" class="modal-body" enctype="multipart/form-data">
                        <div class="form-group my-2">
                            <label for="" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $auth['name']; ?>">
                        </div>
                        <div class="form-group my-2">
                            <label for="" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $auth['email']; ?>" >
                        </div>
                        <div class="form-group my-2">
                            <label for="" class="form-label fw-bold">Phone</label>
                            <input type="number" class="form-control"  name="phone" value="<?php echo $auth['phone']; ?>">
                        </div>
                        <div class="form-group my-2">
                            <label for="" class="form-label fw-bold">Address</label>
                            <textarea id="" cols="30" rows="5" name="address" class="form-control"><?php echo $auth['address']; ?></textarea>
                        </div>
                        <div class="form-group my-2">
                            <?php if(!$auth['photo'] == ''){ ?>
                                <img src="./actions/photos/<?php if($auth['photo'] != '') { echo $auth['photo'] ;}?>" class="d-block" alt="profile-image" style="width:100px;height:100px;border-radius:2px;"/>
                            <?php } ?>
                            <label for="" class="form-label fw-bold">Profile Image</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <div class="form-group my-2 d-flex justify-content-around ">
                            <button class="btn btn-waring" data-bs-dismiss="modal" data-bs-target="#update">Cancel</button>
                            <button class="btn btn-success" type="submit">Update</button>
                        </div>
                   </form>
           </div>
        </div>
    </div>

</body>
</html>