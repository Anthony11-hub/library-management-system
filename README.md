# Library Management System
This is a simple library management system built with PHP and MySQL. It allows librarians to manage books, borrowers, and loans, and provides a simple web interface to search for books.


# Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed XAMPP server on your local machine.
- You have created a new MySQL database and updated the database connection settings in the config.php file with your MySQL database credentials.

# Installation
1. Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/library-management-system.git
```

- Copy the library-management-system folder to the htdocs folder in your XAMPP installation directory.

- Start the Apache and MySQL modules in XAMPP control panel.

- Import the database.sql file in the project root to create the necessary tables in your MySQL database.

- Navigate to http://localhost/library-management-system in your web browser to access the library management system.


# Usage
# Librarian Interface

The librarian interface allows librarians to manage books, borrowers, and see requests.
Adding Books

- Click the "Books" link in the navigation menu.

- Click the "Add Book" button.

- Fill out the form with the book's title, author, ISBN, and other details.

- Click the "Save" button to add the book to the library's collection.

Managing Borrowers

- Click the "Borrowers" link in the navigation menu.

- Click the "Add Borrower" button.

- Fill out the form with the borrower's name, email, phone number, and other details.

- Click the "Save" button to add the borrower to the library's records.


Student Interface

The Student interface allows student to search for books and request books.
Searching for Books

- Click the "Search" link in the navigation menu.

- Enter keywords or phrases in the search box.

- Click the "Search" button to find books that match your search criteria.

- Click the "Request Book" button next to a book to request a loan.

Managing Books

- Click the "My Books" link in the navigation menu.

- View a list of the Books you have requested and their current status.

Credits

This library management system was built by Anthony Mwaura and is released under the MIT License. If you have any questions or suggestions, please contact me at tonycomputers6@gmail.com.
