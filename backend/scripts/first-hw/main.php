<?php
//1)Створіть змінну $a і присвойте їй значення 3. Виведіть значення цієї змінної на екран.
$a = 3;
echo $a . "<br>";
//2)Створіть змінні $a=10 і $b=2. Виведіть на екран їхню суму, різницю, добуток і частку (результат ділення).
$a = 10;
$b = 2;
echo "Sum: " . ($a + $b) . "<br>";
echo "Difference: " . ($a - $b) . "<br>";
echo "Product: " . ($a * $b) . "<br>";
echo "Quotient: " . ($a / $b) . "<br>";
//3)Створіть змінні $c=15 і $d=2. Підсумуйте їх, а результат присвойте змінній $result. Виведіть на екран значення змінної $result.
$c = 15;
$d = 2;
$result = $c + $d;
echo $result . "<br>";
//4)Створіть змінні $a=10, $b=2 і $c=5. Виведіть на екран їхню суму.
$a = 10;
$b = 2;
$c = 5;
echo $a + $b + $c . "<br>";
//5)Створіть змінні $a=17 і $b=10.
//Відніміть від $a змінну $b і результат присвойте змінній $c. Потім створіть змінну $d,
//присвойте їй значення 7. Складіть змінні $c і $d, а результат запишіть у змінну $result. Виведіть на екран значення змінної $result.
$a = 17;
$b = 10;
$c = $a - $b;
$d = 7;
$result = $c + $d;
echo $result . "<br>";
//6)Створіть змінну $text і присвойте їй значення 'Привіт, Світ!'. Виведіть значення цієї змінної на екран.
$text = 'Привіт, Світ!';
echo $text . "<br>";
//7)Створіть змінні $text1='Привіт, ' і $text2='Світ!'. За допомогою цих змінних і операції додавання рядків виведіть на екран фразу 'Привіт, Мир!'.
$text1 = 'Привіт, ';
$text2 = 'Світ!';
echo $text1 . $text2 . "<br>";
//8)Створіть змінну $name і присвойте їй ваше ім'я. Виведіть на екран фразу 'Привіт, %Ім'я%!'. Замість %Ім'я% має стояти ваше ім'я.
$name = 'Vova';
echo "Привіт, $name!<br>";
//9)Створіть змінну $age і присвойте їй ваш вік. Виведіть на екран 'Мені %Вік% років!'.
$age = 20;
echo "Мені $age років!<br>";
//10)Створіть змінну $text і присвойте їй значення 'abcde'.
// Звертаючись до окремих символів цього рядка, виведіть на екран символ 'a', символ 'c', символ 'e'.
$text = 'abcde';
echo $text[0] . $text[2] . $text[4] . "<br>";

//11)Дано довільний рядок, наприклад, 'abcde'. Поміняйте першу букву (тобто букву 'a') цього рядка на '!'.
$text = 'abcde';
$text[0] = '!';
echo $text . "<br>";
//12)Створіть змінну $num і присвойте їй значення '12345'. Знайдіть суму цифр цього числа.
$num = '12345';
$sum = 0;
for ($i = 0; $i < strlen($num); $i++) {
    $sum += intval($num[$i]);
}
echo $sum . "<br>";
//13)Напишіть скрипт, який рахує кількість секунд у годині, у добі, у місяці.
$seconds_in_hour = 60 * 60;
$seconds_in_day = $seconds_in_hour * 24;
$seconds_in_month = $seconds_in_day * 30.44;
echo "Seconds in an hour: $seconds_in_hour<br>";
echo "Seconds in a day: $seconds_in_day<br>";
echo "Seconds in a month (average): " . round($seconds_in_month) . "<br>";
//14)Створіть три змінні - година, хвилина, секунда. З їхньою допомогою виведіть поточний час у форматі 'година:хвилина:секунда'.
$hour = date('H');
$minute = date('i');
$second = date('s');
echo "$hour:$minute:$second<br>";
//15)Створіть змінну, присвойте їй число.
// Підведіть це число до квадрата (це означає, що потрібно помножити його саме на себе). Виведіть його на екран.
$num = 10;
$square = $num ** 2;
echo $square . "<br>";
//Переробіть цей код так, щоб у ньому використовувалися операції +=, -=, *=, /=. Кількість рядків коду при цьому не повинна змінитися.
$var = 47;
$var += 7;
$var -= 18;
$var *= 10;
$var /= 20;
echo $var . "<br>";
// Переробіть цей код так, щоб у ньому використовувалася операція .=. Кількість рядків коду при цьому не повинна змінитися.
$text = 'Я';
$text .= ' хочу';
$text .= ' знати';
$text .= ' PHP!';
echo $text . "<br>";
// Переробіть цей код так, щоб у ньому використовувалися операції ++ і --. Кількість рядків коду при цьому не повинна змінитися.

$var = 10;
$var++;
++$var;
$var--;
echo $var . "<br>";
// Переробіть цей код так, щоб у ньому використовувалися операції ++, -- , +=, -=, *=, /=. Кількість рядків коду при цьому не повинна змінитися.

$var = 10;
$var += 7;
$var++;
$var--;
$var += 12;
$var *= 7;
$var -= 15;
echo $var . "<br>";

//Створіть масив $arr=['a', 'b', 'c']. Виведіть значення масиву на екран за допомогою функції var_dump().
$arr = ['a', 'b', 'c'];
var_dump($arr);
echo "<br>";
//За допомогою масиву $arr з попереднього номера виведіть на екран вміст першого, другого і третього елементів.
foreach ($arr as $key => $value) {
    echo $value . "<br>";
}
//Створіть масив $arr=['a', 'b', 'c', 'd'] і з його допомогою виведіть на екран рядок 'a+b, c+d'.
$arr = ['a', 'b', 'c', 'd'];
echo $arr[0] . "+" . $arr[1] . ", " . $arr[2] . "+" . $arr[3] . "<br>";
//Створіть масив $arr з елементами 2, 5, 3, 9.
// Помножте перший елемент масиву на другий, а третій елемент на четвертий.
// Результати складіть, присвойте змінній $result. Виведіть на екран значення цієї змінної.
$arr2 = [2, 5, 3, 9];
$result = ($arr2[0] * $arr2[1]) + ($arr2[2] * $arr2[3]);
echo $result . "<br>";

//Заповніть масив $arr числами від 1 до 5. Не оголошуйте масив, а просто заповніть його присвоюванням $arr[] = нове значення.
$arr = [];
for ($i = 1; $i <= 5; $i++) {
    $arr[] = $i;
}
print_r($arr);
//Створіть масив $arr. Виведіть на екран елемент із ключем 'c'.
$arr = ['a' => 1, 'b' => 2, 'c' => 3];
echo $arr['c'] . "<br>";
//$arr = ['a'=>1, 'b'=>2, 'c'=>3];
// Створіть масив $arr. Знайдіть суму елементів цього масиву.
$arr = ['a' => 1, 'b' => 2, 'c' => 3];
echo array_sum($arr);
// Створіть масив заробітних плат $arr. Виведіть на екран зарплату Петрика та Колі.
//$arr = ['Коля'=>'1000$', 'Вася'=>'500$', 'Петя'=>'200$'];
$arr = ['Коля' => '1000$', 'Вася' => '500$', 'Петя' => '200$'];
echo $arr['Коля'] . "<br>" . $arr['Вася'] . "<br>" . $arr['Петя'] . "<br>";
// Створіть асоціативний масив днів тижня.
//Ключами в ньому мають слугувати номери днів від початку тижня (понеділок - повинен мати ключ 1, вівторок - 2 і т.д.).
//Виведіть на екран поточний день тижня.
//Нехай тепер номер дня тижня зберігається у змінній $day, наприклад там лежить число 3.
//Виведіть день тижня, що відповідає значенню змінної $day.
$daysOfWeek = [
    1 => "Понеділок",
    2 => "Вівторок",
    3 => "Середа",
    4 => "Четвер",
    5 => "П'ятниця",
    6 => "Субота",
];
$day = 3;
echo $daysOfWeek[$day] . "<br>";
//Створіть багатовимірний масив $arr. З його допомогою виведіть на екран слова 'joomla', 'drupal', 'зелений', 'червоний'.
$arr = [
    'cms' => ['joomla', 'wordpress', 'drupal'],
    'colors' => ['blue' => 'блакитний', 'red' => 'червоний', 'green' => 'зелений']
];
echo $arr['cms'][0] . "<br>" . $arr['cms'][2] . "<br>" . $arr['colors']['green'] . "<br>" . $arr['colors']['red'] . "<br>";
// Створіть двовимірний масив. Перші два ключі - це 'ua' і 'en'.
//Нехай перший ключ містить елемент, що є масивом назв днів тижня російською, а другий - англійською.
//Виведіть за допомогою цього масиву понеділок російською та середу англійською (нехай понеділок - це перший день).
$arr = [
    'ua' => [
        'Понеділок',
        'Вівторок',
        'Середа',
        'Четвер',
        'Пятниця',
        'Субота',
        'Неділя'
    ],
    'en' => [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ]
];
echo $arr['ua'][0] . "<br>" . $arr['en'][2] . "<br>";
// Нехай тепер у змінній $lang зберігається мова (вона приймає одне зі значень або 'ua', або 'en' - або те, або те),
//а у змінній $day - номер дня. Виведіть словом день тижня, що відповідає змінним $lang і $day.
//Тобто: якщо, наприклад, $lang = 'ru' і $day = 3 - то виведемо 'середу'.
$lang = "ua";
$day = 4;
echo $arr[$lang][$day];