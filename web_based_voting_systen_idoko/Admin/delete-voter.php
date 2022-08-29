<?php
include('../connect.php');
$id=$_GET['id'];
$sql = "DELETE From `voter` where regNo ='$id'";
$result = mysqli_query($conn, $sql);
//$row = mysqli_num_rows($result);
if ($result >0){

header("location: votersrecord.php");
}
?>