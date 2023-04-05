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
    <title>Online Library Management System | User Dash Board</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<script>
    function searchBooks() {
    // Get the search query from the input field
    var searchQuery = document.getElementById("search-input").value.toLowerCase();

    // Get all the book cards
    var bookCards = document.getElementsByClassName("col-1-of-4");

    // Loop through all the book cards and hide/show them based on the search query
    for (var i = 0; i < bookCards.length; i++) {
        var bookName = bookCards[i].querySelector(".card-title").innerText.toLowerCase();
        var authorName = bookCards[i].querySelector(".card-text:first-of-type").innerText.toLowerCase();
        var category = bookCards[i].querySelector(".card-text:last-of-type").innerText.toLowerCase();

        if (bookName.indexOf(searchQuery) > -1 || authorName.indexOf(searchQuery) > -1 || category.indexOf(searchQuery) > -1) {
            bookCards[i].style.display = "block";
        } else {
            bookCards[i].style.display = "none";
        }
    }
}

</script>
<body>
    <header id="" class="header-2">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="issued-books.php">My Books</a></li>
                <li><a href="my-profile.php">Profile</a></li>
                <li><a href="change-password.php">Change Password</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
        <div class="wrap-2">
        <div class="search">
                <input type="text" id="search-input" class="search__term" placeholder="what are you looking for?" onkeyup="if (event.keyCode === 13) { searchBooks(); }">
                <button type="submit" class="search__button" onclick="searchBooks()">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </header>

<!-- navbar -->



<!-- MENU SECTION END-->
<?php
    $sql = "
        SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, 
            tblbooks.ISBNNumber, tblbooks.BookDescription, tblbooks.id AS bookid, 
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
                            <p class="card-text">ISBN: <?php echo htmlentities($result->ISBNNumber); ?></p>
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

     <!-- CONTENT-WRAPPER SECTION END-->
<?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
