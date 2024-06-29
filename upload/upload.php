<?php
require_once("../config/Database.php");

session_start();


$connectDB = new Database();
$db = $connectDB->getConnection();
// file upload path

$targetDir = "imgUpload/";

// if (isset($_POST['submit'])) {
//     if (!empty($_FILES["file"]["name"])) {
//         $fileName = basename($_FILES["file"]["name"]);
//         $targetFilePath = $targetDir . $fileName;
//         $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

//         // Allow certain file formats
//         $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
//         if (in_array($fileType, $allowTypes)) {

//             if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {


//                 //$insert = $db->query("INSERT INTO images(file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
//                 $sql_upload = "INSERT INTO `images`(`file_name`, `uploaded_on`) VALUES ('" . $fileName . "', NOW())";
//                 $stmt_upload = $db->prepare($sql_upload);
//                 $insert = $stmt_upload->execute();


//                 if ($insert) {
//                     $statusMsg = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
//                     header("location: form_upload.php");
//                 } else {
//                     $statusMsg = "File upload failed, please try again.";
//                     header("location: form_upload.php");
//                 }
//             } else {

//                 $statusMsg = "Sorry, there was an error uploading your file.";
//                 header("location: form_upload.php");
//             }
//         } else {

//             $statusMsg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
//             header("location: form_upload.php");
//         }
//     } else {

//         $statusMsg = "Please select a file to upload.";
//         header("location: form_upload.php");
//     }
// }



if (isset($_POST['submit'])) {

    if (!empty($_FILES["file"]["name"])) {

        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: ../form_upload.php");
    }
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (!in_array($fileType, $allowTypes)) {

        $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
        header("location: ../form_upload.php");
    }
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {

        $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
        header("location: ../form_upload.php");
    }

    //$insert = $db->query("INSERT INTO images(file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
    $sql_upload = "INSERT INTO `images`(`file_name`, `uploaded_on`) VALUES ('" . $fileName . "', NOW())";
    $stmt_upload = $db->prepare($sql_upload);
    $insert = $stmt_upload->execute();


    if (!$insert) {
        $_SESSION['statusMsg'] = "File upload failed, please try again.";
        header("location: ../form_upload.php");
    }
    $_SESSION['statusMsg'] = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
    header("location: ../form_upload.php");
}
