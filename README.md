# 🚗 Car Dynamic – Toyota Vehicle Showcase & Test Drive Management System

A web-based automobile showroom platform developed using PHP and MySQL. The system allows users to explore Toyota vehicle models, view car details, register accounts, and schedule test drives online. Administrators can manage customer test drive requests and monitor bookings through an admin dashboard.

---

## 📖 Overview

Car Dynamic is a vehicle showcase and test drive management system designed to provide a seamless experience for customers interested in Toyota vehicles. Users can browse available models, view specifications, schedule test drives, and track request statuses, while administrators manage customer interactions efficiently.

---

## ✨ Features

### 👤 Customer Features
- User Registration
- Secure Login & Logout
- Browse Toyota Vehicle Models
- View Vehicle Details & Images
- Request Test Drives
- Track Test Drive Status
- Manage Account Information

### 👨‍💼 Admin Features
- Admin Login
- View Test Drive Requests
- Update Request Status
- Manage Customer Requests
- Monitor Bookings
- Dashboard Access

---

## 🚘 Available Vehicle Models

- Toyota Glanza
- Toyota Rumion
- Toyota Innova
- Toyota Innova Crysta
- Toyota Innova Hycross
- Toyota Fortuner
- Toyota Camry
- Toyota Vellfire
- Toyota Hilux
- Toyota Urban Cruiser
- Toyota Corolla Altis
- Toyota Yaris
- Toyota Legender

---

## 🛠️ Technologies Used

| Technology | Purpose |
|------------|----------|
| HTML5 | Frontend Structure |
| CSS3 | Styling |
| JavaScript | Client-Side Functionality |
| PHP | Backend Development |
| MySQL | Database Management |
| Apache | Local Server (XAMPP/WAMP) |

---

## 📂 Project Structure

```text
Car-Dynamic/
│
├── Car Dynamic/
│   ├── index.php
│   ├── login.php
│   ├── signup.php
│   ├── logout.php
│   ├── admin.php
│   ├── navbar.php
│   ├── db.php
│   ├── model.php
│   ├── request_test_drive.php
│   ├── submit_test_drive.php
│   ├── view_test_drives.php
│   ├── update_test_drive.php
│   ├── cancel_test_drive.php
│   ├── test_drive.php
│   ├── status.php
│   ├── css/
│   ├── js/
│   ├── models/
│   └── images/
│
└── DataBase/
    └── toyota_showcase.sql
```

---

## ⚙️ Installation Guide

### Step 1: Clone Repository

```bash
git clone https://github.com/yourusername/car-dynamic.git
```

### Step 2: Move Project Folder

For XAMPP:

```text
C:\xampp\htdocs\
```

For WAMP:

```text
C:\wamp64\www\
```

### Step 3: Create Database

Open phpMyAdmin and create a database:

```sql
CREATE DATABASE toyota_showcase;
```

### Step 4: Import Database

Import:

```text
toyota_showcase.sql
```

### Step 5: Configure Database Connection

Open:

```php
db.php
```

Update database credentials if necessary:

```php
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "toyota_showcase";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
```

### Step 6: Run Application

Open browser:

```text
http://localhost/Car Dynamic/
```

---

## 🔑 System Modules

### Vehicle Showcase
- Browse Toyota Models
- Vehicle Information Display
- Image Gallery
- Model Details

### Customer Management
- Registration System
- User Authentication
- Session Management

### Test Drive Management
- Request Test Drive
- Update Booking Status
- Cancel Requests
- View Booking History

### Administration
- Manage Test Drive Requests
- Customer Monitoring
- Request Approval System

---

## 💾 Database

Database Name:

```text
toyota_showcase
```

Possible Main Tables:

```sql
users
vehicles
test_drives
admins
bookings
```

---

## 🚀 Future Enhancements

- Online Vehicle Comparison
- Advanced Search & Filters
- Email Notifications
- SMS Test Drive Confirmation
- Vehicle Inquiry System
- Admin Analytics Dashboard
- Responsive Mobile Interface
- Online Vehicle Booking

---

## 🎓 Academic Purpose

This project was developed for educational purposes and demonstrates:

- PHP Web Development
- MySQL Database Integration
- Authentication Systems
- CRUD Operations
- Booking Management Systems
- Dynamic Web Applications

---

## 👨‍💻 Developer

### Aswin Sreenivas

Diploma in Computer Engineering

#### Connect

GitHub:
https://github.com/yourusername

Portfolio:
https://yourportfolio.com

---

## 📜 License

This project is developed for educational and learning purposes.

---

⭐ If you found this project useful, consider giving it a star on GitHub.
