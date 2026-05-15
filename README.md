# Library Management System

**Lead Developer:** P.H.H.S. Jayasinghe  
**Module:** Web Application Development  
**Platform:** PHP, MySQL, XAMPP  

---

## 📝 Project Overview
The **Library Management System** is a web-based application designed to digitalize and automate the core functions of a library. It provides a centralized platform for administrators to manage users, book inventories, member records, and financial penalties (fines) with built-in data validation and security.

## 🚀 Key Features

The system supports full **CRUD** (Create, Read, Update, Delete) operations across the following modules:

* **User Management**: Secure Sign-up and Login for administrators with specific ID formatting.
* **Book Inventory**: Add, update, and categorize books within the library system.
* **Member Management**: Maintain detailed records of library members.
* **Issue & Tracking**: Track borrowed books and monitor return deadlines.
* **Fine Management**: Record and track fines for overdue returns.
* **Data Validation**: Implemented strict validation for User IDs (max 5 characters) and Passwords (min 8 characters) to ensure system integrity.

## 🛠️ Technology Stack

* **Backend:** PHP (Server-side logic)
* **Database:** MySQL / MariaDB (Relational database)
* **Frontend:** HTML5, CSS3, JavaScript
* **Server Environment:** XAMPP (Apache & MySQL)
* **Version Control:** Git & GitHub

## ⚙️ Installation & Setup

To run this project locally on your machine, follow these steps:

1.  **Clone the Repository**:
    ```bash
    git clone [https://github.com/your-username/Library-Management-System.git](https://github.com/your-username/Library-Management-System.git)
    ```
2.  **Move Project Files**: Copy the project folder into your XAMPP installation directory:
    * **Windows:** `C:/xampp/htdocs/`
    * **macOS:** `/Applications/XAMPP/xamppfiles/htdocs/`
3.  **Database Configuration**:
    * Start **Apache** and **MySQL** via the XAMPP Control Panel.
    * Go to `http://localhost/phpmyadmin/`.
    * Create a new database named `library_management_system`.
    * Select the database and click the **Import** tab.
    * Choose the `database.sql` file from the project root and click **Go/Import**.
4.  **Launch the Application**:
    * Open your browser and type: `http://localhost/Library-Management-System/`

## 📊 Database Schema
The database consists of the following primary tables:
* `user`: Administrative credentials.
* `book`: Inventory details.
* `member`: User profiles for library members.
* `bookcategory`: Classification of books.
* `bookborrower`: Transaction records for issued books.
* `fine`: Penalty records.

## 👤 Developer
* **Name:** P.H.H.S. Jayasinghe
* **Contribution:** Lead Developer 

---
*Developed for the Final Web Application Development P.H.H.S Jayasinghe.*
