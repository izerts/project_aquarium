<?php
require_once("../config/Database.php");
require_once("../class/RegisterFish.php");
require_once("../header.php");
// require_once("../nav.php");
// $id = $_GET['id'];

$connecDB = new Database();
$db = $connecDB->getConnection();

//code...
$user = new RegisterFish($db);
$result = $user->render();
$datas = $result->fetchAll(PDO::FETCH_OBJ);


?>


<div class="container">
    <center>
        <h3>ตารางแสดงรายชื่อสัตว์ใน aquarium</h3>
    </center>



    <table class="table">
        <thead>

            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>รูป</th>
            <th>ลักษณะ</th>
            <th>เพศ</th>
            <th>ราคา</th>
            <th>ลบ</th>
            <th>แก้ไข</th>



        </thead>
        <tbody>
            <a href="../form_regis_fish.php">go to insert</a>

            <?php foreach ($datas as $index => $data) { ?>
                <tr>

                    <td><?= $index + 1 ?></td>
                    <td><?= $data->name ?></td>
                    <td>
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card shadow h-100">
                                <img src="<?= $data->images ?>" alt="fish" width="100%" class="card-img">
                            </div>
                        </div>

                    </td>
                    <td><?= $data->attribute ?></td>
                    <td><?= $data->gender ?> </td>
                    <td><?= $data->price ?> </td>
                    <td> <button onclick="alertConfirm(<?= $data->id ?> )" class="btn btn-danger">ลบ</button></td>
                    <td><a href="form_update_fish.php?id=<?= $data->id ?> " class="btn btn-warning">แก้ไข</a></td>

                </tr>
            <?php   }  ?>

        </tbody>
    </table>
</div>
<script>
    function deleteFish(id) {
        // URL ของ API ที่ ต้ องการเรียก และ ID ที่ ต้ องการส่ งไป
        const url = `../controller/delete_fish.php?id=${id}`; // ใช้ fetch เพื่อทำ GET request 
        fetch(url).then(response => {
            // ตรวจสอบว่าการตอบสนองจากเซิร์ฟเวอร์สำเร็จหรือไม่    
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            } // แปลงข้อมูลจาก JSON     
            return response.json();
        }).then(data => { // ทำการประมวลผลข้อมูลที่ได้รับ     
            if (data.error == false) {

                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                }).then(() => {
                    location.reload()
                })
            }
        }).catch(error => { // จัดการข้อผิดพลาด     
            console.error('There has been a problem with your fetch operation:', error);
        });

    }

    function alertConfirm(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteFish(id)

            }
        });
    }
</script>
<?php require_once("../footer.php"); ?>