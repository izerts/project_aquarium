<?php
require_once("header.php");
require_once("nav.php");

require_once("config/Database.php");
require_once("class/RegisterFish.php");
require_once("class/utils.php");


$connecDB = new Database();
$db = $connecDB->getConnection();

$user = new RegisterFish($db);
$bs = new Bootstrap();

if (isset($_POST['enter']) && isset($_FILES['file_upload'])) {

    if (!empty($_FILES['file_upload']['name'])) {
        $user->setNameFish($_POST['name']);
        $user->setAttribute($_POST['attribute']);
        $user->setGender($_POST['gender']);
        $user->setPrice($_POST['price']);
        $user->setImages($_FILES['file_upload']);

        $user->createFish();
    } else {
        echo "Please select a file to upload.";
    }
}
// exit();
// if (isset($_POST['enter'])) {

//     $user->setNameFish($_POST['name']);
//     $user->setAttribute($_POST['attribute']);
//     $user->setGender($_POST['gender']);
//     $user->setPrice($_POST['price']);
//     $user->setImages($_FILES['file_upload']);
//     // var_dump($_FILES['file_upload']);
//     // exit();
//     // var_dump($user->createFish());
//     $user->createFish();
// }
?>

<div class="container">
    <h3 class="my-3">Register Fish</h3>



    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" aria-describedby="name">
        </div>
        <div class="mb-3">
            <label for="file_upload">images</label>
            <input type="file" name="file_upload" class="form-control streched-link" accept="image/gif, image/jpeg, image/png, image/jpg" required>
        </div>
        <div class="mb-3">
            <label for="attribute">attribute</label>
            <textarea name="attribute" id="" class="form-control">

            </textarea>
            <!-- <input type="text" name="attribute" class="form-control" aria-describedby="attribute" > -->
        </div>
        <div class="mb-3">
            <label for="gender">gender</label>
            <select name="gender" id="" class="form-select">
                <option value="male">ตัวผู้</option>
                <option value="female">ตัวเมีย</option>
                <option value="all">คละเพศ</option>

            </select>
        </div>
        <div class="mb-3">
            <label for="price">ราคา</label>
            <input type="text" name="price" class="form-control" aria-describedby="price">
        </div>
        <button type="submit" name="enter" class="btn btn-primary">enter</button>
    </form>

</div>





<?php require_once("footer.php"); ?>