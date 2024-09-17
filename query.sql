-- 3) У цій базі даних створити таблиці:
-- - users: для зберігання користувачів (ПІБ, адреса, дата народження, роль)
-- - regions: для зберігання регіонів
-- - news: для зберігання новин (заголовок новини, текст новини, картинка, автор, дата публікації, активність новини).
create table  users(
    full_name varchar(255) not null,
    address varchar(255) not null,
    birth_date date not null,
    role varchar(255) not null
);
create table  regions(
    name varchar(255) not null
);
CREATE TABLE news (
                      id INT AUTO_INCREMENT PRIMARY KEY,
                      title VARCHAR(255) NOT NULL,
                      content TEXT NOT NULL,
                      image_url VARCHAR(255),
                      author VARCHAR(100) NOT NULL,
                      published_date DATE NOT NULL,
                      is_active BOOLEAN DEFAULT TRUE
);
-- 4) У таблицю users вставити записи.
INSERT INTO users (full_name, address, birth_date, role)
VALUES
    ('Vova', 'Kyiv, Ukraine', '2004-04-17', 'admin');
-- 5) У таблицю regions вставити не менше 5 регіонів України
INSERT INTO regions (name)
VALUES
    ('Kyiv'),
    ('Lviv'),
    ('Odessa'),
    ('Kharkiv'),
    ('Poltava');
-- 6) Зробити експорт усієї бази даних у форматі sql
-- education.sql - файл экспорта
-- 7) Зробити експорт таблиці users форматі CSV
-- users.csv - файл экспорта
-- 8) Очистити таблицю регіонів.
TRUNCATE TABLE regions;
-- 9) Знову зробити експорт усієї бази даних
-- education2.sql - файл экспорта
-- 10) Видалити всі таблиці з бази даних education та імпортувати дамп з 6 завдання
drop table users,regions,news
-- заимортил education.sql в phpadmin вот пример таблици regions
--     1,Kyiv
--     2,Lviv
--     3,Odessa
--     4,Kharkiv
--     5,Poltava
