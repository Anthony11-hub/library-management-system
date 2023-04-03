<?php
session_start();
error_reporting(0);
include('includes/config.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
    
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poor+Story&display=swap" rel="stylesheet"> 
    <script src="script.js" defer></script>
</head>
<body>
    <header id="" class="header">
        <div class="header__img"></div>
        <div class="header__text-box">
            <h1 class="heading-primary">
                <span class="heading-primary--main">LibraryForU</span>
                <span class="heading-primary--sub" style="font-family: 'Poor Story' ;">A library management system for chuka uni students</span>
            </h1>
        </div>
        <div class="header__btn-box">
            <a href="adminlogin.php" class="btn btn--brown">Admin</a>
            <a href="user-login.php" class="btn btn--brown">Student</a>
        </div>
    </header>
    <section class="books-section">
        <div class="wrap">
            <div class="search">
                <input type="text" class="search__term" placeholder="what are you looking for?">
                <button type="submit" class="search__button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </section>
<!-- youtube code to solve this BS -->

    <?php
    $sql = "
        SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, 
            tblbooks.ISBNNumber, tblbooks.id AS bookid, 
            tblbooks.bookImage, tblbooks.isIssued 
        FROM tblbooks 
        JOIN tblcategory ON tblcategory.id = tblbooks.CatId 
        JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId";
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
                            <p class="card-text">Category: <?php echo htmlentities($result->CategoryName); ?></p>
                        </div>
                    </div>
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
        <p class="heading-primary--sub">library Management System</p>
    </footer>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
