<?php
require_once("../config/Database.php");
require_once("../class/RegisterFish.php");
require_once("../header.php");

$id = $_POST['id'];

$connecDB = new Database();
$db = $connecDB->getConnection();

$register_fish = new RegisterFish($db);

if (isset($_POST['enter'])) {

    $register_fish->setNameFish($_POST['name']);
    $register_fish->setAttribute($_POST['attribute']);
    $register_fish->setGender($_POST['gender']);
    $register_fish->setPrice($_POST['price']);
    if ($register_fish->update($id)) {
        header("Location: ../views/table_fish.php");
    }
}
