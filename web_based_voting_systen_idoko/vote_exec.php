<?php
session_start();
error_reporting(0);
include('connect.php');

if(strlen($_SESSION['VregNo'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
	}
      
$regNo = $_SESSION["VregNo"];


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d ');


$pid=$_GET['pid'];
$candID=$_GET['id'];

//get old count
$sqlcount = "select * from candidate where candID='$candID'"; 
$resultcount = $conn->query($sqlcount);
$rowcount = mysqli_fetch_array($resultcount);
$count = $rowcount['count'];
$candName = $rowcount['candName'];

//slect voters details
$sqlvoter = "select * from voter where regNo='$regNo'"; 
$resultvoter = $conn->query($sqlvoter);
$rowvoter = mysqli_fetch_array($resultvoter);
$voterName = $rowvoter['voterName'];
$voterID = $rowvoter['voterID'];


//check if voter has voted already
$sql_u = "SELECT * FROM voting WHERE voterID='$voterID' and post='$pid'";
$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {

    ?>
									
<script>
alert('Voter Already Voted for this Office ');
window.location = "vote.php";

</script>

	<?php	



}else {


$sql1 = " update candidate set count=('$count' + 1) where candID='$candID'";
   
if (mysqli_query($conn, $sql1)) {


//insert to vote and other details
$query_insert_vote = "INSERT INTO voting ( candID,candName, voterID , voterName,voteTime,post) VALUES ('$candID','$candName ','$voterID', '$voterName','$current_date','$pid')";
 
if ($conn->query($query_insert_vote) === TRUE) {

$_SESSION["Epost"]=$pid ;
$_SESSION["EcandID"]=$candID ;

?>
									
<script>
alert('Voting was successful');
window.location = "Result.php";

</script>

	<?php	
}
}
}
?>