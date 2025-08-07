
#  Booksy – Laravel Online Bookstore

Booksy is a full-featured Laravel 12 web application for managing an online bookstore. It provides user-friendly interfaces for both **customers** and **administrators**. Customers can browse books, add them to a cart, place orders, and track their purchases. Administrators can manage books, orders, users, monitor stock levels, and view revenue analytics — all from a centralized admin dashboard.

---

##  Project Purpose

Booksy was built to demonstrate the development of a real-world, role-based Laravel application with CRUD operations, authentication, cart/order logic, and admin reporting. 

---

##  Features & Functionalities

###  User Features
- Register, Login, Logout
- Browse books by genre or category
- View book details (title, author, price, genre)
- Add to cart / update quantity / remove from cart
- Place orders directly from the cart
- View order history and statuses
- View book recommendations

###  Cart System
- Cart view includes: book image, title, price, quantity, subtotal
- Auto calculation of total price
- Empty cart handling and dynamic updates

###  Order Management
- Users can place orders for books
- Each order reduces book stock automatically
- Admins can update order statuses:
- Pending , Cancelled, Completed, Paid
- Order history is available per user

###  Authentication & Roles
- Custom login and registration forms
- Session-based authentication
- Role-based access control (`admin` and `user`)
- Protected admin routes

###  Admin Panel
- Dashboard summary: orders, users, books, revenue
- Book management (CRUD +cover-image upload)
- Order approval/cancellation/payment marking
- User list with delete option
- Revenue tracking page with charts
- Low stock alert section for quick restock action

---

##  Technologies Used

### Backend
- **PHP 8.x**
- **Laravel 12**
- **PostgreSQL**
- **Eloquent ORM**
- **Seeder/Factory system**
- **Docker + Docker Compose**

###  Frontend
- **HTML5, CSS3**
- **Laravel Blade Files**
- **Chart.js / ApexCharts** (for admin analytics)

###  Development Tools
- **VS Code**
- **Git & GitHub**
- **Postman** for API testing
- **pgAdmin** for database access

---


##  Setup Instructions

###  Prerequisites
- PHP >= 8.x
- Composer
- Docker & Docker Compose
- PostgreSQL

### Installation Steps

1. **Clone the repository**

git clone https://github.com/Muturi-Mercy/Booksyapp.git
cd booksy


2. **Configure environment**

cp .env.example .env
docker-compose exec booksyapp bash
php artisan key:generate

3. **Start Docker containers**

docker-compose up -d

4. **Run migrations and seeders**
5. 
docker-compose exec booksyapp bash
php artisan migrate --seed

6. **Serve the application**
7. 
docker-compose exec booksyapp bash
php artisan serve

6. **Access the app**

* Frontend: `http://localhost:8890`
* Admin Panel: `/admin` (secured by role)

---

## 🔐 Default Admin Credentials

The seeder creates a default admin user:

* **Email**: `adminbooksy@gmail.com`
* **Password**: `booksycrud`

> You can change these in `DatabaseSeeder.php`.


##  Revenue & Analytics

* View revenue charts by month
* Admin panel uses Chart.js or ApexCharts
* Displays pending vs paid orders
* Helps admins make inventory and pricing decisions

---

##  Low Stock Alerts

Admins can see a list of books where the stock level is below a defined threshold (e.g., 5 units).
This helps avoid overselling and improves stock management.

---

## 🧪 API Testing 

RESTful APIs are also enabled, you can test:

* `GET /api/books`
* `POST /api/orders`
* `GET /api/user/orders`

Use Postman to authenticate and test these endpoints.

---

## Image Licensing Notice

All book cover images used in this project are either:

* Placeholder images from public sources like or sourced from Pixabay
* Custom generic covers created for demo use

>  **No copyrighted book covers or logos** are included.

Book titles and author names are used for educational/demonstration purposes only.

---

##  Future Improvements

* Payment gateway integration (PayPal, Stripe, or M-Pesa)
* Email notifications for order status
* Search & filter options
* Responsive UI improvements
* Admin activity logs

---

##  Contributing

Pull requests are welcome! If you'd like to contribute, fork the repo and submit a PR.

1. Fork this repository
2. Create your feature branch 
3. Commit your changes 
4. Push to the branch 
5. Open a pull request

---

## 🙌 Acknowledgments

* Laravel Documentation
* Open Source Libraries (ApexCharts, Chart.js)
* Placeholder image services


