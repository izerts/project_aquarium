<?php require_once("header.php"); ?>
<?php require_once("nav.php"); ?>




<div class="container">
    <h3 class="my-3">Register Page</h3>



    <?php require_once("config/Database.php"); ?>
    <?php require_once("class/UserRegister.php"); ?>
    <?php require_once("class/utils.php"); ?>
    <?php
    $connecDB = new Database();
    $db = $connecDB->getConnection();

    $user = new UserRegister($db);
    $bs = new Bootstrap();

    if (isset($_POST['signup'])) {
        $user->setName($_POST['name']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setConfirmPassword($_POST['confirm_password']);




        if (!$user->validatePassword()) {
            $bs->displayAlert("Password do not match", "danger");
            // echo "<div class='alert alert-danger' role='alert'>Password do not match </div>";
        }
        if (!$user->checkPasswordLength()) {
            $bs->displayAlert("Password must be at least 6 charactor long", "danger");
            // echo "<div class='alert alert-danger' role='alert'>Password must be at least 6 charactor long </div>";
        }
        if ($user->checkEmail()) {
            $bs->displayAlert("This email is already existe ", "danger");
            //  echo "<div class='alert alert-danger' role='alert'>This email is already existe </div>";
        }
        if ($user->createUser()) {
            $bs->displayAlert("User Creat Successfully.", "success");
            //  echo "<div class='alert alert-success' role='alert'> User Creat Successfully. </div>";
        } else {
            $bs->displayAlert("Fail to Create User. ", "danger");
            // echo "<div class='alert alert-danger' role='alert'> Fail to Create User. 
            // </div>";
        }
    }

    ?>








    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
        <div class="mb-3">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" aria-describedby="name" placeholder="enter your name">
        </div>
        <div class="mb-3">
            <label for="email address">email</label>
            <input type="email" name="email" class="form-control" aria-describedby="email" placeholder="enter your email">
        </div>
        <div class="mb-3">
            <label for="password">password</label>
            <input type="password" name="password" class="form-control" aria-describedby="password" placeholder="enter your password">
        </div>
        <div class="mb-3">
            <label for="confirmPassword">confirmPassword</label>
            <input type="password" name="confirm_password" class="form-control" aria-describedby="confirmPassword" placeholder="enter your confirmPassword">
        </div>
        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>

    </form>
    <p class="mt-3">คุณมีรหัสผ่านแล้วใช่ไหม? go to <a href="signin.php">Sign In</a></p>
    <hr>
    <a href="index.php" class="btn btn-secondary">Go back</a>

</div>





<?php require_once("footer.php"); ?>