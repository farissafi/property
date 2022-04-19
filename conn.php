<?php
// connecting in database
$conn = mysqli_connect("localhost", "root", "", "realhome");
if (!$conn) {
  die("No connect" . mysqli_connect_errno());
}
?>