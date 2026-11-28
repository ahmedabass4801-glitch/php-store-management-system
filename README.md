# نظام إدارة المتجر | Store Management System

## ملخص بالعربي

تطبيق ويب بلغة PHP لإدارة متجر إلكتروني بواجهتين: واجهة العميل (تصفح المنتجات، الشراء، إرسال طلبات "ويش" للمنتجات غير المتوفرة، تسجيل حساب، استرجاع كلمة المرور) ولوحة الأدمن (إدارة المخزون والأسعار، تنبيهات نقص المخزون، متابعة المبيعات، قبول أو رفض طلبات العملاء). النسخة الحالية تخزن البيانات في جلسات PHP (Sessions) بدون قاعدة بيانات.

للتشغيل: انسخ `config/config.example.php` إلى `config/config.php` ثم شغّل `php -S localhost:8000 -t public` وافتح `http://localhost:8000`. تسجيل دخول الأدمن التجريبي الجاهز: البريد `admin@example.com` وكلمة المرور `demo1234` (للتجربة فقط، غيّرها قبل أي استخدام حقيقي).

---

## English

A PHP store management app with a customer side and an admin side. Data and state live in PHP sessions (no database yet).

### Features

- Login, client sign-up, forgot-password flow, role-based redirect, logout
- Client: browse products by category, buy with quantity, review/edit/confirm purchases (stock is deducted), send a "wish" for products not in the store and see the admin's reply
- Admin: view inventory, add stock, change prices, low-stock alerts, accept/reject customer wishes, view sales

Full feature description: [docs/Full-Description.md](docs/Full-Description.md)

### Tech stack

PHP (vanilla), HTML, PHP sessions. No framework, no database, no Composer dependencies.

### Folder map

```text
.
├── public/                  # Web root: entry points (one file per page/action)
│   ├── index.php            # Login
│   ├── new-account.php      # Client sign-up
│   ├── forget-password.php  # Password reset
│   ├── client.php           # Client shop and purchase flow
│   ├── admin.php            # Admin dashboard
│   ├── my-products.php      # Admin: inventory and prices
│   ├── wish.php             # Wishes (client send / admin review)
│   └── sales.php            # Admin: sales
├── src/
│   └── views/               # HTML templates included by the pages above
├── config/
│   └── config.example.php   # Template for config/config.php (git-ignored)
└── docs/
    └── Full-Description.md  # Detailed feature description
```

### Install

1. Install PHP 8+ (or XAMPP).
2. Clone the repo:
   ```bash
   git clone https://github.com/ahmedabass4801-glitch/php-store-management-system.git
   cd php-store-management-system
   ```
3. Create your config (admin account credentials are not stored in the code):
   ```bash
   cp config/config.example.php config/config.php
   ```
   The template ships with open demo credentials (see Demo login below), so you can skip this for a quick try. For real use, edit `config/config.php` and set your own `admin_email` and `admin_password`.

### Run

```bash
php -S localhost:8000 -t public
```

Open http://localhost:8000. With XAMPP, point the virtual host's document root at the `public/` folder.

### Demo login

`config/config.example.php` ships with open demo credentials, so after copying it to `config/config.php` you can sign in to the admin dashboard right away:

- Email: `admin@example.com`
- Password: `demo1234`

These are for trying the system only. Set your own credentials in `config/config.php` before any real use.

### Known limitations

No password hashing, CSRF protection or rate limiting yet, and the reset flow does not email a code. Data resets with the session.
