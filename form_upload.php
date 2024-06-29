<?php require_once("config/Database.php");
require_once("header.php");
require_once("nav.php");


session_start();

$connectDB = new Database();
$db = $connectDB->getConnection();

?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12">
            <form action="upload/upload.php" method="post" enctype="multipart/form-data">
                <div class="text-center justify-content-center align-items-center p-4 border-2 border-dased rounded-3">
                    <h6 class="my-2">Select image file to upload</h6>
                    <input type="file" name="file" class="form-control streched-link" accept="image/gif, image/jpeg, image/png">
                    <p class="small mb-0 mt-2"><b>Note</b>Only JPG, JPEG, PNG & GIF file allowed to upload</p>
                </div>
                <div class="d-sm-flex justify-content-end mt-2">
                    <input type="submit" name="submit" value="Upload" class="btn btn-sm btn-primary mb-3">
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php if (!empty($_SESSION['statusMsg'])) { ?>

            <div class="alert alert-success" role="alert">
                <?php
                echo $_SESSION['statusMsg'];
                unset($_SESSION['statusMsg']);
                ?>
            </div>
        <?php } ?>
    </div>

    <div class="row g-2">
        <?php
        $query = $db->query("SELECT * FROM images ORDER BY uploaded_on DESC");
        if ($query->rowCount() > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $imageURL = 'upload/imgUpload/' . $row['file_name'];
        ?>
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card shadow h-100">
                        <img src="<?php echo $imageURL ?>" alt="fish" width="100%" class="card-img">
                    </div>
                </div>
            <?php
            }
        } else { ?>
            <p>No image found...</p>
        <?php } ?>
    </div>


</div>

</div>

<?php require_once("footer.php"); ?>