-- SQL script to create necessary tables

CREATE DATABASE recruiter_app;

USE recruiter_app;

-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    role ENUM('admin', 'recruiter') NOT NULL,
    approved BOOLEAN DEFAULT FALSE
);

-- Table for job postings
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    recruiter_id INT NOT NULL,
    title VARCHAR(100) NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    description TEXT NOT NULL,
    experience VARCHAR(50) NOT NULL,
    incentive DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (recruiter_id) REFERENCES users(id)
);

-- Table for job applications
CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    recruiter_id INT NOT NULL,
    candidate_name VARCHAR(100) NOT NULL,
    candidate_experience VARCHAR(50) NOT NULL,
    status ENUM('pending', 'interview', 'hired') DEFAULT 'pending',
    FOREIGN KEY (job_id) REFERENCES jobs(id),
    FOREIGN KEY (recruiter_id) REFERENCES users(id)
);

-- Table for incentive payments
CREATE TABLE incentives (
    id INT AUTO_INCREMENT PRIMARY KEY,
    job_id INT NOT NULL,
    employer_recruiter_id INT NOT NULL,
    candidate_recruiter_id INT NOT NULL,
    admin_amount DECIMAL(10, 2) NOT NULL,
    employer_amount DECIMAL(10, 2) NOT NULL,
    candidate_amount DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (job_id) REFERENCES jobs(id),
    FOREIGN KEY (employer_recruiter_id) REFERENCES users(id),
    FOREIGN KEY (candidate_recruiter_id) REFERENCES users(id)
);
