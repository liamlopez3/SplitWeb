CREATE DATABASE splitweb CHARACTER SET utf8mb4;
USE splitweb;
CREATE TABLE Users (
    email         VARCHAR(255) PRIMARY KEY,
    password_hash VARCHAR(255) NOT NULL,
    full_name     VARCHAR(255) NOT NULL,
    nickname      VARCHAR(255) NOT NULL
);

CREATE TABLE Expenses (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    payer_email       VARCHAR(255) NOT NULL,
    concept           VARCHAR(100) NOT NULL,
    amount            DECIMAL(10,2) NOT NULL,
    registration_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_settled        BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (payer_email) REFERENCES Users(email)
);
