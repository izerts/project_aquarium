<?php

class RegisterFish
{

    private $conn;
    private $table_name = "aquarium";


    public $name;
    public $attribute;
    public $gender;
    public $price;
    public $images;


    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function setNameFish($name)
    {
        $this->name = $name;
    }
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setImages($images)
    {
        $this->images = $images;
    }


    public function createFish()
    {
        $sql_fish = "INSERT INTO {$this->table_name}(name, attribute, gender, price, images) VALUES (:name, :attribute, :gender, :price, :images)";
        $stmt_fish = $this->conn->prepare($sql_fish);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->attribute = htmlspecialchars(strip_tags($this->attribute));
        $this->gender = htmlspecialchars(strip_tags($this->gender));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt_fish->bindParam(":name", $this->name);
        $stmt_fish->bindParam(":attribute", $this->attribute);
        $stmt_fish->bindParam(":gender", $this->gender);
        $stmt_fish->bindParam(":price", $this->price);

        $response = $this->uploadedFile($this->images);

        if ($response['message'] == 'success') {
            $stmt_fish->bindParam(":images", $response['file_path']);
        } else {
            return false;
        }
        if ($stmt_fish->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // public function createFish()
    // {

    //     $sql_fish = "INSERT INTO {$this->table_name}(name, attribute, gender, price, images) VALUES (:name, :attribute, :gender, :price, :images)";
    //     $stmt_fish = $this->conn->prepare($sql_fish);

    //     $this->name = htmlspecialchars(strip_tags($this->name));
    //     $this->attribute = htmlspecialchars(strip_tags($this->attribute));
    //     $this->gender = htmlspecialchars(strip_tags($this->gender));
    //     $this->price = htmlspecialchars(strip_tags($this->price));

    //     $stmt_fish->bindParam(":name", $this->name);
    //     $stmt_fish->bindParam(":attribute", $this->attribute);
    //     $stmt_fish->bindParam(":gender", $this->gender);
    //     $stmt_fish->bindParam(":price", $this->price);



    //     $response = $this->uploadedFile($this->images);
    //     // return $response;

    //     if ($response['message'] == 'success') {
    //         $stmt_fish->bindParam(":images", $response['file_path']);
    //     } else {
    //         return false;
    //     }

    //     // return $stmt_fish->execute() ? true:false;

    //     if ($stmt_fish->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
    public function render()
    {

        $sql = "SELECT * FROM {$this->table_name}";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        return $stmt;
    }

    public  function delete($id)
    {


        $sql = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "id" => $id
        ]);

        return true;
    }

    public function update($id)
    {

        $sql = " UPDATE {$this->table_name} SET `name`='$this->name',`attribute`='$this->attribute',`gender`='$this->gender',`price`='$this->price' WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
    }

    // public function renderImg()
    // {

    //     $sql = " SELECT * FROM {$this->table_name_img}";
    //     $stmt = $this->conn->prepare($sql);

    //     $stmt->execute();
    //     return $stmt;
    // }

    public function uploadedFile($file)
    {
        $targetDir = __DIR__ . "/../upload/imgUpload/";
        // if (empty($file["name"])) {
        //     return [
        //         'message' => 'empty'
        //     ];
        // }

        $fileName = basename($file["name"]); // sun.jpg
        // $currentDateTime = date('YmdHis'); // ว/ด/ป
        // $filenameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME); //sun(ไม่มีนามสกุลไฟล์)
        // $extension = pathinfo($fileName, PATHINFO_EXTENSION); //  jpg (เอานามสกุลไฟล์มา)
        // $fileName = $filenameWithoutExtension . '_' . $currentDateTime . '.' . $extension; //ประกอบร่าง


        // $fileName = basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;
        // $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        // $allowTypes = ['jpg', 'png', 'jpeg', 'gif', 'pdf'];
        // if (!in_array($fileType, $allowTypes)) {
        //     return [
        //         'message' => 'invalid_type'
        //     ];
        // }

        if (!move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            return [
                'message' => 'error'
            ];
        }
        $targetFilePath = "../upload/imgUpload/{$fileName}";
        return [
            'message' => 'success',
            'file_path' => $targetFilePath
        ];
    }
}
