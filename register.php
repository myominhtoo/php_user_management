<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php require("./js_css/links.php"); ?>
</head>
<body class="w-100 d-flex flex-column justify-content-center align-items-center" style="height:100vh;">
    <?php if(isset($_GET['error'])) :  ?>
        <h1 class="h6 alert-danger fw-bold">Error Occured!</h1>
    <?php endif ;?>
    <main class="card w-25 p-3">
        <form action="./actions/create.php" method="post" class="form">
            <div class="form-group my-2"> 
                <label for="" class="form-label">Name</label><input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Email</label><input type="text" class="form-control" name="email" placeholder="Enter email">    
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Phone</label><input type="text" class="form-control" name="phone" placeholder="Enter phone">
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Password</label><input type="password" class="form-control" name="password" placeholder="Enter password">
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Role</label>
                <select name="role" id="" class="form-select" required>
                    <option value="" selected disabled>Choose role</option>
                    <option value="1">Stuff</option>
                    <option value="2">Sale</option>
                    <option value="3">HR</option>
                    <option value="4">Manager</option>
                    <option value="5">Lead</option>
                </select>
            </div>
            <div class="form-group my-2">
                <label for="" class="form-label">Address</label><textarea name="address" id="" cols="30" rows="5" class="form-control"></textarea>
            </div>
            <div class="form-group my-2 d-flex justify-content-between">
               <a href="./index.php" class="btn btn-warning">Already?</a><button class="btn btn-success" type="submit">Create</button>
            </div>
        </form>
    </main>
</body>
</html>