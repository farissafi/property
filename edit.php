<?php
session_start();
if (!isset($_SESSION['id'])) {

    header('Location:login.php');
}
?>
<?php
if (isset($_GET['id'])) {
    include "conn.php";
    $sqlGetDepData = "select * from property where id=" . $_GET['id'];
    $result = mysqli_query($conn, $sqlGetDepData);
    $row = mysqli_fetch_assoc($result);
    if (isset($_POST['submit'])) {
        $address = $_POST['address'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $details = $_POST['details'];
        if (file_exists($_FILES['image']['tmp_name'])) {
            $old_img_path = "images/" . $row['image'];
            unlink($old_img_path);
            $new_img_name = $_FILES['image']['name'];
            $expload_name = explode(".", $new_img_name);
            $ext = end($expload_name);
            $imageName = "img" . time() . "." . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $imageName);
            $sql = "update property set address='$address',price='$price',details='$details',category='$category',image='$imageName' where id=" . $_GET['id'];
            $res = mysqli_query($conn, $sql);
            header('location:index.php?success=true');
            exit();
        } else {

            $sql = "update property set address='$address',price='$price',details='$details',category='$category' where id=" . $_GET['id'];
            $res = mysqli_query($conn, $sql);
            header('location:index.php?success=true');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/bootstrap.rtl.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h4>تحديث عقار</h4>
        <form method="POST" enctype="multipart/form-data">
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">عنوان العقار</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" id="address" value="<?php if (isset($row['address'])) {
                                                                                                    echo $row['address'];
                                                                                                } ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">سعر العقار</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="price" id="price" value="<?php if (isset($row['price'])) {
                                                                                                    echo $row['price'];
                                                                                                } ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">تفاصيل العقار</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="details" id="details" value="<?php if (isset($row['details'])) {
                                                                                                    echo $row['details'];
                                                                                                } ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">رقم الفئة</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="category" id="category" value="<?php if (isset($row['category'])) {
                                                                                                        echo $row['category'];
                                                                                                    } ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">صورة العقار</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">تحديث عقار</button>
        </form>
    </div>
    <script src="js/bootstrap.js"></script>
</body>

</html>