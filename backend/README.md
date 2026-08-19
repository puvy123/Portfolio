# Developer Portfolio Backend API (Laravel 11 + MySQL)

RESTful API backend powering the Developer Portfolio application.

## Prerequisites
- PHP >= 8.2 with PDO, OpenSSL, Mbstring extensions
- Composer >= 2.0
- MySQL Server >= 8.0

## Quick Setup Instructions

1. **Install Dependencies**:
   ```bash
   composer install
   ```

2. **Configure Environment & Database**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Update `.env` with your MySQL credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=developer_portfolio
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

3. **Run Migrations & Seed Database**:
   ```bash
   php artisan migrate:fresh --seed
   ```

4. **Serve the API**:
   ```bash
   php artisan serve --port=8000
   ```

The API will be live at `http://localhost:8000/api/v1/portfolio`.
