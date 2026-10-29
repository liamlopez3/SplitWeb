# SplitWeb

SplitWeb is a web application for managing shared expenses within a group,
such as flatmates or a trip with friends. It records who paid for each expense,
computes every member's balance, and lets the group settle up and start a new
accounting period from zero.

Developed for the *Web Technologies* course (University of Valladolid).

## Features

- User registration and login with hashed passwords
- Register expenses, split equally among all registered users
- Chronological list of active expenses, with filtering by payer and by
  concept keywords
- Only the payer can cancel an expense
- Balance panel: `balance = total paid by the user - share of all active expenses`
- "Settle up" action that closes all active expenses and resets balances to 0 €

> **Status:** work in progress. See the roadmap below.

## Tech stack

- **Backend:** PHP, PDO
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, BootStrap 3
- **Server:** Apache (LAMP stack on Ubuntu Server)

## Data model

Two tables, related 1:N (one user pays many expenses):

- `Users` (`email` PK, `password_hash`, `full_name`, `nickname`)
- `Expenses` (`id` PK, `payer_email` FK, `concept`, `amount`,
  `registration_date`, `is_settled`)

Balances and shares are derived from the expenses and are not stored.
The full schema is in `assets/sql/schema.sql`.

## Project structure

    index.php              front controller: single entry point for every page (?seccion=...)
    assets/                static files served to the browser
      css/                 stylesheets
      js/                  client-side scripts
    inc/                   shared code (initialisation, page template, alerts, helpers)
    src/
      controladores/       handle form submissions (POST), validate and redirect (PRG)
      modelos/             database access with PDO prepared statements
      vistas/              HTML views, grouped by entity (usuario/, gasto/)

All pages are rendered through `index.php`, which loads the template and the
requested view. Form submissions go to a controller in `src/controladores/`,
which always ends with a 303 redirect (Post/Redirect/Get pattern).

## Security approach

- Passwords hashed with `password_hash()` and checked with `password_verify()`
- Prepared statements (PDO) against SQL injection
- Server-side validation of every form
- Output escaping with `htmlspecialchars()` against XSS
- Session cookie with `HttpOnly` and `SameSite=Lax`; session ID regenerated on login
- `inc/` folder blocked from direct web access (`.htaccess`)
- Database credentials kept out of the repository (`.gitignore`)
- Application database user limited to the privileges it needs
- *(planned)* Session checks on every private page

## Roadmap

- [x] LAMP environment and database schema
- [x] Database connection and page template
- [x] User registration and login
- [x] Expenses: create, list and cancel
- [x] Front controller and MVC folder structure
- [ ] Logout and session checks on private pages
- [ ] Payer taken from the session; only the payer can cancel an expense
- [ ] Balance and settle-up
- [ ] Real-time filtering and responsive layout
- [ ] Security review and technical report

## Setup

1. Create the database and tables:
   `mysql -u <admin> -p < assets/sql/schema.sql`
2. Create a MySQL user for the application with only `SELECT`, `INSERT`,
   `UPDATE` and `DELETE` privileges on the `splitweb` database.
3. Copy `inc/db.example.php` to `inc/db.php` and fill in your credentials.
4. Serve the project with Apache and PHP. The `.htaccess` files in `inc/`
   and `assets/sql/` block direct access to those folders.
5. Open `index.php` in the browser.

## AI usage statement

Generative AI tools were used as a learning aid, in line with the course policy.
Details are included in the project report.
