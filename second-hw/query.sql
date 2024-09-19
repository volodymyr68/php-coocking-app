# 1. Необхідно вибрати всіх користувачів із таблиці users, які зареєстрували свої поштові скриньки (email) у сервісі “gmail.com”
select full_name from users where email like '%gmail.com';
# 2. Необхідно вибрати номер сертифіката (number), власника сертифіката (fio) із таблиці сертифікатів (certificates), де не вказано рік випуску year ( за замовчуванням поле year має значення NULL)
select number , fio from certificates where year is NULL;
# 3. Оновити таблицю certificates, встановити такі значення: у полі series встановити значення ВН, у полі number – 25444, де user_id = 7
update certificates set series = 'ВН', number = 25444 where user_id = 7;
# 4. Видалити останні 5 записів з таблиці users
delete from users order by id desc limit 5;
# 5. Знайти мінімальне значення з поля count_students у таблиці організацій, де type_id = 5
select min(count_students) from organizations where type_id = 5;
# 6. Порахувати суму оцінок rating з таблиці practice, де practice_id = 1888
select sum(rating) from practice where practice_id = 1888;
# 7. Підрахувати кількість записів у таблиці organizations
select count(id) from organizations;
# 8. Необхідно вивести 10 новин з таблиці news, відсортувати за датою додавання created_at
select * from news order by created_at limit 10;
# 9. Необхідно вибрати номер телефону (phones) та ім'я (name) з таблиці директорів directors, у яких назва організації (organization) починається зі слова «ВНЗ»
select phones, name from directors where organization like 'ВНЗ%';
# 10. Вивести surname з таблиці студентів students, які народилися в 1995 році (поле birthday має формат DATE)
select surname from students where YEAR(birthday) = 1995;
# 11. Вивести перші 5 записів з таблиці publishes, результат має містити такі поля: дата (publish_date) та текст (body)
select publish_date, body from publishes order by id ASC limit 5;
# 12. Необхідно відобразити назви жанрів (name) з таблиці genres, які не мають жодної книги з таблиці books
select g.name from genres g left join education.books b on g.id = b.genre_id where b.id is null;
# 13. Вибрати прізвище surname користувача та ім'я name з таблиці users та відповідну назву регіону (поле name) із таблиці areas.
# Зв'язок: users.area_id = areas.id, відсортувати за назвою регіону. Вибрати всього 4 записи
select full_name, name , areas.id from users left join areas on users.areas_id = areas.id where users.areas_id is not null order by areas.name desc limit 4
# 14. Необхідно порахувати скільки новин у кожній категорії
select c.name as category_name, COUNT(n.id) as news_count from categories c left join news n on c.id = n.category_id group by c.id;
# 15. Вибрати назву міста (name) із таблиці cities та відповідну назву регіону (name) із таблиці areas. Зв'язок: cities.area_id = areas.id
select cities.name as city_name, areas.name as area_name from cities join areas on cities.area_id = areas.id;
# 16. Вибрати назву школи (name) з таблиці schools та відповідну назву регіону (name) з таблиці districts. Зв'язок: schools.district_id = districts.id
select schools.name as school_name, districts.name as district_name from schools join districts on schools.district_id = districts.id;