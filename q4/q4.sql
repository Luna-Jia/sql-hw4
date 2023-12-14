-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS db7;

-- Select the database to use for subsequent operations
USE db7;

-- Create the 'users' table if it doesn't exist
CREATE TABLE IF NOT EXISTS users (
    -- 'id' field as the primary key, assuming unique identifier for each user
    id VARCHAR(50) PRIMARY KEY,

    -- 'password' field for storing user passwords
    -- Ensure to store hashed passwords for security
    password VARCHAR(255) NOT NULL,

    -- 'name' field for storing user's name
    name VARCHAR(100),

    -- 'email' field for storing user's email
    email VARCHAR(100),

    -- 'visits' field for storing the number of visits, initialized to 0
    visits INT DEFAULT 0,

    -- 'last' field for storing the last visit date as a string
    -- This field will be manually updated by the application
    last VARCHAR(100)
);
