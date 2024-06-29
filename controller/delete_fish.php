<?php
require_once("../config/Database.php");
require_once("../class/RegisterFish.php");



$id = $_GET['id'];
try {
    $connecDB = new Database();
    $db = $connecDB->getConnection();

    //code...
    $user = new RegisterFish($db);
    $user->delete($id);

    echo json_encode(['message' => 'ลบเสร็จสิ้น', 'error' => false]);
    // header("Location: ../views/table_fish.php");
} catch (\Exception $th) {
    echo  $th->getMessage();
}
