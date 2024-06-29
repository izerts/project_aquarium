<?php
require_once("../header.php");
require_once("../config/Database.php");
require_once("../class/RegisterFish.php");



$connecDB = new Database();
$db = $connecDB->getConnection();

//code...
$user = new RegisterFish($db);
$result = $user->render();
$render = $result->fetch(PDO::FETCH_OBJ);


?>

<div class="container">
    <h3 class="my-3">Update Fish</h3>



    <form action="../controller/update_fish.php" method="POST">
        <div class="mb-3">
            <input type="hidden" name='id' value="<?= $render->id ?>">
            <label for="name">name</label>
            <input type="text" name="name" class="form-control" aria-describedby="name" value="<?= $render->name ?>">
        </div>
        <div class="mb-3">
            <label for="attribute">attribute</label>
            <textarea name="attribute" id="" class="form-control">
            <?= $render->attribute ?>
            </textarea>
            <!-- <input type="text" name="attribute" class="form-control" aria-describedby="attribute" > -->
        </div>
        <div class="mb-3">
            <label for="gender">gender</label>
            <select name="gender" id="" value="<?= $render->gender ?>" class="form-select">
                <option value="male">ตัวผู้</option>
                <option value="female">ตัวเมีย</option>
                <option value="all">คละเพศ</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price">ราคา</label>
            <input type="text" name="price" class="form-control" aria-describedby="price" value="<?= $render->price ?>">
        </div>
        <button type="submit" name="enter" class="btn btn-primary">update</button>
    </form>

</div>
<?php require_once("../footer.php"); ?>