-- Buat database
CREATE DATABASE IF NOT EXISTS crud_xor_db;
USE crud_xor_db;

-- Buat tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email TEXT NOT NULL,
    telepon TEXT NOT NULL,
    alamat TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Contoh data
INSERT INTO users (nama, email, telepon, alamat) VALUES 
('John Doe', 'V1dWQw==', 'V1dWQw==', 'V1dWQw=='),
('Jane Smith', 'V1dWQw==', 'V1dWQw==', 'V1dWQw==');