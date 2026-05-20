# Cafe Staff Management System

A robust PHP & MySQL-backed scheduling application tailored for quick-service coffee shops to manage employee profiles, shift creations, and work allocations securely.

#Key Features
* Role-Based Security: Strict access control middleware (`auth_guard.php`) separating Admin privileges from basic staff access.
* Encapsulated Logic:Offloads business integrity routines directly onto the database engine using MySQL **Stored Procedures**.
* Data Integrity Protection: Complete foreign key cascading preventing Orphaned shift allocations or duplicate records.

# Technology Stack
* Backend: PHP (OOP Matrix using MySQLi Extensions)
* Database: MySQL (Structured Schema Evolution)
* Frontend: Semantic HTML5 with Modular CSS3 Viewports
