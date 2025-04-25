# Post and Comment Management System

A Laravel 12 RESTful API project to manage posts and comments, with role-based access control, automatic AI-based comment replies, and clean architecture.

---

##  Features

- User authentication with email and password
- Admin and Regular User privileges
- Role management using [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- Create, update, delete posts (only by owners)
- View all posts with pagination and comments
- Comment on posts
- Auto-reply to comments using OpenAI GPT-4o-mini
- Repository and Service layer structure
- Clean error handling (ResultTrait)
- Multi-language support (Arabic / English)
- Private image storage and secure access
- Event-driven architecture (Events → Listeners → Jobs)
- Smart logging for background operations and AI interaction

---

##  Requirements

- PHP >= 8.2
- Composer
- MySQL Database
- Laravel 12 Framework

---

##  Installation and Setup

### 1. Clone and install dependencies

```bash
git clone https://github.com/takwa81/Levant-Task.git
cd Levant-Task
composer install
cp .env.example .env
php artisan key:generate



DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your_email@gmail.com"
MAIL_FROM_NAME="Your App Name"

OPENAI_API_KEY=your_openai_api_key
php artisan migrate --seed
php artisan serve
php artisan queue:work
OPENAI_API_KEY=your_openai_api_key



#  Summary of Important Commands

| Command | Purpose |
|--------|---------|
| `composer install` | Install all PHP project dependencies listed in `composer.json`. |
| `cp .env.example .env` | Create a new environment configuration file `.env` by copying the example. |
| `php artisan key:generate` | Generate a new unique application key for encryption and app security. |
| `php artisan migrate --seed` | Run database migrations and insert initial test data into the database. |
| `php artisan serve` | Start the Laravel local development server on `http://127.0.0.1:8000`. |
| `php artisan queue:work` | Start the queue worker to handle background jobs (sending emails, AI replies, etc.). |


