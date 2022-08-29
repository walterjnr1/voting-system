<?php
session_start();
error_reporting(0);
include('connect.php');


 date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d H:i:s');

if(isset($_POST['btnlogin']))
{


$regNo = $_POST['txtregNo'];
$voterID = $_POST['txtvoterID'];

 $sql = "SELECT * FROM voter WHERE regNo='".$regNo."' and voterID = '".$voterID."'";
  $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
($row = mysqli_fetch_assoc($result));
$_SESSION["VregNo"] = $row['regNo'];
$_SESSION["Vname"] = $row['voterName'];

$voterName = $row['voterName'];
$phone = $row['phone'];
$_SESSION["VvoterID"] = $row['voterID'];


header("Location: vote.php"); 
}else { 

$msg_error = "Wrong Reg Number or Voter ID";
}
//}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>LOGIN FORM|Web-Based Voting System</title>
  <link href="bitnami.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link href="css/all.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico">

  <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
  </style>
</head>
<body>
  <div class="contain-to-grid">
    <nav class="top-bar" data-topbar>
      <ul class="title-area">
        <li class="name">
		
          <h1 class="style1" style="color:#FFFFFF">Web-Based Voting System </h1>
        </li>
        <li class="toggle-topbar menu-icon">
          <a href="#">
            <span>Menu</span>         
		  </a>        
		</li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
		          <li ><a href="index.php">Home </a></li>

          <li class=""><a href="Voter-register.php">Voter Registration</a></li>
		            <li class=""><a href="candidate-register.php">Candidate Registration</a></li>
          <li class=""><a href="vote.php">Vote</a></li>
          <li class=""><a href="choose-result.php">Result</a></li>

       
        </ul>
      </section>
    </nav>
  </div>
      <div class="hero"><img src="images/logo2.png" alt="Secured E-voting" width="111" height="111" />
 <div id="wrapper">
    <p align="center">&nbsp;</p>
    <p align="center">
  <style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #FF0000;
}
.style2 {color: #000000}
-->
  </style>
    <p><h4 align="center"><?php echo "<p> <font color=red font face='arial' size='3pt'>$msg_error</font> </p>"; ?></h4>  
       </p>

  <div align="center" style="color:#0000CC">
    <p><strong><span style="font-size:30px">LOGIN FORM</span>  </strong></p>
  </div>
  <table width="754" height="223" border="0" align="center">
      <tr>
        <td width="748">
		<form action="" method="post" name="f" class="form-horizontal contactform" id="f" >
      <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1"><strong>Reg No</strong>:
          <input type="text"  id="pass1" class="form-control" name="txtregNo"  value="<?php if (isset($_POST['txtregNo']))?><?php echo $_POST['txtregNo']; ?>" required="" />
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1"><strong>Voter ID:</strong>
          <input type="text"  id="pass1" class="form-control" name="txtvoterID"  value="<?php if (isset($_POST['txtvoterID']))?><?php echo $_POST['txtvoterID']; ?>" required="" />
        </label>
      </div>
        
        <div style="height: 10px;clear: both"></div>
        <div class="form-group">
        <div class="col-lg-10">
          <button class="btn btn-primary" type="submit" name="btnlogin">Login</button>
        </div>
        </div>
    </form> </td>
      </tr>
    </table>
    <p align="center">&nbsp;</p>
    <div id="lowerContainer" class="row">
      <div id="content" class="large-12 columns">
          <!-- @@BITNAMI_MODULE_PLACEHOLDER@@ -->
      </div>
    </div>
</div>
<footer>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p align="center"><?php  include('footer.php');?></p>
</footer>
</body>
</html>
