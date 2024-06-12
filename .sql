CREATE DATABASE db_backup_recovery;

USE db_backup_recovery;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    profile VARCHAR(255) NOT NULL
);
