<div align="center">

#  HotelHub
### Hotel Booking & Room Management System

![Laravel](https://img.shields.io/badge/Laravel-10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

</div>

---

## About This Project

HotelHub is a hotel booking and room management system I built as part of my MCA academic project. It covers everything from browsing rooms to making bookings, processing payments, and managing everything from an admin panel.

I built this using Laravel 10, MySQL, and Bootstrap 5 — focusing on clean MVC architecture and real-world features like email confirmations, role-based access, and room availability checks.

---

## What It Can Do

- Users can register, browse rooms, book them, and track their bookings
- Admins can manage rooms, view all bookings, track payments, and handle customer messages
- Room availability is checked before confirming any booking
- Booking confirmation emails are sent automatically via Mailtrap
- Payments are simulated with transaction ID generation
- Guests can leave reviews and ratings on rooms they've visited

---

## Tech Stack

| Technology | Used For |
|-----------|---------|
| Laravel 10 | Backend framework |
| PHP 8.1 | Server-side language |
| MySQL | Database |
| Bootstrap 5.3 | Frontend styling |
| Mailtrap | Email testing |
| XAMPP | Local development server |

---

## Database Tables

- **users** — stores registered users with admin/user roles
- **rooms** — room details, images, pricing, availability
- **bookings** — all booking records with check-in/out dates
- **payments** — payment records with transaction IDs
- **reviews** — guest ratings and comments
- **contacts** — messages submitted via contact form

---

## How to Run Locally

```bash
git clone https://github.com/LalitaDubole/HotelHub.git
cd HotelHub
composer install
cp .env.example .env
php artisan key:generate
```

Set up your `.env` with database details, then:

```bash
php artisan migrate --seed
php artisan serve
```

Visit `http://localhost:8000`

---

## Login Credentials

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@hotelhub.com | admin123 |
| User | lalita123@gmail.com | password123 |

---

## Academic Details

**Student:** Lalita Dubole  
**Course:** MCA — MET Bhujbal Knowledge City, Nashik  
**Domain:** TravelTech  
**Framework:** Laravel 10