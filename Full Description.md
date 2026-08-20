# Store Management System

A PHP-based store management system for managing products, inventory, customer purchases, sales, and customer wishes.

The current version uses **PHP Sessions** for data storage and application state.

---

## 📌 Overview

The system provides two types of accounts:

* **Client** — browses products, makes purchases, and sends wishes for unavailable products.
* **Admin** — manages products, inventory, prices, sales, and customer wishes.

The project was built as a practical PHP application to apply programming concepts in a complete real-world system.

---

## ✨ Features

### 🔐 Authentication

* Login system.
* Client account registration.
* Pre-existing Admin account.
* Forgot Password functionality.
* Automatic redirection based on account type.
* Session-based authentication.
* Logout functionality.

> **Note:** The current Forgot Password implementation accepts the user's email but does not currently send a verification code.

---

### 👤 Client

#### 🛍️ Browse Products

Clients can browse products by category, such as:

* Food
* Clothes
* Electronics
* Books
* And other categories.

For each product, the client can view:

* Product name.
* Price.
* Available quantity.

#### 🛒 Purchases

The client can:

1. Select a category.
2. Select a product.
3. Select the required quantity.
4. Review the selected purchases.
5. Edit or confirm the purchase.

After confirming a purchase, the purchased quantity is automatically deducted from the inventory.

After completing a purchase, the client can either make another purchase or log out.

---

### 💭 Wishes

If a client cannot find a product they want, they can send a **Wish** to the Admin.

Each Wish contains:

* Product category.
* Requested product name.

The Admin can:

* Accept the Wish.
* Reject the Wish.

The client receives a notification on their page with the Admin's response.

---

### 👨‍💼 Admin

#### 📦 Inventory Management

The Admin can:

* View products and their available quantities.
* Add newly purchased products to the inventory.
* Increase the quantity of existing products.
* Modify product prices.

#### ⚠️ Stock Alerts

The system displays an alert when a product's quantity gets close to running out, allowing the Admin to identify products that may need restocking.

#### 💭 Wish Management

The Admin can view customer wishes and decide whether to:

* Accept them.
* Reject them.

The client's page is updated with the Admin's response.

#### 💰 Sales

The Admin can view the store's sales through the Admin page.

---

## 🔐 Authentication & Sessions

The current version uses **PHP Sessions** for authentication and application state.

Sessions are used to maintain information such as:

* Logged-in user.
* User type.
* Product data.
* Customer wishes.
* Other application state.

Protected pages verify the user's session before allowing access.

Unauthenticated users are redirected instead of being allowed to access protected areas directly.

---

## 💾 Data Storage

The current version uses:

```text
PHP Sessions
```

Sessions are currently responsible for storing and managing the application's data and state.

---

## ⚠️ Error Handling

Error handling is implemented throughout the application.

The system handles situations such as:

* Empty form submissions.
* Invalid input.
* Missing required data.
* Invalid actions.
* Unexpected application states.

When an error occurs, an appropriate error message is displayed instead of allowing the invalid operation to continue.

---

## 🛠️ Technologies

* **PHP**
* **HTML**
* **CSS**
* **PHP Sessions**

---

## 🚀 How to Run

### Requirements

* PHP
* A local PHP server such as **XAMPP**
* A web browser

### Installation

1. Clone or copy the project into your local server directory.
2. Start your local PHP server.
3. Open the project through the local server.
4. Open the login page.
5. Log in using an existing account or create a new client account.

Example:

```text
http://localhost/your-project/
```

---

## 📌 Current Version

This README describes the **Session-based version** of the project.

The project is being developed as a practical PHP application with a focus on applying PHP concepts through a complete store management system.
