# Idea Management Portal

A web-based portal for students and faculty of Mangalore Institute of Technology & Engineering (MITE) to submit, manage, and review innovative ideas.

## Features

- Student and faculty registration and login
- Student dashboard for idea submission and team management
- Faculty dashboard for reviewing and providing feedback on ideas
- Dynamic team and domain selection
- Profile management for students and faculty
- Responsive UI with HTML, CSS, and JavaScript
- Backend with PHP and MySQL

## Project Structure

- `index.html` – Landing page
- `login.html`, `signup.html` – Authentication pages
- `student_dashboard.html`, `student_home.html`, `student_profile.php` – Student portal
- `faculty_dashboard.html`, `faculty_dashboard.php` – Faculty portal
- `db.php` – Database connection
- `*.js`, `*.css` – Frontend scripts and styles
- `ideamanagementportal.sql` – Database schema

## Setup Instructions

1. **Database Setup:**
   - Import `ideamanagementportal.sql` into your MySQL server:
     ```sh
     mysql -u root -p < ideamanagementportal.sql
     ```
   - Update database credentials in `db.php` if needed.

2. **Run the Application:**
   - Place the project folder in your web server directory (e.g., `htdocs` for XAMPP).
   - Start Apache and MySQL.
   - Open `http://localhost/idea_management/index.html` in your browser.

## Usage

- **Students:** Register, log in, submit ideas, form teams, and manage your profile.
- **Faculty:** Log in, view assigned domains, review student ideas, and provide feedback.

## Screenshots

_Add screenshots of the main pages here._
