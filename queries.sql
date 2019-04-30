/*добавляем категории*/
INSERT INTO category (name, code) 
VALUES ('Доски и лыжи', 'snowboard_ski'), ('Крепления', 'mounts'), ('Одежда', 'clothes'), ('Инструменты', 'tools'), ('Разное','others');

/*добавляем пользователей*/
INSERT INTO user (regestration_date, email, name, password, avatar, contact) 
VALUES 	(NOW(), 'alex@web.ru', 'Alex', 'qwerty', 'image.jpg', '9210011'), 
		(NOW(), 'jon@web.ru', 'Jon', '123456qqq', 'face.jpg', '777222666');

/*добавляем лоты*/
INSERT INTO lot (date_create, name, description, image, start_price, date_finish, step_lot, autor_id, win_user_id, category_id) 
VALUES 	(NOW(), '2014 Rossignol District Snowboard', NULL, 'img/lot-1.jpg', '10999', '20190101', NULL, '1','1', '1'), 
		(NOW(), 'DC Ply Mens 2016/2017 Snowboard', NULL, 'img/lot-2.jpg', '159999', '20190506', NULL, '1','1', '1'), 
		(NOW(), 'Крепления Union Contact Pro 2015 года размер L/XL', NULL, 'img/lot-3.jpg', '8000', '20190506', NULL, '1','1', '2'),
        (NOW(), 'Ботинки для сноуборда DC Mutiny Charocal', NULL, 'img/lot-4.jpg', '10999', '20190606', NULL, '1','1', '3'),
        (NOW(), 'Куртка для сноуборда DC Mutiny Charocal', NULL, 'img/lot-5.jpg', '7500', '20190516', NULL, '2','1', '3'),
        (NOW(), 'Маска Oakley Canopy', NULL, 'img/lot-6.jpg', '400', '20190306', NULL, '2','2', '5');

/*добавляем ставку*/
INSERT INTO bet (bet_date, price, user_id, lot_id) 
VALUES 			(NOW(), '11999', '1', '1'), 
				(NOW(), '17000', '2', '2');

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