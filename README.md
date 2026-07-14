# My Offers Web Application

## Project Overview
This project is a dynamic web application designed to display and manage various offers, similar to a deals or coupon website. It allows users to browse offers, filter them by category, and provides functionalities for user registration, login, and offer submission. The application is built using PHP and integrates with a MySQL database to store offer details and user information.

## Features
*   **Offer Display:** Browse and view a variety of offers with details such as title, description, original price, discount, and images.
*   **Category Filtering:** Filter offers based on different categories for easier navigation.
*   **User Authentication:** Secure user registration and login system.
*   **Offer Submission:** Functionality for users (or administrators) to submit new offers.
*   **Shopping Cart (Implied):** The presence of `cart.php` suggests a shopping cart or similar functionality for managing selected offers.
*   **Database Integration:** Utilizes a MySQL database for persistent storage of offers, users, and other application data.
*   **Responsive Design:** Multiple CSS files (`style.css`, `style2.css`, etc.) indicate an effort towards varied styling or responsive design.

## Technologies Used
*   **Backend:** PHP
*   **Database:** MySQL (with `myoffers.sql` for schema)
*   **Frontend:** HTML, CSS, JavaScript

## Installation and Setup
To set up and run this project locally, you will need a web server environment with PHP and MySQL (e.g., XAMPP, WAMP, MAMP, or a LAMP/LEMP stack).

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    ```
2.  **Place the project files:** Copy the `myoffers` directory into your web server's document root (e.g., `htdocs` for Apache).
3.  **Database Setup:**
    *   Create a new MySQL database (e.g., `myoffers_db`).
    *   Import the `myoffers.sql` file located in the `sql/` directory into your newly created database. This will set up the necessary tables.
4.  **Configure Database Connection:**
    *   Open `connection.php` and update the database connection details (server name, username, password, database name) to match your MySQL setup.
5.  **Configure PHP:** Ensure your web server is configured to process PHP files.
6.  **Uploads Directory:** Ensure the `uploads/` directory has appropriate write permissions for image uploads.

## Usage
1.  Access the application through your web browser (e.g., `http://localhost/myoffers/index.php`).
2.  Browse available offers or use the navigation to register/login.
3.  If you have the necessary permissions, you can submit new offers via `submit-offer.php`.

## Developer
Eng. Yahya Shalf

## License
© 2026 Eng. Yahya Shalf. All Rights Reserved. No part of this project may be copied or reproduced without explicit permission.
