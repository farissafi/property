<?php
session_start();
?>
<?php
$msg = "";
if (isset($_POST['submit'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    if (empty($username)) {
        $msg = "<div class='alert alert-danger' role='alert'>
      الرجاء ادخال اسم المستخدم
     </div>";
    } elseif (empty($_POST['password'])) {
        $msg = "<div class='alert alert-danger' role='alert'>
    الرجاء ادخال كلمة المرور
   </div>";
    } else {
        include "conn.php";
        $sql = "select * from users where username='$username' and password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $msg = "<div class='alert alert-danger' role='alert'>
        خطأ في اسم المستخدم و كلمة المرور
       </div>";
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user['id'];
            header('Location:index.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/bootstrap.rtl.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" class="container w-25 my-5 p-5 card animate__animated animate__zoomInDown">
        <?php
        if (isset($msg)) {
            echo $msg;
        }
        ?>
        <div class="row my-1">
            <img height="150px" width="100px" src="images/logo.png" alt="">
        </div>
        <div class="row my-1">
            <input type="text" name="username" class="form-control text-center" placeholder="اسم المستخدم">
        </div>
        <div class="row my-1">
            <input type="password" name="password" class="form-control text-center" placeholder="كلمة السر">
        </div>
        <div class="row my-1">
            <div class="col-6">
                <button type="submit" name="submit" class="btn btn-primary w-100">ادخل</button>
            </div>
            <div class="col-6">
                <button type="submit" class="btn btn-danger w-100">الغاء الامر</button>
            </div>
        </div>
    </form>
    <script src="js/bootstrap.js"></script>
</body>

</html>