<?php 
session_start();
include('includes/config.php');
error_reporting(0);

function generateRandomString($length = 6) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charLength - 1)];
  }
  return $randomString;
}


if(isset($_POST['signup']))
{
$forgotPin=generateRandomString(); 
$StudentId=$_POST['StudentId'];  
$fname=$_POST['fname'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;
$sql="INSERT INTO  tblstudents(forgotPin,StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:forgotPin,:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':forgotPin',$forgotPin,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo '<script>alert("Your Registration successfull and your reset password pin is  "+"'.$forgotPin.'")</script>';
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
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
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLE  -->
    <link rel="stylesheet" href="assets/css/registration.css">
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
function valid() {
  if (document.signup.password.value != document.signup.confirmpassword.value) {
    alert("Password and Confirm Password Field do not match  !!");
    document.signup.confirmpassword.focus();
    return false;
  }
  
  // Password validation
  var password = document.signup.password.value;
  var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  if (!passwordRegex.test(password)) {
    alert("Password should contain at least 8 characters, including 1 lowercase letter, 1 uppercase letter, and 1 number.");
    document.signup.password.focus();
    return false;
  }
  
  return true;
}
</script>

<script>
function checkAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>    

</head>
<body>
    <!------MENU SECTION START-->
<!-- MENU SECTION END-->
    <!-- <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line">User Signup</h4>
                
                            </div>

        </div>
             <div class="row">
           
<div class="col-md-9 col-md-offset-1">
               <div class="panel panel-danger">
                        <div class="panel-heading">
                           SINGUP FORM
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
<div class="form-group">
<label>Enter Full Name</label>
<input class="form-control" type="text" name="fullname" autocomplete="off" required />
</div>


<div class="form-group">
<label>Mobile Number :</label>
<input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required />
</div>
                                        
<div class="form-group">
<label>Enter Email</label>
<input class="form-control" type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  />
   <span id="user-availability-status" style="font-size:12px;"></span> 
</div>

<div class="form-group">
<label>Enter Password</label>
<input class="form-control" type="password" name="password" autocomplete="off" required  />
</div>

<div class="form-group">
<label>Confirm Password </label>
<input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
</div>
                             
<button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> -->


    <div class="login-form-bd">
        <div class="form-wrapper">
          <div class="form-container">
            <h1>User Sign Up</h1>
            <form name="signup" method="post" onSubmit="return valid();">
            <div class="form-control">
                <input type="text" name="fname" id="fname" required>
                <label> Enter Full Name</label>
              </div>  

              <div class="form-control">
                <input type="text" name="mobileno"  autocomplete="off" required >
                <label> Mobile Number</label>
              </div>

              <div class="form-control">
                <input type="text" name="StudentId"  autocomplete="off" required >
                <label> Student Registration</label>
              </div>

            <div class="form-control">
                <input  type="email" name="email" id="emailid" onBlur="checkAvailability()"  autocomplete="off" required  >
                <label> Email</label>
              </div>
      
              <div class="form-control">
                <input  type="password" name="password" autocomplete="off" required  >
                <label> Password</label>
              </div>

              <div class="form-control">
                <input type="password" name="confirmpassword" autocomplete="off" required  >
                <label>Confirm Password</label>
              </div>

              <button  type="submit" name="signup" id="submit" class="login-btn">Login</button>
              <p class="text">Already have an account? <a href="user-login.php">Login</a></p>
			  <a href="index.php">library_management</a>
            </form>
          </div>
        </div>
      </div>
      <script src="assets/js/login.js"></script>
     <!-- CONTENT-WRAPPER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
