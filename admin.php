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

    <?php
        $msg = "";
        $bg = "";
        if(isset($_GET['success'])){
            $bg = $_GET['success'] == "true" ? "alert-success" : "alert-danger";
            $msg = $_GET['msg'];
        }
    ?>

    <p class="my-2 <?php echo $bg; ?> fw-bold p-2 mx-3"><?php echo $msg; ?></p>

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
            <tbody class="fw-bold">
                <?php if(count($all) == 0) :  ?>
                    <tr>
                        <td colspan="6" class="fw-bold text-center alert-danger">There is no data to show!</td>
                    </tr>
                <?php endif ;  ?>
                <?php
                 $id = 1; 
                 foreach($all as $user) {?>
                    <?php
                        $isLogin = false;
                        $idAdmin = "";
                        $adminPower = false;//to make not able to do nothing to admin
                         if($user->role === "Admin"){
                             $isAdmin = "btn btn-warning";
                             $adminPower = true;
                         } 
                         if($user->email === $auth['email']){
                             $isLogin = true;
                         }
                    ?>

                     <!--  to decide whether suspend or unsuspend -->
                    <?php 
                        $status = $user->suspend == 0 ? "Active" : "Unactive";
                        $willGoPage = $status == "Active" ? "suspend.php" : "unsuspend.php";
                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><span class="<?php echo $isAdmin; ?>"><?php echo $user->role; ?></span></td>
                        <td class="d-flex gap-1">
                            <div class="dropdown" id="dropdown">
                                <a href="" class="dropdown-toggle btn btn-primary btn-sm mx-1 <?php if($adminPower){ echo 'disabled'; }?>" data-bs-toggle="dropdown" href="#dropdown">Change Role</a>
                                <ul class="dropdown-menu p-0 m-0 fw-bold">
                                   <li><a href="./actions/role.php?id=<?php echo $user->id; ?>&role=1" class="dropdown-item">Stuff</a></li>
                                   <li><a href="./actions/role.php?id=<?php echo $user->id; ?>&role=2" class="dropdown-item">Sale</a></li>
                                   <li><a href="./actions/role.php?id=<?php echo $user->id; ?>&role=3" class="dropdown-item">HR</a></li>
                                   <li><a href="./actions/role.php?id=<?php echo $user->id; ?>&role=4" class="dropdown-item">Manager</a></li>
                                   <li><a href="./actions/role.php?id=<?php echo $user->id; ?>&role=5" class="dropdown-item bg-danger">Admin</a></li>
                                </ul>
                            </div>
                            <a href="./actions/<?php echo $willGoPage; ?>?id=<?php echo $user->id;?>" onclick="return confirm('Are you sure to make?');" class="btn btn-success <?php if($status === 'Unactive'){ echo 'btn-warning';} ?> mx-2 btn-sm <?php if($adminPower || $user->id === $auth['id']){ echo 'disabled';} ?>"><?php echo $status; ?></a><a href="./actions/delete.php?id=<?php echo $user->id ; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-sm <?php if($isLogin  || $adminPower){ echo 'disabled'; } ?>">Delete</a></td>
                    </tr>
                <?php ++$id; } ?>
            </tbody>
        </table>
    </main>
</body>
</html>