# Laravel Training Project (NRES)

This project was developed during a training session with NRES. The training covered the basics of Laravel, including:

- Routing
- Models
- Views
- Controllers
- Artisan Commands (make, migrate, etc)
- Factory for generating random dummy data
- Generating dummy data with Factory in Tinker
- Creating and modifying database with Migration
- Form validation
- File storage and uploading files
- Activating email verification for Laravel Breeze
- Testing emails with Mailpit
- Pagination
- Eloquent query with pagination and search

## Project Overview

This Laravel application demonstrates CRUD operations for a simple Product management system. It includes:

- Product listing with pagination and search
- Product creation, editing, and deletion
- Usage of Eloquent models and factories
- Blade templates for views

## Getting Started with Laravel Herd

Follow these steps to install and run the project locally using [Laravel Herd](https://herd.laravel.com/):

1. **Clone the repository**
   ```bash
   git clone <your-repo-url>
   cd sistem-05
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Copy the example environment file and set your configuration**
   ```bash
   cp .env.example .env
   ```

4. **Generate the application key**
   ```bash
   php artisan key:generate
   ```

5. **Set up your database**
   - Update the `.env` file with your database credentials.
   - Create a database for the project.

6. **Install frontend dependencies and build assets**
   ```bash
   npm install
   npm run build
   ```

7. **Run migrations and seeders (if any)**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

8. **Start the development server with Herd**
   - Open the project in Laravel Herd.
   - Visit the local URL provided by Herd in your browser.

## Additional Notes

- Make sure you have [Composer](https://getcomposer.org/) installed.
- Laravel Herd is available for macOS and Windows. Download it from [herd.laravel.com](https://herd.laravel.com/).
- For more information on Laravel, visit the [official documentation](https://laravel.com/docs).