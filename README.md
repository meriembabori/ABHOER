# ABHOER – Internship Management System

A web-based application designed to digitalize and simplify the management of internship applications within the **Agence du Bassin Hydraulique de l'Oum Er-Rbia (ABHOER)**.

The platform aims to replace traditional paper-based procedures with a centralized system that facilitates application submission, administrative processing, and internship follow-up.

## About the Project

The ABHOER Internship Management System is a web application developed to improve the process of receiving and managing internship requests.

It provides dedicated interfaces for students and administrators, allowing each user to access the features corresponding to their role.

## Main Features

### Student Space
- Create and manage a personal account.
- Complete and update personal information.
- Submit internship applications online.
- Upload required documents (CV, identity document, insurance certificate, etc.).
- Select the desired department or service.
- Track the status of internship applications.
- Receive notifications about application updates.

### Administration Space
- Access and manage student applications.
- View and manage student information.
- Review submitted documents.
- Manage departments and services.
- Monitor internship requests and their processing.
- Manage internship records and application statuses.
- Access dashboard statistics.

## Technologies Used

| Category | Technologies |
|---|---|
| Backend | PHP, Laravel |
| Frontend | HTML5, CSS3, JavaScript |
| CSS Framework | Bootstrap |
| Database | MySQL |
| Development Tools | VS Code, Laragon |
| Version Control | Git, GitHub |

## Project Structure

```text
ABHOER/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── README.md
└── vite.config.js
```

## Installation and Setup

### Prerequisites

Make sure you have installed:

- PHP
- Composer
- Node.js and npm
- MySQL
- Git

### 1. Clone the repository

```bash
git clone https://github.com/meriembabori/ABHOER.git
cd ABHOER
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Configure environment variables

```bash
cp .env.example .env
```

Configure your database credentials in the `.env` file.

### 5. Generate the application key

```bash
php artisan key:generate
```

### 6. Create the database

Create a MySQL database named:

```text
abhoer_gestion_stages
```

Make sure the database name and credentials match your `.env` configuration.

### 7. Run database migrations

```bash
php artisan migrate
```

### 8. Build frontend assets

```bash
npm run build
```

### 9. Start the development server

```bash
php artisan serve
```

Open the application in your browser:

```text
http://127.0.0.1:8000
```

## Project Objectives

- Digitalize the internship application process.
- Reduce paperwork and administrative workload.
- Centralize student applications and documents.
- Improve communication between students and administration.
- Facilitate application tracking and management.

## Author

**Meriem Babori**

GitHub: [@meriembabori](https://github.com/meriembabori)

---

*Developed as part of an internship experience at ABHOER, with the objective of contributing to the digital transformation of internship application management.*
