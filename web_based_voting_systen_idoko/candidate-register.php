<?php
session_start();
error_reporting(0);

include('connect.php');

 date_default_timezone_set('Africa/Lagos');
 $current_date = date('Y-m-d H:i:s');

if(isset($_POST["btnsubmit"]))
{

$candname = mysqli_real_escape_string($conn,$_POST['txtcandName']);
//$candID = mysqli_real_escape_string($conn,$_POST['txtcandID']);
$regNo = mysqli_real_escape_string($conn,$_POST['txtregno']);
$sex = mysqli_real_escape_string($conn,$_POST['cmdsex']);
$maritalstatus = mysqli_real_escape_string($conn,$_POST['cmdmaritalstatus']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);
$DOB = mysqli_real_escape_string($conn,$_POST['txtDOB']);
$address = mysqli_real_escape_string($conn,$_POST['txtaddress']);
$phone = mysqli_real_escape_string($conn,$_POST['txtphone']);
$state = mysqli_real_escape_string($conn,$_POST['state']);
$lga = mysqli_real_escape_string($conn,$_POST['LocalGovt']);
$dept = mysqli_real_escape_string($conn,$_POST['txtdept']);
$faculty = mysqli_real_escape_string($conn,$_POST['cmdfaculty']);
$yearadmission = mysqli_real_escape_string($conn,$_POST['txtyearAdmission']);
$post = mysqli_real_escape_string($conn,$_POST['cmdpost']);
$pin = mysqli_real_escape_string($conn,$_POST['txtpin']);
$used='1';
$photo='uploads/default.jpg';

//check if Reg number already exist
$sql_u = "SELECT * FROM candidate WHERE regNo='$regNo'";
$res_u = mysqli_query($conn, $sql_u);
if (mysqli_num_rows($res_u) > 0) {
$msg_error = "Reg number already exist";

}else {

//check if PIN number is correct
$sql = "SELECT * FROM pin WHERE pin_num='$pin' and status=0";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) == 0) {
$msg_error = "PIN Not Correct or Already in Used";

}else { 
	//check if PIN number is already used
$sql11 = "SELECT * FROM pin WHERE pin_num='$pin' and status='$used'";
$res11 = mysqli_query($conn, $sql11);
if (mysqli_num_rows($res11) > 0) {
$msg_error = "PIN Number Already In Used";
	
}else {	
	
//update PIN status
$sql1 = " update pin set status='1' where pin_num='$pin'";
if (mysqli_query($conn, $sql1)) {



function candID(){
$string = (uniqid(rand(), true));
return substr($string, 0, 5);
}
	
$candID = "CID-".candID();


$query_insert_user = "INSERT INTO candidate ( candID,candName, regNo, maritalStatus,sex, DOB, phone, address,lga, state, dept, faculty, yearadmission,post,pin,photo,count) VALUES ('$candID','$candname', '$regNo', '$maritalstatus','$sex', '$DOB', '$phone', '$address','$lga', '$state', '$dept', '$faculty','$yearadmission','$post', '$pin','$photo','0')";
 if ($conn->query($query_insert_user) === TRUE) {

$_SESSION['regNo']=$regNo;
$_SESSION['candName']=$candname;
$_SESSION['candID']=$candID;

$username='rexrolex0@gmail.com';//Note: urlencodemust be added forusernameand 
$password='admin123XXX';// passwordas encryption code for security purpose.

$sender='SLT-RITMAN';

$url = "http://portal.nigeriabulksms.com/api/?username=".$username."&password=".$password."&message="."Dear $candname, Your registration Was complete and Your Candidate ID is :  ".$candID."&sender=".$sender."&mobiles=".$phone;



$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, 0);
$resp = curl_exec($ch);

//$msg_success = "Candidate registered Successfully";
header('location:cand_pic.php');

           } else { // If it did not run OK.
     
$msg_error = "Problem Registering Candidate";
//header('location:voterReg.php');
}
}
}
}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Candidate Registration</title>
  <link href="bitnami.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link href="css/all.css" rel="stylesheet" type="text/css" />
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.ico">
<script>
    
function showLocalGovt(str)
{
if (str=="")
  {
  document.getElementById("LocalGovt").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("LocalGovt").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","local_govt_db.php?state="+str,true);
xmlhttp.send();
}
</script>
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
		            <li class="active"><a href="candidate-register.php">Candidate Registration</a></li>
          <li class=""><a href="vote.php">Vote</a></li>
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
    <p><strong><span style="font-size:30px">CANDIDATE'S REGISTRATION FORM</span>  </strong></p>
  </div>
  <table width="754" height="223" border="0" align="center">
      <tr>
        <td width="748"><form action="" method="post" name="f" class="form-horizontal contactform" id="f" >
       
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Fullname:
          <input type="text" placeholder="Enter Fullname" id="pass1" class="form-control" name="txtcandName" value="<?php if (isset($_POST['txtcandName']))?><?php echo $_POST['txtcandName']; ?>" required="" />
        </label>
      </div>
	  <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Registration Number:
          <input type="text" placeholder="Enter Reg No" id="pass1" class="form-control" name="txtregno" value="<?php if (isset($_POST['txtregno']))?><?php echo $_POST['txtregno']; ?>" required="" />
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="uemail">Email:
          <input type="email" name="txtemail" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  value="<?php if (isset($_POST['txtemail']))?><?php echo $_POST['txtemail']; ?>" placeholder="Email" required="">
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Sex:
          <select name="cmdsex" id="gender" class="form-control" required="">
          <option value=" ">--Select Gender--</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        </label>
      </div>
	   <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Marital Status:
          <select name="cmdmaritalstatus" id="gender" class="form-control" required="">
          <option value=" ">--Select Marital Status--</option>
          <option value="Single">Single</option>
          <option value="Married">Married</option>
		   <option value="Widow">Widow</option>
			<option value="Divorced">Divorced</option>

        </select>
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Date Of Birth:
          <input type="date"  id="pass1" class="form-control" name="txtDOB"  value="<?php if (isset($_POST['txtDOB']))?><?php echo $_POST['txtDOB']; ?>" required="" />
        </label>
      </div>
	   <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Phone:
          <input type="text"  id="pass1" class="form-control" name="txtphone"  value="<?php if (isset($_POST['txtphone']))?><?php echo $_POST['txtphone']; ?>" required="" />
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Address:
          <input type="text"  id="pass1" class="form-control" name="txtaddress"  value="<?php if (isset($_POST['txtaddress']))?><?php echo $_POST['txtaddress']; ?>" required="" />
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">State:
          <select name="state" class="form-control" id="state" onchange="showLocalGovt(this.value)">
          <option value="">Select your State</option>
          <option value="Abia">Abia</option>
          <option value="Adamawa">Adamawa</option>
          <option value="Akwa Ibom">Akwa Ibom</option>
          <option value="Anambra">Anambra</option>
          <option value="Bauchi">Bauchi</option>
          <option value="Bayelsa">Bayelsa</option>
          <option value="Benue">Benue</option>
          <option value="Borno">Borno</option>
          <option value="Cross River">Cross River</option>
          <option value="Delta">Delta</option>
          <option value="Ebonyi">Ebonyi</option>
          <option value="Edo">Edo</option>
          <option value="Ekiti">Ekiti</option>
          <option value="Enugu">Enugu</option>
          <option value="FCT">FCT</option>
          <option value="Gombe">Gombe</option>
          <option value="Imo">Imo</option>
          <option value="Jigawa">Jigawa</option>
          <option value="Kaduna">Kaduna</option>
          <option value="Kano">Kano</option>
          <option value="Kastina">Kastina</option>
          <option value="Kebbi">Kebbi</option>
          <option value="Kogi">Kogi</option>
          <option value="Kwara">Kwara</option>
          <option value="Lagos">Lagos</option>
          <option value="Nasarawa">Nasarawa</option>
          <option value="Niger">Niger</option>
          <option value="Ogun">Ogun</option>
          <option value="Ondo">Ondo</option>
          <option value="Osun">Osun</option>
          <option value="Oyo">Oyo</option>
          <option value="Plateau">Plateau</option>
          <option value="Rivers">Rivers</option>
          <option value="Sokoto">Sokoto</option>
          <option value="Taraba">Taraba</option>
          <option value="Yobe">Yobe</option>
          <option value="Zamfara">Zamfara</option>
        </select>
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">LGA:
          <select name="LocalGovt" class="form-control" class="active" id="LocalGovt">
        <option>Select Your Local Government</option>
        </select>
        </label>
      </div>
	  
	  <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Faculty:
          <select name="cmdfaculty" id="Faculty" class="form-control" required="">
          <option value=" ">--Select Faculty--</option>
         <option value="Engineering">Engineering</option>
          <option value="Building">Building</option>
		  <option value="Science">Science</option>
                                    <option value="Art">Art</option>
        </select>
        </label>
      </div>
        <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">Department:
          <input type="text"  id="pass1" class="form-control" name="txtdept"  value="<?php if (isset($_POST['txtdept']))?><?php echo $_POST['txtdept']; ?>" required="" />
        </label>
      </div>
	  
	   
	   <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">year of Admission:
          <input type="text"  id="pass1" class="form-control" name="txtyearAdmission"  value="<?php if (isset($_POST['txtyearAdmission']))?><?php echo $_POST['txtyearAdmission']; ?>" required="" />
        </label>
      </div>
	   <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">POST:
<select class="style5" name="cmdpost" id="cmdpost">
    <option disabled selected>-- Select Election --</option><?php
        $records = mysqli_query($conn, "SELECT * From election");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['election_name'] ."'>" .$data['election_name'] ."</option>";  // displaying data in option menu
        }	
    ?>  
</select>           </label>
      </div>
	   <div class="form-group">
        <label class="col-lg-12 control-label" for="pass1">PIN:
          <input type="password"  id="pass1" class="form-control" name="txtpin"  value="<?php if (isset($_POST['txtpin']))?><?php echo $_POST['txtpin']; ?>" required="" />
        </label>
      </div>
        <div class="form-group">
        <label for="pass1" class="col-lg-12 control-label style1"> By clicking Submit, you agree to our Terms of Use.</label>
      </div>
        <div style="height: 10px;clear: both"></div>
        <div class="form-group">
        <div class="col-lg-10">
          <button class="btn btn-primary" type="submit" name="btnsubmit">Register </button>
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
