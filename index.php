<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require("./js_css/links.php"); ?>
</head>
<body class="w-100 d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <?php if(isset($_GET['registered'])) :  ?>
        <h1 class="h6 alert-success fw-bold p-3">Successfully Registered!</h1>
    <?php endif ;?>
    <?php if(isset($_GET['error'])) :  ?>
        <h1 class="h6 alert-danger fw-bold p-3"><?php echo $_GET['msg']; ?></h1>
    <?php endif ;  ?>
    <main class="card w-25 p-3">
        <!-- data from get..when error -->
        <?php 
            $email = "";
            $password = "";
            if(isset($_GET['email']) && isset($_GET['password'])){
                $email = $_GET['email'];
                $password = $_GET['password'];
            }
        ?>
        <form action="./actions/login.php" method="post" class="form">
            <div class="form-group my-2">
                <label for="" class="form-label">Email</label><input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo $email; ?>" autofocus required>    
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Password</label><input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo $password ; ?>" required>
            </div>
            <div class="form-group my-2 d-flex justify-content-between">
               <a href="./register.php" class="btn btn-warning">Create?</a><button class="btn btn-success" type="submit">Create</button>
            </div>
        </form>
    </main>
</body>
</html>