# PHP E-Commerce Store

A multi-step e-commerce web application built with vanilla PHP, focused on server-side session management, a clean state-machine flow for checkout, and a full admin dashboard for managing inventory.

This project was built as a hands-on learning exercise to practice core PHP concepts — sessions, arrays, functions, form handling, and server-side validation — before moving on to OOP PHP and Laravel.

## Features

### Authentication
- **Sign up** — new customers can create an account
- **Login** — returning customers log in with their credentials
- **Password reset** — a user can reset their password by entering their email; if the email exists in the system, a new password is generated for the account directly (see [Security Notes](#security-notes) below)

### Customer flow
- **Category browsing** — select one or more product categories from a dynamic list
- **Price checking** — view items, prices, and available stock for the chosen categories
- **Shopping cart** — select specific items and quantities, with live stock limits (`min`/`max`) enforced on quantity inputs
- **Server-side validation** — quantities are checked against available stock before anything is added to the order; empty selections are rejected with a clear error message
- **Receipt generation** — a summary of chosen items, quantities, and total price before final confirmation
- **Stock deduction** — confirmed orders reduce the available quantity in the stored inventory
- **Wish list** — customers can submit a category/item they wish the store carried, even if it's not currently in stock

### Admin panel
- **Add products** — create new products under any category
- **Edit products** — update the price or available quantity of an existing product
- **Delete products** — remove a product entirely
- **Low stock alerts** — a warning is shown when a product's quantity drops below a set threshold
- **View orders** — browse the receipts generated from completed customer purchases
- **View wish list** — see items customers have requested but the store doesn't carry

## How it works

The customer flow is built around a **session-based step state machine**: `$_SESSION['step']` tracks which stage of the flow the user is in (`choose Categories`, `check prices`, `choose what to pay`, `last step`, `done`, etc.). Each step has a dedicated handler function that processes the incoming POST request and transitions to the next step. The view file (`client-page.php`) then renders the correct form based on the current step.

This avoids scattering boolean flags across the code and keeps each stage's logic isolated and easy to follow. The admin panel follows the same general pattern for managing products, orders, and the wish list.

## Tech stack

- **PHP** (procedural, no framework)
- **PHP Sessions** for state management — all data (products, users, orders) currently lives in `$_SESSION`, no database yet
- **HTML/CSS** for the front end

## Project structure

```
index.php           # Sign up / login entry point
reset-password.php  # Password reset flow
client.php           # Customer request handling, step routing, and business logic
client-page.php      # Customer HTML views for each step
admin.php            # Admin request handling and logic
admin-page.php       # Admin HTML views (products, orders, wish list)
```

## Running locally

1. Requires PHP with a local server such as XAMPP or `php -S`
2. Place the project folder in your server's web root (e.g. `htdocs/` for XAMPP)
3. Start the server and navigate to `index.php` in your browser

```bash
php -S localhost:8000
```

## Security notes

This is a learning project, not a production system, and a few things are intentionally simplified for now:

- **Password reset** currently generates a new password directly in-browser instead of emailing a reset code/link. This was a deliberate trade-off to focus on learning core PHP first — sending real emails requires an external library (like PHPMailer), which is planned once OOP PHP and Composer are covered.
- **No database yet** — all data (users, products, orders, wish list) is stored in the PHP session, so it resets when the session ends. Moving this to MySQL is the next step on the roadmap.
- No CSRF protection, rate limiting, or password hashing review has been done yet — these are known gaps, not oversights.

## Status

The customer-facing flow and the admin panel are both functionally complete. Next steps: move data storage from sessions to a MySQL database and refactor into OOP PHP.

## Author

Built by Ahmed as part of a self-directed path into backend web development.
