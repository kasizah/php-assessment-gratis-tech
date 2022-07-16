CREATE DATABASE IF NOT EXISTS users;

use users;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username varchar(50) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);