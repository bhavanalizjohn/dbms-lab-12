# Employee Project Assignment – DBMS Lab Mini Project

- Name: **Bhavana Liz John**
- Roll Number: **12**
- Question Number: **12**
- Project Title: **Employee Project Assignment**
- Database: **company_db**

## Project files

- `db.php` – connects the PHP pages to the MySQL database.
- `assign.php` – displays the assignment form and inserts submitted data into the `assignment` table.
- `report.php` – retrieves and displays assignment details by joining the `employee`, `project` and `assignment` tables.
- `company_db.sql` – creates the database and tables and inserts five sample employees and five sample projects.
- `style.css` – provides basic page styling.
- `screenshots/` – add the required screenshots after running the project.

## How it works

The PHP pages include `db.php` to connect to the MySQL database named `company_db`.
The `assign.php` page displays employees and projects from their respective master tables.
When the form is submitted, a prepared `INSERT` query saves the employee ID, project ID, role and assigned date in the `assignment` table.
The `report.php` page executes a `SELECT` query with `INNER JOIN` operations on all three tables.
The joined records are displayed in an HTML table, and navigation links connect the entry and report pages.

## Setup

1. Install XAMPP and start Apache and MySQL.
2. Open `http://localhost/phpmyadmin`.
3. Import `company_db.sql` using the Import tab.
4. Copy this project folder into `C:\\xampp\\htdocs\\dbms-lab-12`.
5. Open `http://localhost/dbms-lab-12/assign.php`.

## Screenshots to add

The following screenshots demonstrate the working project:
1. `01-assignment-form.png` – assignment entry form.
2. `02-success-message.png` – form after a successful assignment submission.
3. `1. 03-report.png` – report showing the joined assignment data.

## GitHub submission

Create a **Public** repository named `dbms-lab-12`, then upload all project files, the exported SQL file and the screenshots folder.
