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
$type=$_GET['type'];


date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d ');

//Get total voters
$sql = "SELECT * FROM voter";
 ($result=mysqli_query($conn,$sql)) ;
    $rowcount=mysqli_num_rows($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Election Result|Web-Based Voting System</title>
  <link href="bitnami.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link href="css/all.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico">
<script type="text/javascript">
		function confirmvote(candName){
if(confirm("ARE YOU SURE YOU WISH TO VOTE  " + " " + candName+ " " + " ?"))
{
return  true;
}
else {return false;
}
	 
}

</script>
  <style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
.style2 {color: #000000}
.style36 {color: #0000FF; font-weight: bold; font-size: 24px; }
.style38 {font-size: 16px}
.style40 {font-size: 16px; font-weight: bold; color: #000033; }
.style41 {
	font-weight: bold;
	color: #000000;
}
.style42 {
	color: #0000FF;
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
		
          <h1 class="style1">Web-Based Voting System </h1>
        </li>
        <li class="toggle-topbar menu-icon">
          <a href="#">
            <span>Menu</span>		  </a>		</li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
		          <li class=""><a href="index.php">Home </a></li>

          <li class=""><a href="Voter-register.php">Voter Registration</a></li>
		            <li class=""><a href="candidate-register.php">Candidate Registration</a></li>
          <li class=""><a href="vote.php">Vote</a></li>
          <li class="active"><a href="choose-result.php">Result</a></li>

       
          <li class=""><?php 
		  if(empty($_SESSION['VregNo'])) {   
    								echo "<a href='login.php'>Login</a>";
   						 }else{
echo "<a href='logout.php'>Logout</a>"	;							}  
								   ?></a></li>
        </ul>
      </section>
    </nav>
  </div>
      <div class="hero"><img src="images/logo2.png" alt="Secured E-voting" width="111" height="111" />
  <div id="wrapper">
    <div class="hero">
       <div class="row">
         <div class="large-12 columns">
            <p>&nbsp;</p>
            <p align="justify"><p><h4 align="center"><?php echo "<p> <font color=red font face='arial' size='3pt'>$msg_error</font> </p>"; ?></h4>  
       </p></p>
         </div>
       </div>
    </div>
    <p align="center" class="style2"><strong>REALTIME ELECTION RESULT </strong></p>
    <p align="center" class="style2">&nbsp;</p>
    <table width="52%" border="1" align="center" class="table table-bordered table-striped" id="resultTable">
      <thead>
        <tr>
          <th width="3%" bordercolor="#9966FF" bgcolor="#FFFFCC" class="style36"><div align="center" class="style40">#</div></th>
          <th width="29%" bordercolor="#9966FF" bgcolor="#FFFFCC" class="style36"><div align="center" class="style40">Candidate</div></th>
          <th width="20%" bordercolor="#9966FF" bgcolor="#FFFFCC" class="style36"><div align="center" class="style40">Position</div></th>
          <th width="19%" bordercolor="#9966FF" bgcolor="#FFFFCC" class="style36"><div align="center" class="style40">Count</div></th>
		            <th width="19%" bordercolor="#9966FF" bgcolor="#FFFFCC" class="style36"><div align="center" class="style40">Percentage</div></th>

        </tr>
      </thead>
      <tbody>
       										 <?php 
                                          $sql = "SELECT * FROM candidate where post='$type' order by count ASC";
                                           $result = $conn->query($sql);
										$cnt=1;
                                           while($row = $result->fetch_assoc()) { 
										   ?>
        <tr class="gradeX">
          <td height="47"><div align="center" class="style38 style41">
              <div align="center"><?php echo $cnt; ?></div>
          </div></td>
         					    <td><div align="center" class="style2"><strong><?php echo $row['candName']; ?></strong></div></td>
						    
								 <td><div align="center" class="style2"><strong><?php echo $type; ?></strong></div></td>
								  <td><div align="center"> <span class="label label-success"><?php echo $row['count']; ?></span></div></td>
					 <td><div align="center"><?php echo (($row['count']/$rowcount)*100); ?>%</div></td>

        <?php $cnt=$cnt+1;} ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <p align="center"><span class="style42">REGISTERED VOTERS: <?php echo $rowcount;  ?> </span></p>
    <p align="center"><a href="choose-result.php">&lt;&lt; Return </a></p>
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
