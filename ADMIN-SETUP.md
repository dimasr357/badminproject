# Admin Setup Instructions

## Admin Account Created Successfully! ✅

### Default Admin Credentials:
- **Email**: `admin@gmail.com`
- **Password**: `admin123`
- **Username**: `admin`

### Access Admin Panel:
1. Open your browser and go to: `http://127.0.0.1:8000/admin/login`
2. Enter the credentials above
3. Click "Login"

### Admin Features:
- **Dashboard**: View statistics (Members, Orders, Courts, Sales)
- **Data Lapangan**: Manage badminton courts
- **Data Pesanan**: View and manage booking orders
- **Data Admin**: Manage admin accounts
- **Data Member**: Manage member accounts (coming soon)

### Security Notes:
- ⚠️ **IMPORTANT**: Change the default password after first login
- All admin routes are protected - you must login to access them
- Session-based authentication is implemented
- Logout button is available in the top-right corner of all admin pages

### Database Tables Created:
- `admins` table with columns:
  - id
  - username
  - nama_lengkap
  - email
  - no_hp
  - password (hashed)
  - remember_token
  - timestamps

### Routes Available:
- `GET /admin/login` - Admin login page
- `POST /admin/login` - Process login
- `POST /admin/logout` - Logout
- `GET /admin/dashboard` - Admin dashboard (protected)
- `GET /admin/lapangan` - Manage courts (protected)
- `GET /admin/pesanan` - Manage orders (protected)
- `GET /admin/admins` - Manage admins (protected)

### Troubleshooting:
If you need to reset the admin account:
```bash
php artisan db:seed --class=AdminSeeder
```

If you encounter any issues, make sure:
1. XAMPP MySQL is running
2. Database is properly configured in `.env`
3. Migrations have been run: `php artisan migrate`
