-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: db:3306
-- Час створення: Вер 23 2024 р., 15:54
-- Версія сервера: 9.0.1
-- Версія PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `education`
--

-- --------------------------------------------------------

--
-- Структура таблиці `Categories`
--

CREATE TABLE `Categories` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Categories`
--

INSERT INTO `Categories` (`category_id`, `category_name`) VALUES
(1, 'test 1'),
(2, 'test 2'),
(3, 'test 3'),
(4, 'test 4'),
(5, 'test 5');

-- --------------------------------------------------------

--
-- Структура таблиці `Courses`
--

CREATE TABLE `Courses` (
  `course_id` int NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `credits` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Courses`
--

INSERT INTO `Courses` (`course_id`, `course_name`, `credits`, `category_id`) VALUES
(101, 'Introduction to SQL', 4, 1),
(102, 'Database Design', 4, 1),
(103, 'Advanced SQL Queries', 5, 2),
(104, 'Data Modeling', 4, 2),
(105, 'SQL Performance Tuning', 6, 4);

-- --------------------------------------------------------

--
-- Структура таблиці `Enrollments`
--

CREATE TABLE `Enrollments` (
  `enrollment_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Enrollments`
--

INSERT INTO `Enrollments` (`enrollment_id`, `student_id`, `course_id`, `enrollment_date`) VALUES
(1, 1, 101, '2005-07-31'),
(2, 1, 102, '2014-07-24'),
(3, 2, 103, '2014-07-24'),
(4, 3, 104, '2024-07-31'),
(5, 4, 101, '2014-07-24'),
(6, 4, 103, '2014-07-24');

-- --------------------------------------------------------

--
-- Структура таблиці `Grades`
--

CREATE TABLE `Grades` (
  `grade_id` int NOT NULL,
  `student_id` int DEFAULT NULL,
  `grade` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Grades`
--

INSERT INTO `Grades` (`grade_id`, `student_id`, `grade`) VALUES
(101, 1, 95.00),
(102, 2, 88.50),
(103, 3, 92.00),
(104, 4, 75.00),
(105, 6, 87.00);

-- --------------------------------------------------------

--
-- Структура таблиці `Students`
--

CREATE TABLE `Students` (
  `student_id` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Students`
--

INSERT INTO `Students` (`student_id`, `first_name`, `last_name`, `birth_date`) VALUES
(1, 'John', 'Doe', '1995-03-15'),
(2, 'Jane', 'Smith', '1998-07-22'),
(3, 'Mark', 'Johnson', '1997-01-10'),
(4, 'Emily', 'Williams', '1999-05-30'),
(6, 'Kate', 'Johnson', '2000-12-18');

-- --------------------------------------------------------

--
-- Структура таблиці `TeacherCourses`
--

CREATE TABLE `TeacherCourses` (
  `teacher_course_id` int NOT NULL,
  `teacher_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `TeacherCourses`
--

INSERT INTO `TeacherCourses` (`teacher_course_id`, `teacher_id`, `course_id`) VALUES
(1, 1, 101),
(2, 1, 102),
(3, 2, 103),
(4, 3, 104),
(5, 4, 105);

-- --------------------------------------------------------

--
-- Структура таблиці `Teachers`
--

CREATE TABLE `Teachers` (
  `teacher_id` int NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп даних таблиці `Teachers`
--

INSERT INTO `Teachers` (`teacher_id`, `teacher_name`) VALUES
(1, 'Dr. Alice Johnson'),
(2, 'Mr. Bob Smith'),
(3, 'Ms. Carol White'),
(4, 'Dr. David Brown'),
(5, 'Prof. Eva Green');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Індекси таблиці `Courses`
--
ALTER TABLE `Courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Індекси таблиці `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Індекси таблиці `Grades`
--
ALTER TABLE `Grades`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Індекси таблиці `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`student_id`);

--
-- Індекси таблиці `TeacherCourses`
--
ALTER TABLE `TeacherCourses`
  ADD PRIMARY KEY (`teacher_course_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Індекси таблиці `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `Courses`
--
ALTER TABLE `Courses`
  ADD CONSTRAINT `Courses_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Categories` (`category_id`);

--
-- Обмеження зовнішнього ключа таблиці `Enrollments`
--
ALTER TABLE `Enrollments`
  ADD CONSTRAINT `Enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`student_id`),
  ADD CONSTRAINT `Enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`);

--
-- Обмеження зовнішнього ключа таблиці `Grades`
--
ALTER TABLE `Grades`
  ADD CONSTRAINT `Grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`student_id`);

--
-- Обмеження зовнішнього ключа таблиці `TeacherCourses`
--
ALTER TABLE `TeacherCourses`
  ADD CONSTRAINT `TeacherCourses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `Teachers` (`teacher_id`),
  ADD CONSTRAINT `TeacherCourses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `Courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
