<?php
if (isset($_GET['id'])) {
    include 'conn.php';
    $querySelect = 'select * from property where id=' . $_GET['id'];
    $ResultSelectStmt = mysqli_query($conn, $querySelect);
    $fetchRecords = mysqli_fetch_assoc($ResultSelectStmt);
    $createDeletePath  = 'images/' . $fetchRecords['image'];
    if (unlink($createDeletePath)) {
      $sql = "delete from property where id=" . $_GET["id"];
      $rsDelete = mysqli_query($conn, $sql);
      if ($rsDelete) {
        header('location:index.php?success=true');
        exit();
      }
    }
  }
?>