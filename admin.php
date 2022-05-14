<?php 
    include("./vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\Auth;

    $auth = Auth::check();

    $users = new UsersTable(new MySQL());
    $all = $users->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require('./js_css/links.php'); ?>
</head>
<body class="w-100" style="height:100vh;max-height:100vh;">
    <!--header -->
    <header id="header" class="w-100 px-5 py-2 d-flex justify-content-between">
        <h1 class="h2">Manage Users <span class="badge p-3 bg-danger fw-bold mx-3"><?php echo count($all);  ?><span></h1>
        <div class="mx-3">
            <a href="./profile.php" class="text-success">Profile </a><span>|</span><a href="./actions/logout.php" class="text-danger"> Logout</a>
        </div>
    </header>

    <p class="my-5"></p>

    <main id="main" class="container">
        <table class="table table-striped">
            <thead>
                <tr class="fw-bold">
                    <td>Id</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Role</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if(count($all) == 0) :  ?>
                    <tr>
                        <td colspan="6" class="fw-bold text-center alert-danger">There is no data to show!</td>
                    </tr>
                <?php endif ;  ?>
                <?php foreach($all as $user) { $id = 1; ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo $user->role; ?></td>
                        <td><a href="" class="btn btn-sm"></a><a href="" class="btn btn-sm">Active</a><a href="" class="btn btn-sm btn-danger">Delete</a></td>
                    </tr>
                <?php ++$id; } ?>
            </tbody>
        </table>
    </main>
</body>
</html>