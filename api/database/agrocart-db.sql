CREATE DATABASE agrocart_api_db;
USE agrocart_api_db;

CREATE TABLE IF NOT EXISTS USERS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
    user_type CHAR(20) NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    Date_of_Birth VARCHAR(50) NOT NULL,
    phone_number VARCHAR(20) UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(200) NOT NULL,
    location VARCHAR(100) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS LOGS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(100) NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    usertype VARCHAR(50) NOT NULL,
    email VARCHAR(30) NOT NULL,
    last_loggedin TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS PRODUCT (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
    product_name VARCHAR(50) NOT NULL,
    product_company VARCHAR(50) NOT NULL,
    product_price VARCHAR(50) NOT NULL,
    product_stock VARCHAR(50) NOT NULL,
    product_category VARCHAR(20) NOT NULL,
    added_by_admin_name VARCHAR(40) NOT NULL,
    added_by_admin_id VARCHAR(36) NOT NULL
);

CREATE TABLE IF NOT EXISTS CART (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(100) NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    product_id VARCHAR(36) NOT NULL,
    product_name VARCHAR(50) NOT NULL,
    product_price VARCHAR(50) NOT NULL,
    order_quantity INT(10) NOT NULL
);