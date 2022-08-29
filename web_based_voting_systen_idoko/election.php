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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Vote Here</title>
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
.style3 {font-size: 18px}
.style36 {color: #0000FF; font-weight: bold; font-size: 24px; }
.style38 {font-size: 16px}
.style40 {font-size: 16px; font-weight: bold; color: #000033; }
.style41 {
	font-weight: bold;
	color: #000000;
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
            <span>Menu</span>         
		  </a>        
		</li>
      </ul>

      <section class="top-bar-section">
        <!-- Right Nav Section -->
        <ul class="right">
		          <li class=""><a href="index.php">Home </a></li>

          <li class=""><a href="Voter-register.php">Voter Registration</a></li>
		            <li class=""><a href="candidate-register.php">Candidate Registration</a></li>
          <li class="active"><a href="vote.php">Vote</a></li>
          <li class=""><a href="choose-result.php">Result</a></li>

       
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
    <p align="center"><span class="style2"><span class="style3"><strong>Choose Your Candidate Here </strong></span></span></p>
    <table width="52%" border="3" align="center" bordercolor="#9900CC" class="table table-bordered table-striped" id="resultTable">
      <thead>
        <tr>
          <th width="3%" bgcolor="#669966" class="style36"><div align="center" class="style40">#</div></th>
          <th width="29%" bgcolor="#669966" class="style36"><div align="center" class="style40">Candidate</div></th>
		            <th width="29%" bgcolor="#669966" class="style36"><div align="center" class="style40">Photo</div></th>
          <th width="20%" bgcolor="#669966" class="style36"><div align="center" class="style40">Position</div></th>
          <th width="19%" bgcolor="#669966" class="style36"><div align="center" class="style40">Action</div></th>
        </tr>
      </thead>
      <tbody>
        <?php 
                                          $sql = "SELECT * FROM candidate where post='$type' order by candName ASC";
                                           $result = $conn->query($sql);
										$cnt=1;
                                           while($row = $result->fetch_assoc()) { 
										   ?>
        <tr class="gradeX">
          <td height="47"><div align="center" class="style38 style41">
              <div align="center"><?php echo $cnt; ?></div>
          </div></td>
         					    <td><div align="center" class="style2"><strong><?php echo $row['candName']; ?></strong></div></td>
								 <td><div align="center" class="style2"><strong><span class="controls"><img src="<?php echo $row['photo'];?>"  width="89" height="81" border="2"/></span></strong></div></td>

					    <td><div align="center" class="style2"><strong><?php echo $row['post']; ?></strong></div></td>
		                         <td><div align="center">
                                   <span class="style2"><strong><span class="style6"><a href="vote_exec.php?id=<?php echo $row['candID'];?>&pid=<?php echo $row['post'];?>" onClick="return confirmvote('<?php echo $row['candName']; ?>');">Vote Here</a> </strong></span></tr>
        <?php $cnt=$cnt+1;} ?>
      </tbody>
      <tfoot>
      </tfoot>
    </table>
    <p align="center">&nbsp;</p>
    <p align="center"><a href="vote.php">&lt;&lt; Return </a></p>
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
