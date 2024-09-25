# 1.Вибрати всіх студентів
    select * from Students;
# 2. Вибрати курси з кількістю кредитів більше 4
    select * from Courses WHERE Courses.credits >4;
# 3. Вибрати імена та прізвища студентів, які народилися після 1996 року
    select first_name, last_name  from Students where Students.birth_date > '1996-12-31';
# 4. Вибрати курси та їхню загальну кількість кредитів
    select course_name , (select SUM(credits) from Courses) as total_course_credits from Courses;
# 5. Вибрати студентів, які зареєстровані на курси, із сортуванням за прізвищем
    select first_name,last_name from Students
    left join Enrollments on Students.student_id = Enrollments.student_id
    where Enrollments.course_id is not null
    order by last_name;
# 6. Підрахувати кількість студентів, які зареєстровані на кожен курс
    select COUNT(*) from Students
    where (select COUNT(*) from Courses)=(select COUNT(*) from Enrollments where Enrollments.student_id = Students.student_id);
# 7. Знайти студентів, які не зареєстровані на жоден курс
    select * from Students
    where student_id NOT IN (SELECT student_id from Enrollments);
# 8. Оновити кількість кредитів для курсу "Introduction to SQL" на 4
    update Courses set credits = 4 where course_name = 'Introduction to SQL';
# 9. Додати нового студента із ім'ям "Kate", прізвищем "Johnson" та датою народження "2000-12-18"
    insert into Students (student_id,first_name, last_name, birth_date)
    values (6,'Kate', 'Johnson', '2000-12-18');
#     айди добавил потому что у него нет дефолтного значение а он есть ключем и не может быть нулем
# 10. Видалити студента з ім'ям "Alex" із таблиці "Students"
    DELETE FROM Enrollments WHERE student_id = 5;
#     удалил потому что не дает удалить так как таблици связаны между собой
    DELETE FROM Students WHERE first_name = 'Alex';
# 11. Знайти студентів, які мають оцінки від 90 і вище
create table Grades (
grade_id INT PRIMARY KEY,
student_id INT,
grade DECIMAL(5, 2),
foreign key  (student_id) references Students(student_id)
);
insert into Grades (student_id,grade_id, grade) value
(1, 101, 95.00),
(2, 102, 88.50),
(3, 103, 92.00),
(4, 104, 75.00),
(6, 105, 87.00);

select  first_name, last_name, Grades.grade
from Students
join Grades on Students.student_id = Grades.student_id
where Grades.grade >= 90;
# 12. Підрахувати середній бал для кожного студента
    select Students.first_name, last_name, AVG(Grades.grade) as average_grade
    from Students
    join Grades on Students.student_id = Grades.student_id
    group by  Students.first_name, last_name;
# 13. Знайти курси, на які зареєстровані всі студенти
select course_name from Courses
where NOT EXISTS (
    select 1
    from Students
    where NOT EXISTS (
        select 1
        from Enrollments
        where Enrollments.student_id = Students.student_id AND Enrollments.course_id = Courses.course_id
    )
);
# 14. Визначити кількість курсів, які веде кожен вчитель
create table Teachers (
teacher_id INT PRIMARY KEY,
teacher_name VARCHAR(100)
);
create table TeacherCourses (
teacher_course_id int primary key,
teacher_id int,
course_id int,
foreign key (teacher_id) references Teachers(teacher_id),
foreign key (course_id) references Courses(course_id)
);
select Teachers.teacher_name, COUNT(TeacherCourses.course_id) as course_count
from Teachers
    left join TeacherCourses on Teachers.teacher_id = TeacherCourses.teacher_id
group by Teachers.teacher_id, Teachers.teacher_name;
# 15. Знайти студентів, які вступили в університет до свого 18-річчя
select first_name, last_name, birth_date, Enrollments.enrollment_date
from Students
         join Enrollments on Students.student_id = Enrollments.student_id
where DATE_ADD(Students.birth_date, INTERVAL 18 YEAR) > Enrollments.enrollment_date;
# 16. Отримати курси, які є улюбленими хоча б у двох студентів
    select course_name
    from Courses
    where course_id IN (
        select course_id
        from Enrollments
        GROUP BY course_id
        HAVING COUNT(DISTINCT student_id) >= 2
    );
# 17. Знайти студентів, які зареєстровані на всі курси деякої категорії
create table Categories (
    category_id INT PRIMARY KEY,
    category_name VARCHAR(100)
);
INSERT INTO Categories (category_id, category_name) VALUES
     (1, 'test 1'),
     (2, 'test 2'),
     (3, 'test 3'),
     (4, 'test 4'),
     (5, 'test 5'
);
alter table Courses
    add category_id INT,
    add foreign key  (category_id) references Categories(category_id);

update Courses set category_id = 1 where course_id = 101;
update Courses set category_id = 1 where course_id = 102;
update Courses set category_id = 2 where course_id = 103;
update Courses set category_id = 2 where course_id = 104;
update Courses set category_id = 4 where course_id = 105;

select student_id, first_name, last_name
from Students
where not EXISTS (
    select course_id
    from Courses
    where category_id = 1
    AND NOT EXISTS (
    select enrollment_id
    from Enrollments
     where Enrollments.course_id = Courses.course_id AND Enrollments.student_id = Students.student_id
    )
);

# 18. Визначити найбільший бал серед всіх студентів
select MAX(grade) as max_grade from Grades;
# 19. Вибрати студентів, які зареєстровані на курси більше одного разу
select  COUNT(course_id) as enrollment_count , Students.first_name, Students.last_name
from Enrollments
join Students on Enrollments.student_id = Students.student_id
group by Students.first_name, Students.last_name
having COUNT(course_id) > 1;
# 20. Знайти курси, які не мають жодного вчителя
select course_name
from Courses
where course_id NOT IN (
    select course_id
    from TeacherCourses
);
# 21. Отримати імена та прізвища студентів, які зареєстровані на більше ніж один курс
select  Students.first_name, Students.last_name
from Enrollments
join Students on Enrollments.student_id = Students.student_id
group by Students.first_name, Students.last_name
having COUNT(course_id) > 1;
# 22. Вибрати курси та кількість студентів, які на них зареєстровані
select course_name, COUNT(DISTINCT student_id) as student_count
from Courses
join Enrollments on Courses.course_id = Enrollments.course_id
group by course_name;
# 23. Знайти всі пари студентів, які взяли хоча б один спільний курс
select  s1.last_name as student1_last_name, s2.last_name as student2_last_name
from Enrollments e1
join Enrollments e2 ON e1.course_id = e2.course_id
join Students s1 ON e1.student_id = s1.student_id
join Students s2 ON e2.student_id = s2.student_id
where s1.student_id != s2.student_id;
# 24. Отримати список курсів, на які не зареєстровано жодного студента
select course_name from Courses
where course_id NOT IN (
    select course_id
    from Enrollments
);
# 25. Знайти кількість студентів, які зареєстровані на кожен курс, для курсів із зазначенням кількості
select course_name, COUNT(Enrollments.student_id) AS student_count
from Courses
left join Enrollments ON Courses.course_id = Enrollments.course_id
group by Enrollments.course_id, Courses.course_name;