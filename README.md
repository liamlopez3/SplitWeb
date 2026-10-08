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
- **Frontend:** HTML, CSS, JavaScript
- **Server:** Apache (LAMP stack on Ubuntu Server)

## Data model

Two tables, related 1:N (one user pays many expenses):

- `Users` (`email` PK, `password_hash`, `full_name`, `nickname`)
- `Expenses` (`id` PK, `payer_email` FK, `concept`, `amount`,
  `registration_date`, `is_settled`)

Balances and shares are derived from the expenses and are not stored.
The full schema is in `db/schema.sql`.

## Project structure

    css/    stylesheets
    js/     client-side scripts
    inc/    shared logic (initialisation, database connection, page template)

Each page processes its logic first and renders HTML afterwards, and all form
submissions follow the Post/Redirect/Get pattern.

## Security approach

- Passwords hashed with `password_hash()`
- Prepared statements (PDO) against SQL injection
- Output escaping against XSS
- Session checks on every private page
- Application database user limited to the privileges it needs

## Roadmap

- [x] LAMP environment and database schema
- [ ] Database connection and page template
- [ ] Registration and login
- [ ] Expense management
- [ ] Balance and settle-up
- [ ] Real-time filtering and responsive layout
- [ ] Security review and technical report

## Setup

1. Create the database: `mysql -u <admin> -p < db/schema.sql`
2. Create a limited MySQL user for the application.
3. Copy `inc/db.example.php` to `inc/db.php` and fill in your credentials.
4. Serve the project with Apache and PHP.

## AI usage statement

Generative AI tools were used as a learning aid, in line with the course policy.
Details are included in the project report.
