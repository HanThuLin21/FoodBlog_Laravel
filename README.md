# Delicious Bites - Food Blog Platform

Welcome to the **Delicious Bites Food Blog** repository! This is a modern, full-stack web application designed for food enthusiasts to discover, share, and review mouth-watering recipes, read food-related blog posts, and find hidden restaurant gems.

## 🚀 Tech Stack

This project is built using a modern decoupled architecture:

*   **Frontend**: React (TypeScript) + Vite
*   **Backend**: Laravel (PHP) REST API
*   **Styling**: Custom CSS with responsive mobile-first design principles
*   **Database**: MySQL (via Laravel Eloquent ORM)

## ✨ Key Features

### User Portal (Frontend)
*   **Responsive UI**: Fully mobile-friendly layouts, including a global hamburger menu and gracefully stacking cards for all screen sizes.
*   **Recipes Directory**: Browse curated recipes with stunning visuals and detailed instructions.
*   **Restaurant Reviews**: Explore top restaurants with honest reviews and high-quality imagery.
*   **Creative "About" Page**: A premium, visually engaging layout showcasing the mission and the expert team.
*   **Authentication**: User registration and login flow for personalizing the experience.

### Admin Control Panel
*   **Secure Dashboard**: A protected admin area with an elegant, responsive side navigation menu.
*   **CRUD Management**: Full control over Blog Posts, Recipes, Restaurants, and Users.
*   **Responsive Tables**: Horizontal scrolling data tables designed specifically for mobile device management.

## 🛠️ Getting Started

To run this project locally on your machine, you will need to run both the backend API and the frontend development server simultaneously.

### Prerequisites
*   [PHP](https://www.php.net/) & [Composer](https://getcomposer.org/) (for Laravel)
*   [Node.js](https://nodejs.org/) & npm (for React/Vite)
*   [MySQL](https://www.mysql.com/) (or any preferred database supported by Laravel)

### 1. Backend Setup (Laravel)
Open a terminal and navigate to the `backend` folder:
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
*The Laravel API will be available at `http://localhost:8000`.*

### 2. Frontend Setup (React + Vite)
Open a second terminal and navigate to the `frontend` folder:
```bash
cd frontend
npm install
npm run dev
```
*The React application will be available at `http://localhost:5173`.*

## 📸 Screenshots
*(Coming soon)*

## 🤝 Contributing
Contributions, issues, and feature requests are welcome! Feel free to check the issues page if you want to contribute.

## 👨‍💻 Created By
Created and maintained by **Han Thu Lin** (Web Developer).
