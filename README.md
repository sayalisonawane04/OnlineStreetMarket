# 🛒 City Street Mart – Grocery Application

**City Street Mart** is a PHP & MySQL-based web application designed to provide grocery shopping services for local areas. It enables users to browse products, add them to a cart, and place orders efficiently — aiming to support local vendors and customers with an easy-to-use platform.

---

## 📌 Features

* 🛍️ Product browsing by categories (Fruits, Vegetables, Dairy, etc.)
* 🔍 Search functionality
* 🛒 Shopping cart system
* 👤 User registration and login
* 🧾 Order placement and order history
* 📦 Admin panel to manage products, orders, and users
* 📍 Local area-based delivery support
* 🗃️ Secure data handling with MySQL

---

## 🧰 Tech Stack

| Technology   | Usage                          |
| ------------ | ------------------------------ |
| PHP          | Backend logic                  |
| MySQL        | Database management            |
| HTML/CSS     | Frontend structure and styling |
| JavaScript   | Client-side interactivity      |
| Bootstrap    | Responsive UI                  |
| XAMPP / LAMP | Local development environment  |

---

## 🏁 Getting Started

### 🔧 Requirements

* PHP >= 7.x
* MySQL or MariaDB
* Apache Server (XAMPP / LAMP / WAMP)
* Web browser

### 📥 Installation

1. **Clone or Download the Project**

   ```bash
   git clone https://github.com/your-username/city-street-mart.git
   ```

2. **Place the Folder in Your Web Server Directory**

   * For XAMPP: `C:\xampp\htdocs\city-street-mart`

3. **Import the Database**

   * Open `phpMyAdmin`
   * Create a new database, e.g., `city_mart`
   * Import the SQL file located at `/database/city_mart.sql`

4. **Configure Database Connection**

   * Open `/config/db.php` or similar file
   * Set your database credentials:

     ```php
     $host = 'localhost';
     $user = 'root';
     $pass = '';
     $db   = 'city_mart';
     ```

5. **Run the App**

   * Start Apache and MySQL in XAMPP
   * Visit: [http://localhost/city-street-mart](http://localhost/city-street-mart)

---

## 👩‍💼 Admin Login

* **URL:** `/admin/`
* **Username:** `admin`
* **Password:** `admin123`

*(Change credentials after first login for security.)*

---

## 🖼️ Screenshots

> *(Add screenshots here for homepage, product page, cart, admin panel, etc.)*

---

## 📂 Project Structure

```
city-street-mart/
├── admin/
├── assets/
├── config/
├── database/
├── includes/
├── pages/
├── index.php
└── README.md
```

---

## 📌 Future Enhancements

* Online payment gateway integration
* Progressive Web App (PWA) support
* SMS/Email notifications for order updates
* Real-time inventory tracking
* Multilingual support

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

This project is open-source. You can modify and use it freely for personal or educational purposes.

