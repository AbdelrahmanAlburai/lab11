CREATE DATABASE IF NOT EXISTS student_system
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student_system;

CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    age INT NOT NULL,
    major VARCHAR(100) NOT NULL,
    gpa DECIMAL(3,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO students (name, email, age, major, gpa) VALUES
('Abdelrahman Alburai', 'abdelrahman@mail.com', 22, 'Smart Systems Engineering', 3.70),
('Mohammed Salem', 'mohammed@mail.com', 21, 'Computer Science', 3.45),
('Sara Ahmed', 'sara@mail.com', 20, 'Information Technology', 3.88),
('Omar Khalid', 'omar@mail.com', 23, 'Cybersecurity', 3.60),
('Lana Yousef', 'lana@mail.com', 21, 'Data Science', 3.92),
('Hassan Ali', 'hassan@mail.com', 24, 'Software Engineering', 3.30),
('Mona Naser', 'mona@mail.com', 20, 'Computer Science', 3.76),
('Khaled Sami', 'khaled@mail.com', 22, 'Information Technology', 3.50),
('Rana Mahmoud', 'rana@mail.com', 21, 'Cybersecurity', 3.81),
('Yousef Adel', 'yousef@mail.com', 23, 'Data Science', 3.40),
('Aya Hamad', 'aya@mail.com', 20, 'Software Engineering', 3.95);