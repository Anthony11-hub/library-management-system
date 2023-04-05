<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['change']))
{
$forgotPin=$_POST['forgotPin'];
$newpassword=md5($_POST['newpassword']);
  $sql ="SELECT forgotPin FROM tblstudents WHERE forgotPin=:forgotPin";
$query= $dbh -> prepare($sql);
$query-> bindParam(':forgotPin', $forgotPin, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update tblstudents set Password=:newpassword where forgotPin=:forgotPin";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':forgotPin', $forgotPin, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
echo "<script>alert('Your Password succesfully changed');</script>";
}
else {
echo "<script>alert('The personal Access Pin is invalid');</script>"; 
}
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System | Password Recovery </title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="assets/css/registration.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    
     <script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("New Password and Confirm Password Field do not match  !!");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>

</head>
<body>
    <!------MENU SECTION START-->
<!-- MENU SECTION END-->
             
<!--LOGIN PANEL START-->        
<div class="login-form-bd">
        <div class="form-wrapper">
          <div class="form-container">
            <h1>Forgot Password</h1>
            <form role="form" name="chngpwd" method="post" onSubmit="return valid();">
              <div class="form-control">
                <input type="text" name="forgotPin" autocomplete="off" required >
                <label> Personal Access Pin</label>
              </div>
      
              <div class="form-control">
                <input  type="password" name="newpassword" autocomplete="off" required  >
                <label> Password</label>
              </div>

              <div class="form-control">
                <input type="password" name="confirmpassword" autocomplete="off" required  >
                <label>Confirm Password</label>
              </div>

              <button type="submit" name="change" id="submit" class="login-btn" style="background-color:#007bff;">Change Password</button>
              <p class="text">Already have an account? <a href="user-login.php">Login</a></p>
			  <a href="index.php">library_management</a>
            </form>
          </div>
        </div>
      </div>   
<!-- <div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
<div class="panel panel-info">
<div class="panel-heading">
 LOGIN FORM
</div>
<div class="panel-body">
<form role="form" name="chngpwd" method="post" onSubmit="return valid();">

<div class="form-group">
<label>Enter Reg Email id</label>
<input class="form-control" type="email" name="email" required autocomplete="off" />
</div>

<div class="form-group">
<label>Enter Reg Mobile No</label>
<input class="form-control" type="text" name="mobile" required autocomplete="off" />
</div>

<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="newpassword" required autocomplete="off"  />
</div>

<div class="form-group">
<label>ConfirmPassword</label>
<input class="form-control" type="password" name="confirmpassword" required autocomplete="off"  />
</div>


 <button type="submit" name="change" class="btn btn-info">Chnage Password</button> | <a href="index.php">Login</a>
</form>
 </div>
</div>
</div>
</div>   -->
<!---LOGIN PABNEL END-->            
             
 
     <!-- CONTENT-WRAPPER SECTION END-->
     <script src="assets/js/login.js"></script>
      <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
