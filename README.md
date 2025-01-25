# ImmoPro - Real Estate Management Platform

## About ImmoPro

ImmoPro is a comprehensive real estate management platform built with Laravel, designed to streamline property listings and management tasks. This platform provides a robust solution for real estate agencies and property managers to efficiently manage their property portfolio, handle client interactions, and showcase properties to potential buyers or tenants.

## Features

- **Property Management**
- Create and manage property listings
- Upload and manage property images
- Track property details (price, surface area, rooms, etc.)
- Manage property options and amenities

- **User Management**
- Secure authentication system
- Role-based access control
- User profiles for agents and administrators

- **Admin Dashboard**
- Comprehensive admin panel
- Property listing management
- User management interface
- Analytics and reporting

## Technical Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Node.js and NPM
- Laravel 10.x
- Web server (Apache/Nginx)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/immopro.git
cd immopro
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Configure environment variables:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in the .env file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=immopro
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations and seeders:
```bash
php artisan migrate --seed
```

7. Build assets:
```bash
npm run build
```

8. Start the development server:
```bash
php artisan serve
```

## Project Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/    # Application controllers
│   │   └── Middleware/     # Custom middleware
│   ├── Models/             # Eloquent models
│   └── Services/           # Business logic services
├── config/                 # Configuration files
├── database/
│   ├── migrations/         # Database migrations
│   └── seeders/           # Database seeders
├── public/                 # Publicly accessible files
├── resources/
│   ├── js/                # JavaScript files
│   ├── css/               # CSS files
│   └── views/             # Blade templates
└── routes/                 # Application routes
```

## Basic Usage

1. Access the application through your web browser:
```
http://localhost:8000
```

2. Log in to the admin panel:
```
http://localhost:8000/admin
```
Default admin credentials:
- Email: admin@example.com
- Password: password

3. Start managing properties:
- Add new properties
- Upload property images
- Set property details
- Manage property options

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
