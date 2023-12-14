-- Create the database
CREATE DATABASE db6;

-- Select the database
USE db6;

-- Create the 'exam' table
CREATE TABLE exam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255),
    answer1 VARCHAR(255),
    answer2 VARCHAR(255),
    answer3 VARCHAR(255),
    answer4 VARCHAR(255),
    correct INT
);

-- Insert qeustions into the 'exam' table
INSERT INTO exam (question, answer1, answer2, answer3, answer4, correct) VALUES
('Which language is oldest?', 'C', 'Fortran', 'SQL', 'COBOL', 2),
('Which language is this?: print("Hello.")', 'Java', 'Python', 'Lisp', 'C++', 2),
('Which language does not need semi-colons between statements on separate lines?', 'PHP', 'CSS', 'C', 'JavaScript', 4),
('Which language is not primarily a web language?', 'HTML', 'CSS', 'R', 'PHP', 3),
('Which language does WebGL use?', 'JavaScript', 'Java', 'Python', 'C++', 1);

-- Create the 'students' table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    code VARCHAR(255),
    seen VARCHAR(10) DEFAULT 'Not done', 
    complete VARCHAR(10) DEFAULT 'Not done',
    score INT DEFAULT 0
);
-- Insert student into the 'student' table
INSERT INTO students (name, code, seen, complete, score) VALUES
('Claude', '16502', 'Not done', 'Not done', 0),
('Marilyn', '29964', 'Not done', 'Not done', 0),
('Cynthia', '35101', 'Not done', 'Not done', 0),
('Franz', '48642', 'Not done', 'Not done', 0),
('Esther', '56078', 'Not done', 'Not done', 0),
('Louverne', '60003', 'Not done', 'Not done', 0),
('Hagar', '79252', 'Not done', 'Not done', 0),
('Beatrice', '84218', 'Not done', 'Not done', 0),
('Martha', '99539', 'Not done', 'Not done', 0),
('Clarence', '05673', 'Not done', 'Not done', 0),
('Alice', '12345', 'Not done', 'Not done', 0),
('Bob', '23456', 'Not done', 'Not done', 0),
('Charlie', '34567', 'Not done', 'Not done', 0);


-- Create the 'password' table
CREATE TABLE password (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pwd VARCHAR(255)
);
-- Insert the given password into the 'password' table
INSERT INTO password (pwd) VALUES ('candy');