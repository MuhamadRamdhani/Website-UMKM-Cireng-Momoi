# 🥟 UMKM Cireng Momoi - E-Commerce Platform

![Project Status](https://img.shields.io/badge/Status-Completed-success)
![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

A comprehensive E-Commerce web application designed to digitize sales operations for **UMKM Cireng Momoi**. This system simplifies inventory management, transaction processing, and sales reporting.

## 🌟 Key Features

### 🛒 User / Customer
* **Product Catalog:** Browse various Cireng products with detailed descriptions.
* **Shopping Cart:** Add multiple items, update quantities, and calculate totals automatically.
* **Checkout System:** Seamless ordering process.

### 👨‍💻 Administrator
* **Dashboard:** Overview of sales performance.
* **Product Management:** Add, edit, and delete product inventory.
* **Order Management:** View incoming orders and update status.
* **PDF Reporting:** Generate and download automatic sales reports (Laporan Penjualan) in PDF format for monthly bookkeeping.

## 🛠️ Tech Stack

* **Backend:** PHP (Laravel Framework)
* **Frontend:** Blade Templates, Tailwind CSS
* **Database:** MySQL
* **Tools:** Git, Composer, NPM

## 🚀 Installation Guide

If you want to run this project locally:

1.  **Clone the repository**
    ```bash
    git clone [https://github.com/MuhamadRamdhani/YOUR-REPO-NAME.git](https://github.com/MuhamadRamdhani/YOUR-REPO-NAME.git)
    ```
2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```
3.  **Environment Setup**
    * Copy `.env.example` to `.env`
    * Configure your database credentials in `.env`
    ```bash
    php artisan key:generate
    ```
4.  **Database Migration**
    ```bash
    php artisan migrate --seed
    ```
5.  **Run Server**
    ```bash
    php artisan serve
    ```

## 🔐 Demo Credentials

To test the Admin features:

* **Email:** `admin@cireng.com`
* **Password:** `admin1234`

---

<p align="center">
  Created by <strong>Muhamad Ramdhani</strong>
  <br>
  <a href="https://www.linkedin.com/in/muhamadramdhani/">Connect on LinkedIn</a>
</p>
