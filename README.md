## Product CRUD with Authentication and Error Handling

- Owerview

This project is a Laravel-based application that provides CRUD functionality for products and includes user authentication. The application is equipped with error handling mechanisms and integrates Laravel Telescope for monitoring.

## Features

- Product CRUD

Create, Read, Update, and Delete operations for products.Products are stored in a database with necessary validations in place.

-  Authentication

Secure login and registration for users.Middleware-protected routes to ensure only authenticated users can perform CRUD operations.

-  Error Handling

Centralized error handling through a custom Handler.php class.
Custom JSON responses for API endpoints:
Handles ModelNotFoundException for missing products.
Returns structured error messages for 404 and other HTTP exceptions.

- Monitoring with Laravel Telescope

Laravel Telescope is configured to monitor:
1.Requests and responses.
2.Logged exceptions.
3.Database queries.
4.User activity.


## Prerequisites

- PHP >= 8.2 
- Composer
- Laravel 11
- A database (e.g., MySQL, SQLite, PostgreSQL, or others)

## Installation

- Clone the repository:

```
git clone https://github.com/Qambarovadilshoda/crud-localization.git
```

- Navigate to the project directory:

```
cd crud-localization
```

- Install dependencies:

```
composer Install
```

- Create a .env file:

```
cp .env.example .env
```

- Configure the .env file with your database credentials and other settings:

- Generate the application key:

```
php artisan key:generate
```

- Run migrations:

```
php artisan migrate
```

- Start the development server:

```
php artisan serve
```

## Usage

# Authentication

- Register a new user or log in with existing credentials.
- Use the authentication middleware-protected routes for product management.

# Product Management

- Access CRUD operations via the provided API endpoints or web interface.

# Error Handling

- If a product is not found during a CRUD operation, the API will return a 404 response with a message like:

```
{
    "message": "Product not found"
}
```

# Monitoring with Telescope

- Access Laravel Telescope by visiting /telescope in your browser (ensure you are authorized).
- Monitor requests, database queries, and logged errors.

## Dependencies

- Laravel Telescope: Installed and configured for monitoring.

```
composer require laravel/telescope
php artisan telescope:install
php artisan migrate
```
- Laravel Breeze (optional): Provides authentication scaffolding.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
