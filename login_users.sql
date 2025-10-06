
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS login_user;
USE login_user;


CREATE TABLE tbl_user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    contact_number VARCHAR(20),
    address VARCHAR(255),
    verification_code INT DEFAULT NULL,
    profile VARCHAR(255) DEFAULT 'default.png',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tbl_course (
    `course_id` INT AUTO_INCREMENT PRIMARY KEY,
    `course_name` VARCHAR(100) NOT NULL,
    description TEXT,
    `created_by` INT, -- FK to tbl_user (teacher/admin)
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES tbl_user(user_id) ON DELETE SET NULL
);

CREATE TABLE tbl_assignment (
    `assignment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `course_id` INT NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    description TEXT,
    `due_date` DATETIME,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES tbl_course(course_id) ON DELETE CASCADE
);

CREATE TABLE tbl_progress (
    `progress_id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NOT NULL,
    `course_id` INT NOT NULL,
    `progress_percent` INT DEFAULT 0,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES tbl_user(user_id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES tbl_course(course_id) ON DELETE CASCADE
);


INSERT INTO tbl_user (first_name, last_name, email, username, password, role) VALUES
('Admin', 'User', 'admin@example.com', 'admin', 
PASSWORD('admin123'), 'admin');  -- Replace PASSWORD() with proper PHP hashed password in real usage



ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`tbl_user_id`);

ALTER TABLE `tbl_user`
  MODIFY `tbl_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

