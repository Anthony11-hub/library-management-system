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
    <title>Online Library Management System | Student Signup</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <!-- <link href="assets/css/font-awesome.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLE  -->
    <!-- <link href="assets/css/select.css" rel="stylesheet" /> -->
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

              <?php 
              $sid=$_SESSION['stdid'];
              $sql="SELECT StudentId,FullName,forgotPin,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents where StudentId=:sid ";
              $query = $dbh->prepare($sql);
              $query->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);
              if($query->rowCount() > 0) {
                foreach($results as $result) { ?>  
                    <div class="content-profile-page">
                      <div class="profile-user-page card">
                        <div class="img-user-profile">
                          <img class="profile-bgHome" src="https://imgs.search.brave.com/NVCz9FAgFYUkTO86V5vTpzi55uNSStF0MWw5t7M4iQs/rs:fit:1200:600:1/g:ce/aHR0cDovL3d3dy5s/YW1iZXJ0Z3JvdXBw/cm9kdWN0aW9ucy5j/b20vY2FueW9uL3dv/cmRwcmVzc19mdWxs/X3NjcmVlbl9iYWNr/Z3JvdW5kL2ltYWdl/cy9idWxsZXRzRnVs/bFdpZHRoLzAzX2J1/bGxldHMuanBn" />
                          <img class="avatar" src="https://imgs.search.brave.com/c1pvt2EsKHGzSE6jbSF8bvQHN2z7rS8ZYyA80D-ZLNM/rs:fit:800:836:1/g:ce/aHR0cHM6Ly9wdXJl/cG5nLmNvbS9wdWJs/aWMvdXBsb2Fkcy9s/YXJnZS9wdXJlcG5n/LmNvbS1zdHVkZW50/c3N0dWRlbnRjb2xs/ZWdlLXN0dWRlbnRz/Y2hvb2wtc3R1ZGVu/dHN0dWRlbnRzbWFs/ZS1mZW1hbGUtMTQy/MTUyNjkyNDE2MnNw/MHNmLnBuZw" alt="jofpin"/>
                              </div>
                            <div class="user-profile-data">
                              <h1><?php echo htmlentities($result->FullName);?></h1>
                              <p>Profile Status : <?php if($result->Status==1){?>
                                <span style="color: green">Active</span>
                              <?php } else { ?>
                                <span style="color: red">Blocked</span>
                              <?php }?></p>
                              <p>Personal Access Token: <?php echo htmlentities($result->forgotPin);?></p>
                              <p>Student ID: <?php echo htmlentities($result->StudentId);?></p>
                            </div> 
                            <div class="description-profile">Reg Date : <?php echo htmlentities($result->RegDate);?></div>
                            <div class="description-profile"><?php if($result->UpdationDate!=""){?>
                                    Last Updation Date :<?php echo htmlentities($result->UpdationDate);?>
                                  <?php } ?>
                            </div>
                            <div id="container" align="center">
                              <form name="signup" method="post">
                                <input class="profile-input" type="text" type="text" name="fullanme" value="<?php echo htmlentities($result->FullName);?>" autocomplete="off" required>
                                <input class="profile-input" type="text" name="mobileno" value="<?php echo htmlentities($result->MobileNumber);?>" autocomplete="off" required >
                                <input class="profile-input" type="text" name="email" id="emailid" value="<?php echo htmlentities($result->EmailId);?>"  autocomplete="off" required readonly>
                                <!-- <label for="image">Select an image:</label>
                                <input type="file" name="image" id="image"> -->
                                <button class="profile-input-button" type="submit" name="update">Update Details</button>
                              </form>
                            </div>
                        </div>
                      </div>
                      <?php }
              } ?>


     <!-- CONTENT-WRAPPER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
