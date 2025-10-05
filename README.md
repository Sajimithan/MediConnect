# 🏥 HealthCare Pro - Professional Healthcare Management System

A comprehensive, role-based healthcare management platform built with Laravel 10, featuring secure patient data management, health tips, and role-based access control.

## ✨ Features

### 🔐 **Role-Based Access Control (RBAC)**
- **Administrator**: Full system access, user management, system configuration
- **Doctor**: Patient care, health tips management, medical records
- **Nurse**: Patient care, limited administrative access
- **Patient**: Personal health dashboard, health tips access

### 🏥 **Healthcare Management**
- **Comprehensive User Profiles**: Extended health data including BMI, blood type, allergies, medications
- **Health Tips System**: Dynamic health advice with categories, priorities, and tags
- **Patient Dashboard**: Personal health metrics and management interface
- **Secure Data Storage**: HIPAA-compliant data handling

### 🎨 **Modern UI/UX**
- **Professional Landing Page**: Healthcare-focused design with role-based registration
- **Responsive Dashboard**: Tailwind CSS-powered interface
- **Interactive Components**: Dynamic health tips, modal registration forms
- **Mobile-First Design**: Optimized for all devices

### 🛡️ **Security Features**
- **Laravel Sanctum**: API token authentication
- **Role Middleware**: Secure route protection
- **Input Validation**: Server-side validation for all forms
- **CSRF Protection**: Built-in Laravel security

## 🚀 Technology Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Breeze + Sanctum
- **Database**: MySQL with migrations and seeders
- **Build Tool**: Vite.js
- **JavaScript**: Alpine.js for interactivity

## 📋 Requirements

- PHP 8.1+
- Composer
- MySQL 5.7+
- Node.js & NPM
- Laravel Sail (optional)

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd Laravel-Project
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration
Update `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healthcare_pro
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Build Assets
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` to see the application.


## 🔧 API Endpoints

### Health Tips
- `GET /api/health-tips` - List all tips
- `GET /api/health-tips/random` - Get random tip
- `GET /api/health-tips/category/{category}` - Filter by category

### User Management (Admin Only)
- `GET /api/users` - List all users
- `GET /api/users/role/{role}` - Filter users by role
- `GET /api/users/stats` - User statistics

## 🎯 Usage Guide

### For Administrators
1. **Login** with your admin account
2. **User Management**: Create, edit, and manage user accounts
3. **System Overview**: Monitor platform usage and statistics
4. **Health Tips**: Manage and moderate health content

### For Doctors
1. **Login** with your doctor account
2. **Patient Care**: Access patient health information
3. **Health Tips**: Create and manage health advice
4. **Dashboard**: View patient statistics and health metrics

### For Nurses
1. **Login** with your nurse account
2. **Patient Care**: Access limited patient information
3. **Health Monitoring**: Track patient health status
4. **Limited Admin**: Basic administrative tasks

### For Patients
1. **Login** with your patient account
2. **Health Dashboard**: View personal health metrics
3. **Health Tips**: Access personalized health advice
4. **Profile Management**: Update personal health information

## 🎨 Customization

### Styling
- Modify `resources/css/app.css` for custom styles
- Update Tailwind configuration in `tailwind.config.js`
- Customize component styles in Blade templates

### Features
- Add new roles in `app/Http/Middleware/CheckRole.php`
- Extend user model in `app/Models/User.php`
- Create new controllers for additional functionality

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

Or use Pest (if installed):
```bash
./vendor/bin/pest
```

## 📱 Frontend Development

### Development Mode
```bash
npm run dev
```

### Production Build
```bash
npm run build
```

### Watch Mode
```bash
npm run watch
```

## 🔒 Security Considerations

- **Role Validation**: All routes protected by role middleware
- **Input Sanitization**: All user inputs validated and sanitized
- **API Protection**: Sanctum tokens required for API access

## 🚀 Deployment

### Production Requirements
- PHP 8.1+
- MySQL 8.0+
- Redis (optional, for caching)
- SSL certificate
- Web server (Nginx/Apache)

### Deployment Steps
1. Set `APP_ENV=production` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Set up web server configuration
5. Configure database and environment variables

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Check the Laravel documentation
- Review the code comments and documentation

## 🎉 Acknowledgments

- **Laravel Team** for the amazing framework
- **Tailwind CSS** for the utility-first CSS framework
- **Alpine.js** for lightweight JavaScript functionality
- **Healthcare Community** for domain expertise and feedback

---

**Built with ❤️ for modern healthcare management**
