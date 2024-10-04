<?php
//Створіть файл 'test.txt' , запишіть у нього рядок 'Hello Palmo''.
// Відобразіть вміст файлу на сторінці
// Відобразіть розмір файлу на сторінці (У байтах, мегабайтах, гігабайтах)
$file = fopen('./scripts/third-hw/storage/test.txt', 'w');
fwrite($file, 'Hello Palmo');
fclose($file);
$file = fopen('./scripts/third-hw/storage/test.txt', 'r');
$text = fread($file, filesize('./scripts/third-hw/storage/test.txt'));
echo $text;
echo '</br>';
$fileSizeBytes = filesize('./scripts/third-hw/storage/test.txt');
$fileSizeMB = $fileSizeBytes / (1024 * 1024);
$fileSizeGB = $fileSizeBytes / (1024 * 1024 * 1024);
echo '</br>';
echo $fileSizeMB;
echo '</br>';
echo $fileSizeGB;
fclose($file);
//Створіть файл 'test2.txt'
//Видаліть 'test.2.txt'
$file = fopen('./scripts/third-hw/storage/test2.txt', 'w');
fwrite($file, "Це новий файл test2.txt.");
fclose($file);
unlink('./scripts/third-hw/storage/test2.txt');
//Створіть папку TestDir
$dir = './scripts/third-hw/TestDir';
mkdir($dir);
//Дано масив ['test1','test2','test3'], створіть у папці Test папки, назвами яких слугують рядки масиву
//Створіть у кожній вкладеній у TestDir папці, файл Hello.txt, у кожен із них запишіть рядок "Hello world", виведіть на екран вміст усіх файлів.
//Напишіть функцію, яка приймає назву файлу або папки і перевіряє, чи є передане значення файлом або папкою (повернути рядок)
$folders = ['test1', 'test2', 'test3'];
$parentDir = './scripts/third-hw/TestDir';
foreach ($folders as $folder) {
    mkdir($parentDir . '/' . $folder);
    $file = fopen($parentDir . '/' . $folder . '/Hello.txt', 'w');
    fwrite($file, "Hello world");
    fclose($file);
}
foreach ($folders as $folder) {
    $filePath = $parentDir . '/' . $folder . '/Hello.txt';
    echo file_get_contents($filePath);
    echo '</br>';
}
//Виведіть поточний час у форматі timestamp
$currentTimestamp = time();
echo $currentTimestamp;
echo '</br>';
//Виведіть 1 березня 2025 року у форматі timestamp
$timestampMarch = mktime(0, 0, 0, 3, 1, 2025);
echo $timestampMarch;
echo '</br>';
//Виведіть 31 грудня поточного року у форматі timestamp
$currentYear = date('Y');
$timestampDec31 = mktime(0, 0, 0, 12, 31, $currentYear);
echo $timestampDec31;
echo '</br>';
//Знайдіть кількість секунд, що пройшли з 13:12:59 15 березня 2000 року до теперішнього часу
$timestampMarch2000 = mktime(13, 12, 59, 3, 15, 2000);
$secondsMarch2000 = $currentTimestamp - $timestampMarch2000;
echo $secondsMarch2000;
echo '</br>';
//Знайдіть кількість годин, що пройшли з 7:23:48 поточного дня до цього часу
$timestamp = mktime(7, 23, 48, date('m'), date('d'), $currentYear);
$secondsSinceMorning = $currentTimestamp - $timestamp;
$hoursSinceMorning = $secondsSinceMorning / 3600;
echo number_format($hoursSinceMorning, 2);
echo '</br>';
//Виведіть на екран поточний рік, місяць, день, годину, хвилину, секунду.
$currentTime = time();
echo date('Y', $currentTime);
echo '<br/>';
echo date('m', $currentTime);
echo '<br/>';
echo date('d', $currentTime);
echo '<br/>';
echo date('H', $currentTime);
echo '<br/>';
echo date('i', $currentTime);
echo '<br/>';
echo date('s', $currentTime);
echo '<br/>';
//Виведіть поточну дату-час у форматах ‘2025-12-31’, ‘31.12.2025’, ‘31.12.13’, ‘12:59:59’.
$currentTime = time();

echo date('Y-m-d', $currentTime);
echo '<br/>';
echo date('d.m.Y', $currentTime);
echo '<br/>';
echo date('d.m.y', $currentTime);
echo '<br/>';
echo date('H:i:s', $currentTime);
echo '<br/>';
//За допомогою функцій mktime та date виведіть 12 лютого 2025 року у форматі ‘12.02.2025’.
$timestamp = mktime(0, 0, 0, 2, 12, 2025);
$formattedDate = date('d.m.Y', $timestamp);
echo $formattedDate;
echo '<br/>';
//Створіть масив днів тижня $week.
//Виведіть на екран назву поточного дня тижня за допомогою масиву $week та функції date.
//Дізнайтесь, який день тижня був 06.06.2006, у ваш день народження.
const week = [
    1 => 'Понеділок',
    2 => 'Вівторок',
    3 => 'Середа',
    4 => 'Четвер',
    5 => 'П’ятниця',
    6 => 'Субота',
    7 => 'Неділя'
];
$currentDayNumber = date('N');
echo week[$currentDayNumber];
echo '<br/>';

$timestamp1 = mktime(0, 0, 0, 6, 6, 2006);
$dayNumber1 = date('N', $timestamp1);
echo week[$dayNumber1];
echo '<br/>';

$timestamp2 = mktime(0, 0, 0, 4, 17, 2004);
$dayNumber2 = date('N', $timestamp2);
echo week[$dayNumber2];
echo '<br/>';
//Створіть масив місяців $month. Виведіть на екран назву поточного місяця за допомогою масиву $month та функції date.
const month = [
    1 => 'Січень',
    2 => 'Лютий',
    3 => 'Березень',
    4 => 'Квітень',
    5 => 'Травень',
    6 => 'Червень',
    7 => 'Липень',
    8 => 'Серпень',
    9 => 'Вересень',
    10 => 'Жовтень',
    11 => 'Листопад',
    12 => 'Грудень'
];
$currentMonth = date('n');
echo month[$currentMonth];
echo '<br/>';
//Знайдіть кількість днів у поточному місяці. Скрипт повинен працювати незалежно від місяця, коли він запущений.
$currentYear = date('Y');
$currentMonth = date('n');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
echo $daysInMonth;
echo '<br/>';
//Зробіть поле введення, в яке користувач вводить рік (4 цифри), а скрипт визначає чи високосний рік.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['date'])) {
        $year = $_POST['year'];
        if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0)) {
            echo "$year рік є високосним.";
        } else {
            echo "$year рік не є високосним.";
        }
    } else {
        echo 'Введіть рік у форматі 4 цифри.';
    }
}
echo '<br/>';
//Зробіть форму, яка запитує дату у форматі '31.12.2025'.
//За допомогою mktime та explode переведіть цю дату у формат timestamp.
//Дізнайтесь день тижня (словом) за введену дату.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $dateParts = explode('.', $date);
        $day = $dateParts[0];
        $month = $dateParts[1];
        $year = $dateParts[2];
        $timestamp = mktime(0, 0, 0, $month, $day, $year);
        $daysOfWeek = ['Неділя', 'Понеділок', 'Вівторок', 'Середа', 'Четвер', 'П’ятниця', 'Субота'];
        $dayOfWeek = $daysOfWeek[date('w', $timestamp)];
        echo $dayOfWeek;
        echo '<br/>';
    } else {
        echo 'Введіть дату у форматі dd.mm.yyyy';
    }
}
//Зробіть форму, яка запитує дату у форматі '2025-12-31'.
//За допомогою mktime та explode переведіть цю дату у формат timestamp.
//Дізнайтесь місяць (словом) за введену дату.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $dateParts = explode('-', $date);
        if (count($dateParts) === 3) {
            $year = $dateParts[0];
            $month = $dateParts[1];
            $day = $dateParts[2];
            $timestamp = mktime(0, 0, 0, $month, $day, $year);
            $months = [
                'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень',
                'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень'
            ];
            $monthWord = $months[date('n', $timestamp) - 1];
            echo $monthWord;

        } else {
            echo "Помилка: Неправильний формат дати. Переконайтеся, що формат дати є 'YYYY-MM-DD'.";
        }
    } else {
        echo "Помилка: Дата не була введена.";
    }
    echo '<br/>';
}
//Зробіть форму, яка запитує дві дати у форматі '2025-12-31'.
//Першу дату запишіть у змінну $date1, а другу в $date2.
//Порівняйте, яка із введених дат більше. Виведіть її на екран.
/**
 * @throws Exception
 */
function getTimestamp(string $date): string
{
    $dateParts = explode('-', $date);
    if (count($dateParts) === 3) {
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];
        return mktime(0, 0, 0, $month, $day, $year);
    }
    throw new Exception("Частини дати повинні бути числами.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['firstDate']) && !empty($_POST['secondDate'])) {
        $firstDate = getTimestamp($_POST['firstDate']);
        $secondDate = getTimestamp($_POST['secondDate']);
        echo $firstDate >= $secondDate ? $_POST['firstDate'] : $_POST['secondDate'];
    } else {
        echo 'Введіть дві дати у форматі dd.mm.yyyy';
    }
    echo '<br/>';
}
//Для вирішення завдань цього блоку вам знадобляться такі функції: strtotime.
//Дана дата у форматі '2025-12-31'. За допомогою функції strtotime та date перетворіть її на формат '31-12-2025'.
//Зробіть форму, яка запитує дату-час у форматі '2025-12-31T12:13:59'.
//За допомогою функції strtotime та функції date перетворіть її на формат
//'12:13:59 31.12.2025'. пиши код без коментариев и используй одинарній кавічки где это нужно
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputDateTime = $_POST['datetime'];
    $timestamp = strtotime($inputDateTime);
    $formattedDate = date('H:i:s d.m.Y', $timestamp);
    echo 'Formatted Date-Time: ' . $formattedDate;
    echo '<br/>';
}
//Додаток та забирання дат
//Для вирішення завдань цього блоку вам знадобляться такі функції: date_create, date_modify, date_format.
//У змінній $date лежить дата у форматі '2025-12-31'. Додайте до цієї дати 2 дні, 1 місяць та 3 дні, 1 рік. Заберіть від цієї дати 3 дні.
$date = date_create('2025-12-31');
date_modify($date, '+2 days');
date_modify($date, '+1 month');
date_modify($date, '+3 days');
date_modify($date, '+1 year');
date_modify($date, '-3 days');
echo '<br/>';
//Дізнайтеся, скільки днів залишилося до Нового Року. Скрипт має працювати у будь-якому році.
$today = date_create();
$newYear = date_create((date('Y') + 1) . '-01-01');
$diff = date_diff($today, $newYear);
echo $diff->days;
echo '<br/>';
//Зробіть форму з одним полем введення, яке користувач вводить рік.
//Знайдіть усі п'ятниці 13-те цього року. Результат виведіть у вигляді масиву дат.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $year = $_POST['year'];
    $fridays13 = [];
    for ($month = 1; $month <= 12; $month++) {
        $date = date_create("$year-$month-13");
        if (date_format($date, 'w') == 5) {
            $fridays13[] = date_format($date, 'Y-m-d');
        }
    }
    print_r($fridays13);
}
//Дізнайтеся, який день тижня був 100 днів тому
$date = date_create();
date_modify($date, '-100 days');
echo date_format($date, 'l');
echo '<br/>';

//Напишіть функцію, яка приймає назву файлу або папки і перевіряє, чи є передане значення файлом або папкою (повернути рядок)
function checkFileOrDirectory($path) {
    if (is_file($path)) {
        return "file";
    } elseif (is_dir($path)) {
        return "directory";
    } else {
        return "not file and not directory";
    }
}
echo checkFileOrDirectory('./scripts/third-hw/TestDir');

?>