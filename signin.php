<?php require_once "header.php";
require_once "nav.php";
?>



<div class="container">
    <h3 class="my-3">Login Page</h3>

    <?php

    require_once('config/Database.php');
    require_once('class/Userlogin.php');
    require_once('class/utils.php');


    $connectDB = new Database();
    $db = $connectDB->getConnection();

    $user = new UserLogin($db);
    $bs = new Bootstrap();

    if (isset($_POST['signin'])) {

        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);

        if ($user->emailNotExists()) {
            $bs->displayAlert("Email is not exists", "danger");
            //echo "<div class='alert alert-danger' role='alert'> Email is not exists </div>";
        } else {
            if ($user->verifyPassword()) {
                // echo "<div class='alert alert-success' role='alert'> Password matches </div>";
            } else {
                $bs->displayAlert("Password do not matches", "danger");
                // echo "<div class='alert alert-danger' role='alert'> Password do not matches</div>";
            }
            // echo "<div class='alert alert-success' role='alert'> Email is  exists </div>";
        }
    }
    ?>


    <form action="" method="POST">

        <div class="mb-3">
            <label for="email address">email</label>
            <input type="email" name="email" class="form-control" aria-describedby="email" placeholder="enter your email">
        </div>
        <div class="mb-3">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" aria-describedby="password" placeholder="enter your password">
        </div>

        <button type="submit" name="signin" class="btn btn-primary">Sign In</button>

    </form>
    <p class="mt-3">คุณยังไม่มีแอคเคาท์ใช่ไหม? go to <a href="signup.php">Sign Up</a></p>
    <hr>
    <a href="index.php" class="btn btn-secondary">Go back</a>

</div>





<?php require_once "footer.php" ?>