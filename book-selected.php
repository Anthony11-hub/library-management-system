<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:index.php');
}
else
{ 
    if(isset($_POST['update']))
    {
        $bookImage=$_POST['bookImage'];
        $bookname=$_POST['bookname'];
        $category=$_POST['category'];
        $author=$_POST['author'];
        $isbn=$_POST['isbn'];
        $BookDescription=$_POST['BookDescription'];
        $bookid=intval($_GET['bookid']);
        $keywords=$_POST['keywords'];
        $studentid=intval($_GET['studentid']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/recommends.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/book.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<body>
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

<?php 
    $bookid=intval($_GET['bookid']);
    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookDescription,tblbooks.id as bookid,tblbooks.bookImage,tblbooks.isIssued, tblbooks.Status, tblbooks.Link from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
    $query = $dbh -> prepare($sql);
    $query->bindParam(':bookid',$bookid,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0)
    {
        foreach($results as $result)
        {               
    ?>  

  <!-- About Start -->
  <div class="container-fluid py-5" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 pb-4 pb-lg-0">
                <img class="img-fluid rounded " src="admin/bookimg/<?php echo htmlentities($result->bookImage);?>" width="300" alt="book image">
            </div>
            <div class="col-lg-7">
                <h3 class="mb-4">Book Decription</h3>
                <p><?php echo htmlentities($result->BookDescription);?>.</p>
                <div class="row mb-3">
                    <div class="col-sm-6 py-2"><h6>Book Name: <span ><?php echo htmlentities($result->BookName);?></span></h6></div>
                    <div class="col-sm-6 py-2"><h6>Author: <span ><?php echo htmlentities($athrname=$result->AuthorName);?></span></h6></div>
                    <div class="col-sm-6 py-2"><h6>Category: <span ><?php echo htmlentities($catname=$result->CategoryName);?></span></h6></div>
                    <!-- <div class="col-sm-6 py-2"><h6>Experience: <span >Not yet</span></h6></div> -->
                    <div class="col-sm-6 py-2"><h6>ISBN: <span ><?php echo htmlentities($result->ISBNNumber);?></span></h6></div>
                    <?php if($result->isIssued=='1'): ?>
                    <div class="col-sm-6 py-2" style="color:red;"><h6>Availability: <span class="text-secondary">Book Issued</span></h6></div>
                    <?php endif;?>
                </div>
                <?php }} ?>
                  
                <?php if($result->Status=='1'): ?>
                  <a href="<?php echo htmlentities($result->Link);?>" class="btn blue btn-outline-primary mr-4" target="_blank">Read Ebook</a>
                <?php endif;?>  
                <a href="request-book.php" class="btn blue btn-outline-primary mr-4">Request Book</a>
            </div>
        </div>
    </div>
</div>



  <h2 style="margin-left:70px;">You might also like</h2>
    <?php 
    $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.id AS bookid, tblbooks.bookImage
    FROM tblbooks 
    JOIN tblcategory ON tblcategory.id = tblbooks.CatId 
    JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId 
    WHERE tblcategory.id = (SELECT CatId FROM tblbooks WHERE id = $bookid) AND tblbooks.id != $bookid 
    LIMIT 4";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
        ?>
        <div class="row">
            <?php
            foreach ($results as $result) {
            ?>
                <div class="col-1-of-4">
                    <div class="card">
                        <img src="admin/bookimg/<?php echo htmlentities($result->bookImage); ?>" alt="<?php echo htmlentities($result->BookName); ?>" width="100%" height="200">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo htmlentities($result->BookName); ?></h3>
                            <p class="card-text">Author: <?php echo htmlentities($result->AuthorName); ?></p>
                        </div>
                    </div>
                    <a href="book-selected.php?bookid=<?php echo htmlentities($result->bookid);?>" class="button">view book</a>
                </div>
            <?php
            }
            ?>
        </div>
    <?php
    } else {
        echo "No results found";
    }
?>


<footer>
  <h2>Library Management System</h2>
</footer>

</body>
</html>
<?php } ?>