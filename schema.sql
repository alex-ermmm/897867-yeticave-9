CREATE DATABASE alexandr_yermakovich_yeticave CHARACTER SET utf8 COLLATE utf8_general_ci;
USE alexandr_yermakovich_yeticave;
CREATE TABLE user (
user_id INT AUTO_INCREMENT PRIMARY KEY,
regestration_date DATETIME,
name CHAR,
password CHAR,
avatar CHAR,
contact TEXT,
lot_id INT,
bet_id INT
);
CREATE TABLE category (
category_id INT AUTO_INCREMENT PRIMARY KEY,
name CHAR,
code CHAR,
UNIQUE KEY (name, code)
);
CREATE TABLE lot (
lot_id INT AUTO_INCREMENT PRIMARY KEY,
date_create DATETIME,
name CHAR,
description LONGTEXT,
image CHAR,
start_price INT,
date_finish INT,
step_lot INT,
autor_id INT,
win_user_id INT,
category_id INT,
FOREIGN KEY (autor_id)  REFERENCES user (user_id),
FOREIGN KEY (win_user_id)  REFERENCES user (user_id),
FOREIGN KEY (category_id)  REFERENCES category (category_id)
);
CREATE TABLE bet (
id INT AUTO_INCREMENT PRIMARY KEY,
bet_date DATETIME,
price INT,
user_id INT,
lot_id INT,
FOREIGN KEY (user_id)  REFERENCES user (user_id),
FOREIGN KEY (lot_id)  REFERENCES lot (lot_id)
);