# Post and Comment Management System

A Laravel 12 RESTful API project to manage posts and comments, with role-based access control, automatic AI-based comment replies, and clean architecture.

---

## 🚀 Features

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

## 📚 Requirements

- PHP >= 8.2
- Composer
- MySQL Database
- Laravel 12 Framework

---

## ⚙️ Installation and Setup

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



# Summary 
# Install composer dependencies
composer install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Run database migrations and seeds
php artisan migrate --seed

# Start development server
php artisan serve

# Run queue worker
php artisan queue:work

