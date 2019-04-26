CREATE DATABASE project CHARACTER SET utf8 COLLATE utf8_general_ci;
USE project;
CREATE TABLE user (
id INT AUTO_INCREMENT PRIMARY KEY,
day DATETIME,
name INT,
password INT,
avatar INT,
contact INT,
lot_id INT,
bet_id INT
);
CREATE TABLE category (
id INT AUTO_INCREMENT PRIMARY KEY,
name INT,
code INT,
UNIQUE KEY (name, code)
);
CREATE TABLE lot (
id INT AUTO_INCREMENT PRIMARY KEY,
day DATETIME,
name INT,
description INT,
image INT,
start_price INT,
date_finish INT,
step_lot INT,
autor_id INT,
win_user_id INT,
category_id INT
);
CREATE TABLE bet (
id INT AUTO_INCREMENT PRIMARY KEY,
day DATETIME,
price INT,
user_id INT,
lot_id INT
);