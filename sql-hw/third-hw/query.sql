# Отримати список студентів із їхніми курсами:
# Використовуйте INNER JOIN між таблицями "Students" та "Enrollments" для отримання імені студента та назви курсу, на якому вони зареєстровані.
select student_name, Courses.course_name from Students
inner join Enrollments on Enrollments.student_id = Students.student_id
inner join Courses on Enrollments.course_id = Courses.course_id;
# Використовуйте GROUP BY та HAVING, щоб визначити вчителів, які мають кілька записів в таблиці "Courses_Teachers".
SELECT Courses_Teachers.teacher_id, COUNT(*) AS course_count
FROM Courses_Teachers
GROUP BY Courses_Teachers.teacher_id
HAVING COUNT(*) > 1;
# Отримати перелік книг та їхніх авторів:
# Використовуйте INNER JOIN між таблицями "Books" та "Authors" для отримання інформації про книги та їхніх авторів.
SELECT Books.title, Authors.author_name
FROM Books
INNER JOIN Authors ON Books.author_id = Authors.author_id;
# Знайти студентів, які не призначені жодному курсу:
# Використовуйте LEFT JOIN між таблицями "Students" та "Enrollments" та визначте нульові значення для записів, які не мають відповідних зв'язків.
SELECT s.student_id, s.student_name
FROM Students s
         LEFT JOIN Enrollments e ON s.student_id = e.student_id
WHERE e.course_id IS NULL;
# Знайти кількість унікальних авторів книг у кожному жанрі:
# Використовуйте INNER JOIN та GROUP BY для підрахунку кількості унікальних авторів кожного жанру в таблицях "Books" та "Genres".
SELECT Genres.genre_name, COUNT(DISTINCT Authors.author_id) AS unique_author_count
FROM Authors
INNER JOIN Books ON Authors.author_id = Books.author_id
INNER JOIN Genres ON Books.genre_id = Genres.genre_id
GROUP BY Genres.genre_name;
# Отримати кількість курсів для кожного вчителя:
# Використовуйте підзапит, щоб підрахувати кількість курсів для кожного вчителя з таблиць "Courses_Teachers" та "Teachers".
SELECT Teachers.teacher_name AS teacher_name,
(SELECT COUNT(*)
FROM Courses_Teachers
WHERE Courses_Teachers.teacher_id = Teachers.teacher_id) AS course_count
FROM Teachers;
# Знайти студентів, які зареєстровані на всі курси:
# Використовуйте підзапит для порівняння кількості курсів, на які студент зареєстрований, з загальною кількістю курсів.
SELECT Students.student_name,
       (SELECT COUNT(*) FROM Courses) AS total_courses,
       (SELECT COUNT(*) FROM Enrollments WHERE Enrollments.student_id = Students.student_id) AS enrolled_courses
FROM Students;
# Отримати список книг, які є улюбленими у більш як двох користувачів:
# Використовуйте підзапит та GROUP BY для знаходження книг, які мають більше двох записів в таблиці "Favorites".
SELECT Books.title
FROM Books
WHERE (SELECT COUNT(*)
       FROM Favorites
       WHERE Favorites.book_id = Books.book_id) >= 2
GROUP BY Books.book_id;
# Знайти курси, які не мають вчителів:
# Використовуйте NOT EXISTS або LEFT JOIN для знаходження курсів, які не мають відповідних записів в таблиці "Courses_Teachers".
SELECT Courses.course_name
FROM Courses
WHERE NOT EXISTS (
    SELECT 1
    FROM Courses_Teachers
    WHERE Courses_Teachers.course_id = Courses.course_id
);
# Отримати список користувачів, які не використовували систему протягом останнього місяця:
# Використовуйте підзапит та оператори порівняння для визначення користувачів, які не мають відповідних записів в таблиці "UserActivity" протягом останнього місяця.
SELECT *
FROM Teachers
WHERE Teachers.teacher_id NOT IN (
    SELECT UserActivity.user_id
    FROM UserActivity
    WHERE UserActivity.last_activity_date >= NOW() - INTERVAL 1 MONTH
);
# Знайти студентів, які зареєстровані на більше одного курсу того ж дня:
# Використовуйте підзапит для знаходження студентів, які мають більше одного запису в таблиці "Enrollments" для одного й того ж дня.
SELECT *
FROM Students
WHERE Students.student_id IN (
    SELECT Enrollments.student_id
    FROM Enrollments
    GROUP BY Enrollments.student_id, Enrollments.enrollment_date
    HAVING COUNT(*) > 1
);
# Отримати список курсів, які не мають студентів:
# Використовуйте LEFT JOIN та IS NULL для визначення курсів, які не мають відповідних записів в таблиці "Enrollments".
SELECT * FROM Courses
LEFT JOIN Enrollments ON Courses.course_id = Enrollments.course_id
WHERE Enrollments.course_id IS NULL;
# Знайти студентів, які вступили в школу пізніше, ніж їхні однолітки:
# Використовуйте підзапит для порівняння дат вступу студента із середньою датою вступу інших студентів того ж віку.
SELECT s.student_name, e.enrollment_date
FROM Students s
         JOIN Enrollments e ON s.student_id = e.student_id
WHERE e.enrollment_date > (
    SELECT AVG(UNIX_TIMESTAMP(e2.enrollment_date))
    FROM Students s2
             JOIN Enrollments e2 ON s2.student_id = e2.student_id
    WHERE s2.age = s.age
      AND s2.student_id <> s.student_id
);
# Отримати список курсів, які мають більше 5 студентів:
# Використовуйте GROUP BY та HAVING, щоб визначити курси, у яких кількість студентів перевищує 5.
SELECT * FROM Courses
WHERE course_id IN (
    SELECT course_id
    FROM Enrollments
    GROUP BY course_id
    HAVING COUNT(*) > 5
);
# Знайти всіх вчителів, які ведуть курси в більш ніж одній категорії:
# Використовуйте підзапит для визначення вчителів, які мають записи в таблиці "Courses_Teachers" для курсів різних категорій.
SELECT t.teacher_id, t.teacher_name
FROM Teachers t
WHERE (
          SELECT COUNT(DISTINCT c.course_id)
          FROM Courses_Teachers ct
                   JOIN Courses c ON ct.course_id = c.course_id
          WHERE ct.teacher_id = t.teacher_id
      ) > 1;
# Отримати список студентів, які не мають оцінок:
# Використовуйте LEFT JOIN та IS NULL для знаходження студентів, які не мають відповідних записів в таблиці "Grades".
select Students.student_name from Students
left join Grades on Students.student_id = Grades.student_id
where Grades.student_id is null;
# Знайти курси, які мають хоча б одного студента з високими оцінками (більше 90):
# Використовуйте INNER JOIN та підзапит для визначення курсів, у яких є студенти з високими оцінками.
SELECT Courses.course_name
FROM Courses
         INNER JOIN Enrollments ON Courses.course_id = Enrollments.course_id
WHERE EXISTS (
    SELECT 1
    FROM Grades
    WHERE Grades.course_id = Enrollments.course_id
      AND Grades.grade > 90
);
# Отримати середній бал для кожного студента:
# Використовуйте INNER JOIN та GROUP BY для визначення середнього балу для кожного студента на основі записів у таблиці "Grades".
SELECT Students.student_name, AVG(Grades.grade) AS average_grade
FROM Students
         INNER JOIN Grades ON Students.student_id = Grades.student_id
GROUP BY Students.student_name;
# Знайти всіх вчителів, які ведуть курси з певного предмету:
# Використовуйте INNER JOIN для з'єднання таблиць "Teachers" та "Courses_Teachers", щоб отримати вчителів, які ведуть курси з певного предмету.
SELECT t.teacher_id, t.teacher_name
FROM Teachers t
         INNER JOIN Courses_Teachers ct ON t.teacher_id = ct.teacher_id
         INNER JOIN Courses c ON ct.course_id = c.course_id
WHERE c.course_name = 'Mathematics';
# Отримати перелік студентів, які зареєстровані на курси вищого рівня (з більшою кількістю кредитів):
# Використовуйте підзапит для визначення максимальної кількості кредитів серед усіх курсів, а потім INNER JOIN для вибору студентів, які зареєстровані на курси з цією кількістю кредитів.
SELECT s.student_id, s.student_name
FROM Students s
         INNER JOIN Enrollments e ON s.student_id = e.student_id
         INNER JOIN Courses c ON e.course_id = c.course_id
WHERE c.credits = (
    SELECT MAX(credits)
    FROM Courses
);