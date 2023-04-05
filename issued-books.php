<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{ 



    ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online Library Management System |  Issued Books</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <!-- <link href="assets/css/bootstrap.css" rel="stylesheet" /> -->
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- DATATABLE STYLE  -->
    <!-- <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" /> -->
    <!-- CUSTOM STYLE  -->
    <!-- <link href="assets/css/style.css" rel="stylesheet" /> -->
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <!-- <link rel="stylesheet" href="assets/css/select.css"> -->
    <link rel="stylesheet" href="assets/css/issued.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    $sid = $_SESSION['stdid'];
    $sql = "SELECT 
                tblbooks.BookName,
                tblbooks.bookImage,
                tblbooks.ISBNNumber,
                tblbooks.BookDescription,
                tblissuedbookdetails.IssuesDate,
                tblissuedbookdetails.ReturnDate,
                tblissuedbookdetails.id as rid,
                tblissuedbookdetails.fine
            FROM 
                tblissuedbookdetails 
                JOIN 
                tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
                JOIN 
                tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
            WHERE 
                tblstudents.StudentId = :sid 
            ORDER BY 
                tblissuedbookdetails.id DESC";
                                      
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    //   BookName, ISDNNumber, IssuesDate
    if ($query->rowCount() > 0) {
        foreach ($results as $result) {
?>   

    <div class="card">
        <div class="additional">
            <div class="user-card">
            <img src="admin/bookimg/<?php echo htmlentities($result->bookImage);?>" alt=""width="149" height="270">
            </div>
            <div class="more-info">
            <h1>Book Details</h1>
            <div class="coords">
                <span>ISBN: <span ><?php echo htmlentities($result->ISBNNumber);?></span>
            </div>
            <div class="coords">
                <span>Issue Date: <?php echo htmlentities($result->IssuesDate);?></span>
            </div>
            <div class="coords">
                <span>Return Date: <?php
                                    if ($result->ReturnDate == "") {
                                    ?>
                                                <span style="color:red">
                                                    <?php echo htmlentities("Not Return Yet"); ?>
                                                </span>
                                    <?php
                                            } else {
                                                echo htmlentities($result->ReturnDate);
                                            }
                                    ?>
                </span>
            </div>
            <div class="coords">
                <span>Fine: <?php echo htmlentities($result->fine);?></span>
            </div>
            <!-- <div class="stats">
                <div>
                <div class="title">Category</div>
                <i class="fa fa-trophy"></i>
                <div class="value">Self Improvement</div>
                </div>
                <div>
                <div class="title">Author</div>
                <i class="fa fa-group"></i>
                <div class="value"></div>
                </div>
            </div> -->
            </div>
        </div>
        <div class="general">

            <h1><?php echo htmlentities($result->BookName);?></h1>
            <p><?php echo htmlentities($result->BookDescription);?></p>
        </div>
        </div>

        <?php }} ?>

                                
                                         

     <!-- CONTENT-WRAPPER SECTION END-->
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>

</body>
</html>
<?php } ?>
