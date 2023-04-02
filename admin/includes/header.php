<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #09150A;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarContent">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- <a class="navbar-brand" href="#">
        <img src="assets/img/logo.png" >
      </a> -->
    </div>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="nav navbar-nav navbar-right" style="color: #fff;">
        <li><a href="dashboard.php">DASHBOARD</a></li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
            Categories <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="add-category.php">Add Category</a></li>
            <li><a href="manage-categories.php">Manage Categories</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
            Authors <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="add-author.php">Add Author</a></li>
            <li><a href="manage-authors.php">Manage Authors</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
            Books <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="add-book.php">Add Book</a></li>
            <li><a href="manage-books.php">Manage Books</a></li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
            Issue Books <span class="caret"></span>
          </a>

          <ul class="dropdown-menu">
            <li><a href="requested-books.php">Requested Books</a></li>
            <li><a href="issue-book.php">Issue New Book</a></li>
            <li><a href="manage-issued-books.php">Manage Issued Books</a></li>
          </ul>
        </li>

        <li><a href="reg-students.php" style="color: #fff;">Reg Students</a></li>
        <li><a href="change-password.php" style="color: #fff;">Change Password</a></li>

        <li><a href="logout.php" class="btn btn-danger" style="color: #fff;">LOG ME OUT</a></li>
      </ul>
    </div>
  </div>
</nav>