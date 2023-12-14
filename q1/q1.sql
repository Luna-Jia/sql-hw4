CREATE DATABASE db3;

USE db3;

CREATE TABLE orders (
    `auto_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `card` VARCHAR(255),
    `address` VARCHAR(255),
    `noddles` INT,
    `rice` INT,
    `hotpot` INT
);

CREATE TABLE password (
    `pwd` VARCHAR(255)
);

INSERT INTO password (pwd) VALUES ('1234');
