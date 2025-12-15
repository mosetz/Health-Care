# Health-Care

A small PHP-based web application created as an assignment for the Web-Based Information Systems Development (Com-Sci) class. The system demonstrates basic healthcare workflows such as moving (reassigning) appointments between staff and deleting prescriptions. It's intended as a learning project and a starter template for further development.

**Status:** Student assignment / demo — suitable for study and extension (not production-ready).

**Key Features**
- Reassign appointments to other staff members (move appointment)
- Delete prescriptions via application actions
- Simple PHP pages implementing basic workflows
- Database connection helper for MySQL
- Client-side interactions with JavaScript and styling with CSS

**Technologies**
- SQL (MySQL/MariaDB)
- PHP
- JavaScript
- HTML
- CSS

**Requirements**
- PHP 7.4+ (or compatible)
- MySQL or MariaDB (SQL database)
- A web server (Apache, Nginx) or the PHP built-in server

**Quick Setup**
1. Clone the project 
2. Create a MySQL database and user for the application.
3. Edit `DBconnect.php` and set your database host, name, user, and password.
4. Start your web server and open `index.php` in a browser.

Example using PHP built-in server (from the project folder):

```powershell
php -S localhost:8000
```

Then visit: http://localhost:8000/index.php

**Files Overview**
- `DBconnect.php` : Database connection helper — configure credentials here.
- `index.php` : Main entry / landing page.
- `staff.php` : Staff listing or staff-facing page.
- `delegate.php` : Delegation / task assignment page.
- `move.php` : Script used to move/reassign appointments between staff.
- `style.css` : Basic styles used by the pages.

**Usage Notes**
- The project contains minimal validation and no authentication; add user management and input sanitization before using in production.
- Use prepared statements or an ORM to avoid SQL injection when expanding functionality.

**Development**
- Extend the UI in `style.css` and the PHP pages.
- Add routing, templating, or a micro-framework for cleaner structure.
- Add authentication and role-based access control before real-world use.

**License & Attribution**
This repository is provided as-is for educational or starter use. Add a `LICENSE` file if you plan to redistribute.

**Author / Contact**
Repository: mosetz/Health-Care

If you'd like, I can add a sample configuration to `DBconnect.php`, create a basic install script, or add a `.gitignore` and `LICENSE` file — tell me which you'd prefer next.
