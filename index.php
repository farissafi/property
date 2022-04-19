<?php
session_start();
if (!isset($_SESSION['id'])) {

    header('Location:login.php');
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
    <div class="container animate__animated animate__flipInX my-5">
        <div class="d-flex justify-content-between">
            <h4>العقارات</h4>
            <a href="add_property.php" class="btn btn-danger mb-2 my-2">اضافة عقار</a>
        </div>
        <table class="table table-bordered table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">عنوان العقار</th>
                    <th scope="col">سعر العقار</th>
                    <th scope="col">تفاصيل العقار</th>
                    <th scope="col">رقم الفئة</th>
                    <th scope="col">صورة العقار</th>
                    <th scope="col">تعديل|حذف</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include "conn.php";
                $sql = "select * from property";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    foreach ($result as $key => $row) {
                        echo '
                   <tr class="align-middle">
                     <th scope="row">' . ++$key . '</th>
                     <td>' . $row['address'] . '</td>
                     <td>' . $row['price'] . '</td>
                     <td>' . $row['details'] . '</td>
                     <td>' . $row['category'] . '</td>
                     <td><img width="100px" src="images/' . $row['image'] . '" alt="' . $row['address'] . '"></td>
                     <td><a href="edit.php?id=' . $row['id'] . '" class="btn btn-primary">edit</a><a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger">delete</a></td>
                   </tr>
                   
                   ';
                    }
                } else {
                    echo '<tr class="align-middle">
                    <td colspan="5" scope="row">لا يوجد بيانات يمكن عرضها...</td>
                </tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="js/bootstrap.js"></script>
</body>

</html>