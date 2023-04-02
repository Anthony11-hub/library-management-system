<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_POST['update']))
{    
$sid=$_SESSION['stdid'];  
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$forgotPin=$_POST['forgotPin']; 
$sql="update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->execute();

echo '<script>alert("Your profile has been updated")</script>';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/select.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
    <link rel="stylesheet" href="assets/css/profile.css">

</head>
<body>
    <!------MENU SECTION START-->
    <header id="" class="header-2">
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="issued-books.php">My Books</a></li>
                <li><a href="my-profile.php">Profile</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="wrap-2">
            <div class="search">
                <input type="text" class="search__term" placeholder="what are you looking for?">
                <button type="submit" class="search__button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </header>
<!-- MENU SECTION END-->

<div class="content-wrapper">
  <div class="container">
    <div class="row pad-botm">
      <div class="col-md-12">
        <h4 class="header-line">My Profile</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9 col-md-offset-1">
        <div class="panel panel-danger">
          <div class="panel-heading">
            My Profile
          </div>
          <div class="panel-body">
            <form name="signup" method="post">
              <?php 
              $sid=$_SESSION['stdid'];
              $sql="SELECT StudentId,FullName,forgotPin,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents where StudentId=:sid ";
              $query = $dbh->prepare($sql);
              $query->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              if($query->rowCount() > 0) {
                foreach($results as $result) { ?>  
                  <div class="form-group">
                    <label>Student ID :</label>
                    <input class="form-control" type="text" name="studentid" value="<?php echo htmlentities($result->StudentId);?>" autocomplete="off" required />
                    
                  </div>
                  <div class="form-group">
                    <label>Reg Date :</label>
                    <?php echo htmlentities($result->RegDate);?>
                  </div>
                  <div class="form-group">
                    <label>Personal Access Pin :</label>
                    <?php echo htmlentities($result->forgotPin);?>
                  </div>
                  <?php if($result->UpdationDate!=""){?>
                    <div class="form-group">
                      <label>Last Updation Date :</label>
                      <?php echo htmlentities($result->UpdationDate);?>
                    </div>
                  <?php } ?>
                  <div class="form-group">
                    <label>Profile Status :</label>
                    <?php if($result->Status==1){?>
                      <span style="color: green">Active</span>
                    <?php } else { ?>
                      <span style="color: red">Blocked</span>
                    <?php }?>
                  </div>
                  <div class="form-group">
                    <label>Enter Full Name</label>
                    <input class="form-control" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required />
                  </div>
                  <div class="form-group">
                    <label>Mobile Number :</label>
                    <input class="form-control" type="text" name="mobileno" maxlength="10" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required />
                  </div>
                  <div class="form-group">
                    <label>Enter Email</label>
                    <input class="form-control" type="email" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>"  autocomplete="off" required readonly />
                  </div>
                <?php }
              } ?>
              <button type="submit" name="update" class="btn btn-primary" id="submit">Update Now </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

     <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
