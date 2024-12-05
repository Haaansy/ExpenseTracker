# Expense Tracker

An intuitive web application for tracking expenses and incomes, built using **PHP**, **SQL**, and **XAMPP**. This app allows users to manage their financial data efficiently, with features like secure authentication, automated balance computation, and transaction history management.

---

## Features

- **Authentication System**: Register and log in securely to access your saved transactions from any device.
- **Automated Balance Calculation**: Real-time updates of the current balance based on transaction data.
- **Transaction Management**: Add, edit, and delete transactions with ease.

---

## Tech Stack

- **Backend**: PHP
- **Database**: SQL (MySQL via XAMPP)
- **Frontend**: HTML, CSS, JavaScript
- **Server**: XAMPP (Localhost)

---

## Setup Guide

### Prerequisites

Ensure the following tools are installed on your system:

- [XAMPP](https://www.apachefriends.org/index.html) (for Apache and MySQL)
- A web browser (e.g., Chrome, Firefox)
- A text/code editor (e.g., VS Code, Sublime Text)

---

### Steps to Set Up the Application

1. **Clone the Repository**  
   Clone this repository to your local machine using the following command:

   ```bash
   git clone https://github.com/Haaansy/expensetracker.git

### Start XAMPP

1. Open XAMPP and start the **Apache** and **MySQL** services.

### Import the Database

2. Open **phpMyAdmin** by navigating to `http://localhost/phpmyadmin` in your browser.
3. Create a new database named `user_system`.
4. Import the database file provided in the `sqldb` folder of this repository.

### Move Files to XAMPP's Root Directory

5. Copy the cloned project folder and paste it into the `htdocs` directory of your XAMPP installation.  
   `C:\xampp\htdocs\ExpenseTracker`

### Configure Database Connection

6. Open the file `db_config.php`, in your project folder.
7. Update the database credentials as needed:
   ```php
   <?php
     $host = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $database = "user_system";
   ?>
   
### Run the Application

8. In your browser, navigate to:
```bash
  http://localhost/ExpenseTracker
```

You should see the application's landing page.

## Test the Application

1. Register a new account.
2. Log in using your credentials.
3. Add new transactions by specifying the category (income/expense), amount, and description.
4. Edit or delete transactions to verify all features are working as expected.

