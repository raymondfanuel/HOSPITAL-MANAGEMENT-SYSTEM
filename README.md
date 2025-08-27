# 🏥 Hospital Management System (HMS)

This project is a **Hospital Management System (HMS)** developed using **PHP, MySQL, HTML, CSS, and JavaScript**.  
It is designed to digitalize hospital workflows and improve efficiency by providing different modules for hospital staff roles.

---

## 🚀 Features by Role

### 👩‍💼 Receptionist
- Register new patients  
- View patients  
- Book appointments  

### 👩‍⚕️ Nurse
- View patient info  
- Update and manage **vital signs**  
- Assist with patient medical records  

### 👨‍⚕️ Doctor
- Access patient history  
- Write notes/observations  
- Prescribe medicine  

### 🔬 Laboratory
- Manage lab test requests  
- Input and update test results  

### 💊 Pharmacy
- Manage medicine inventory  
- Dispense prescribed drugs  
- Track prescriptions  

### 💰 Accountant
- Billing management  
- Payment records  
- Generate invoices and financial reports  

---

## 🗂️ Database Structure

The system uses a **MySQL database** with tables including (but not limited to):

- `users` – Stores login details & role info  
- `patients` – Patient registration records  
- `appointments` – Appointment booking records  
- `vital_signs` – Patient vital signs updated by nurses  
- `medical_records` – History, notes, and prescriptions  
- `lab_tests` – Lab test requests & results  
- `pharmacy` – Medicine inventory & dispensing info  
- `billing` – Payments and invoices  

---

## ⚙️ Tech Stack

- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP (Procedural)  
- **Database:** MySQL  
- **Server:** XAMPP / LAMP / WAMP  

---

## 📂 Project Structure

-hospital-management-system/
-│
-├── index.html # Login page
-├── db.php # Database connection
-│
-├── receptionist/ # Receptionist module
-│ ├── dashboard.php
-│ ├── register-patient.php
-│ ├── view-patients.php
-│ ├── book-appointment.php
-│
-├── nurse/ # Nurse module
-│ ├── dashboard.php
-│ ├── view-patients.php
-│ ├── update-vitals.php
-│
-├── doctor/ # Doctor module
-│ ├── dashboard.php
-│ ├── patient-history.php
-│ ├── prescribe-medicine.php
-│
-├── laboratory/ # Lab module
-│ ├── dashboard.php
-│ ├── request-tests.php
-│ ├── input-results.php
-│
-├── pharmacy/ # Pharmacy module
-│ ├── dashboard.php
-│ ├── manage-inventory.php
-│ ├── dispense-medicine.php
-│
-├── accountant/ # Accountant module
-│ ├── dashboard.php
-│ ├── billing.php
-│ ├── invoices.php
-│
-└── assets/ # CSS, JS, images


---

## 🛠️ Setup Instructions

1. **Clone the repository**
   ```bash
   git clone https://github.com/raymondfanuel/HOSPITAL-MANAGEMENT-SYSTEM.git
   cd HOSPITAL-MANAGEMENT-SYSTEM


Set up the database

Create a database in MySQL (e.g., hospital_db)

Import the SQL dump file provided (db.sql)

Configure connection

Open db.php

Update database credentials (host, username, password, dbname)

Run the project

Place the project folder inside htdocs (XAMPP) or /var/www/html (LAMP)

Start Apache & MySQL

Visit in browser:

http://localhost/hospital-management-system/

🔑 Default Login Roles (Demo)
Role	Username	Password
Receptionist	receptionist	12345
Nurse	nurse	12345
Doctor	doctor	12345
Laboratory	lab	12345
Pharmacy	pharmacy	12345
Accountant	accountant	12345

(These are for testing; update/change in production.)

---
👨‍💻 Developer

Name: Raymond

Institute: Dar es Salaam Institute of Technology

Role: Fullstack Developer

---
📜 License

This project is licensed under the MIT License – feel free to use, modify, and distribute.

---

