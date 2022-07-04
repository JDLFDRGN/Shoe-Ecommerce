DROP DATABASE IF EXISTS ecommerce;
CREATE DATABASE ecommerce;

CREATE TABLE accounts(
    account_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(500) NOT NULL,
    age int NOT NULL,
    gender VARCHAR(10) NOT NULL
);
CREATE TABLE seller(
    seller_id INT PRIMARY KEY,
    address VARCHAR(1000) NOT NULL
);
CREATE TABLE products(
    product_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    product_image VARCHAR(100) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_price INT NOT NULL,
    product_description VARCHAR(9999) NOT NULL,
    seller_id INT NOT NULL,
    FOREIGN  KEY(seller_id) REFERENCES seller(seller_id)
);

