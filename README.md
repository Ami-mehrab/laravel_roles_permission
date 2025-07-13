
# Laravel spatie/roles-permissions [with Job Portal]

A role-based job portal built with Laravel 12 that supports **Super Admin**, **Employer**, and **Candidate** roles using **Spatie Laravel Permission**. This platform allows employers to post jobs, candidates to apply, and super admins to manage everything through dedicated dashboards.

---

## 🚀 Features

- ✅ Role-based login and dashboards:
  - **Super Admin**: Manage jobs, users, roles
  - **Employer**: Create, update, delete job posts and view applicants
  - **Candidate**: Apply for jobs and track applications
- ✅ Job CRUD for employers
- ✅ Job application system
- ✅ Applicant filtering by job
- ✅ Permissions powered by Spatie Laravel-Permission
- ✅ Tailwind CSS UI

---

## 🛠 Tech Stack

- **Laravel 12**
- **PHP 8.2+**
- **MySQL /**
- **Spatie Laravel-Permission**
- **Tailwind CSS/Bootstrap**
- **Blade Templates**

---

## 📦 Installation & Setup

```bash
# Clone the repo
git clone https://github.com/yourusername/laravel-job-portal.git
cd laravel-job-portal

# Install dependencies
composer install

# Copy and configure .env
cp .env.example .env
php artisan key:generate

#Download & setup Nodejs then

npm install 
npm run dev

# Set database credentials in .env
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

# Run migrations and seeders
php artisan migrate --seed

# Serve the app
php artisan serve


🧑‍💻 Author
Mahrab hossen
GitHub: https://github.com/Ami-mehrab
LinkedIn: 

<!-- 
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
