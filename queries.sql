/*добавляем категории*/
INSERT INTO category (name, code) 
VALUES ('Доски и лыжи', 'boards'), ('Крепления', 'attachment'), ('Ботинки', 'boots'), ('Одежда', 'clothing'), ('Инструменты', 'tools'), ('Разное','others');

/*добавляем пользователей*/
INSERT INTO user (regestration_date, email, name, password, avatar, contact) 
VALUES 	(NOW(), 'alex@web.ru', 'Alex', '$2y$10$Tf05CGg8o1sETaL67IEBzeWeovW3GWJP8TpHx7JVGH1YCW5v41tSG', 'image.jpg', 'тел. 9210011'), 
		(NOW(), 'jon@web.ru', 'Jon', '$2y$10$M/pdGrXJHcNOEZjdL3OGxe3ZiFtrNXpBuUBWJDDWrTbxiYYloF1T6', 'face.jpg', 'тел. 777222666');

/*добавляем лоты*/
INSERT INTO lot (date_create, name, description, image, start_price, date_finish, step_lot, autor_id, win_user_id, category_id) 
VALUES 	(NOW(), '2014 Rossignol District Snowboard', 'Описание лота 2014 Rossignol District Snowboard', 'img/lot-1.jpg', '10999', '20190612', '1000', '1', NULL, '1'), 
		(NOW(), 'DC Ply Mens 2016/2017 Snowboard', 'Описание лота DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', '15999', '20190611', '1500', '1', NULL, '1'), 
		(NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', 'Описание лота Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', '8000', '20190614', '2000', '1', NULL, '2'),
        (NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', 'Описание лота Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', '10999', '20190613', '1300', '1', NULL, '3'),
        (NOW(), 'Куртка для сноуборда DC Mutiny Charocal', 'Описание лота Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', '7500', '20190611', '1000', '2', NULL, '3'),
        (NOW(), 'Маска Oakley Canopy', 'Описание лота Маска Oakley Canopy', 'img/lot-6.jpg', '400', '20190612', '100', '2', NULL, '5');

/*добавляем ставку*/
INSERT INTO bet (bet_date, price, user_id, lot_id) 
VALUES 			(NOW(), '12999', '1', '1'), 
				(NOW(), '18000', '2', '2');

/*выбираем все категории*/
SELECT * FROM category;

/*получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории;*/
SELECT category.name, lot.name, image, start_price, step_lot, autor_id FROM lot RIGHT JOIN category ON category.category_id = lot.category_id WHERE date_finish > NOW() ORDER BY lot_id DESC;

/*показать лот по его id. Получите также название категории, к которой принадлежит лот;*/
SELECT lot_id, category.name FROM lot INNER JOIN category ON category.category_id = lot.category_id WHERE lot_id = 14;

/*обновить название лота по его идентификатору;*/
UPDATE lot SET name = '2014 Rossignol District Snowboard. UPDATE' WHERE lot_id = 1;

/*получить список самых свежих ставок для лота по его идентификатору.*/
SELECT * FROM bet WHERE lot_id = 2 ORDER BY bet_date DESC ;