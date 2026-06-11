# LaravelMatch

A dating app proof of concept built with Laravel 12, Tailwind CSS, Alpine.js, and Pusher for real-time messaging.

---

## Requirements

- PHP 8.2 or higher
- MySQL 5.7 or higher (MySQL 8+ recommended)
- Composer
- Node.js 18 or higher and npm
- A local server like XAMPP, Laragon, or Laravel Herd

---

## Setup

**1. Clone or extract the project**

Place the folder somewhere your local server can serve it (e.g. `htdocs` for XAMPP).

**2. Install PHP dependencies**

```bash
composer install
```

**3. Copy the environment file**

```bash
cp .env.example .env
```

**4. Generate the application key**

```bash
php artisan key:generate
```

**5. Create the database**

Create a MySQL database named `dating_poc` (or whatever name you prefer). Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in `.env` to match your local setup.

Default values in `.env.example` assume a standard XAMPP setup:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dating_poc
DB_USERNAME=root
DB_PASSWORD=
```

**6. Run migrations**

```bash
php artisan migrate
```

**7. Seed sample data**

This creates 10 sample profiles (5 male, 5 female) plus a test user account.

```bash
php artisan db:seed
```

**8. Install frontend dependencies and build assets**

```bash
npm install && npm run build
```

**9. Start the local development server**

```bash
php artisan serve
```

Then open `http://localhost:8000` in your browser.

---

## Sample Accounts

After running the seeder, you can log in with any of these accounts. All passwords are `password`.

> The sample names, bios, and profile details were generated with the help of AI. They are fictional and used for demo purposes only.

| Name | Email |
|---|---|
| Test User | test@example.com |
| James Reyes | james.reyes@example.com |
| Marco Santos | marco.santos@example.com |
| Daniel Cruz | daniel.cruz@example.com |
| Luis Fernandez | luis.fernandez@example.com |
| Carlos Mendoza | carlos.mendoza@example.com |
| Sofia Rivera | sofia.rivera@example.com |
| Isabella Torres | isabella.torres@example.com |
| Camille Garcia | camille.garcia@example.com |
| Natalie Lim | natalie.lim@example.com |
| Angela Villanueva | angela.villanueva@example.com |

---

## Real-time Messaging

Real-time features (live messages, typing indicators, unread badges) are powered by Pusher.

The Pusher credentials are already filled in `.env.example`. You do not need to create a Pusher account or change anything for the messaging features to work out of the box.

> **DISCLAIMER:** The Pusher credentials in `.env.example` are intentionally included to make setup easier on your end. I am aware that committing credentials to version control is a security risk and should never be done in a real project. They are included here strictly for your convenience since this is a proof-of-concept.

---

## Features

- Register and log in
- Set up a dating profile with age and bio
- Browse other users
- Start a conversation with any profile
- Real-time messaging with seen indicators
- Typing indicators
- Unread message badge in the nav
- Per-conversation unread count on the messages list

---

## Tech Stack

- Laravel 12
- Tailwind CSS v3
- Alpine.js v3
- Laravel Echo + Pusher JS
- MySQL
