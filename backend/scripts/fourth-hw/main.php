<?php
/*Ми хочемо знайти числа, більші або рівні 1000, сума кожні чотири послідовних цифр не може бути більшою за певне задане значення.
Якщо число дорівнює num = d1d2d3d4d5d6, а максимальна сума 4 суміжних цифр дорівнює maxSum, тоді:
d1 + d2 + d3 + d4 <= maxSum
d2 + d3 + d4 + d5 <= maxSum
d3 + d4 + d5 + d6 <= maxSum
Для цього нам потрібно створити функцію max_sumDig(), яка отримує nMax як максимальне значення досліджуваного інтервалу (діапазон (1000, nMax)), а також певне значення maxSum,
максимальну суму, яку кожен чотири послідовні цифри мають бути менше або дорівнювати. Функція має вивести наступний список з даними, детально описаними нижче:
[(1), (2), (3)]

(1) - кількість чисел, які задовольняють наведене вище обмеження

(2) - найближче число до середнього результатів, якщо їх більше одного, слід вибрати найменше число.

(3) - загальна сума всіх знайдених чисел

Розглянемо кейс з усіма подробицями:
max_sumDig(2000, 3) -------> [11, 1110, 12555]
(1) - Знайдено 11 чисел: 1000, 1001, 1002, 1010, 1011, 1020, 1100, 1101, 1110, 1200 and 2000
(2) - Середнє значення всіх знайдених чисел дорівнює:
(1000 + 1001 + 1002 + 1010 + 1011 + 1020 + 1100 + 1101 + 1110 + 1200 + 2000) /11 = 1141.36363,
тому 1110 — це число, яке найближче до цього середнього значення.
(3) - 12555 - це сума всіх знайдених чисел
1000 + 1001 + 1002 + 1010 + 1011 + 1020 + 1100 + 1101 + 1110 + 1200 + 2000 = 12555
Нарешті, давайте подивимося інші випадки:
max_sumDig(2000, 4) -----> [21, 1120, 23665]

max_sumDig(2000, 7) -----> [85, 1200, 99986]

max_sumDig(3000, 7) -----> [141, 1600, 220756]
*/
function max_sumDig(int $nMax, int $maxSum): array
{
    $resultArray = [];
    $finalArray = [];
    for ($i = 1000; $i <= $nMax; $i++) {
        $digits = str_split((string)$i);
        $sum = array_sum($digits);
        if ($sum <= $maxSum) {
            $resultArray[] = $i;
        }
    }

    $average = array_sum($resultArray) / sizeof($resultArray);
    $closestToAverage = null;
    foreach ($resultArray as $num) {
        if (abs($num - $average) < abs($closestToAverage - $average) || $closestToAverage === null) {
            $closestToAverage = $num;
        }
    }
    $finalArray[] = sizeof($resultArray);
    $finalArray[] = $closestToAverage;
    $finalArray[] = array_sum($resultArray);
    return $finalArray;
}

print_r(max_sumDig(3000, 7));

/*Божевільний кролик знаходиться в кавовому полі з межами в початковій клітинці (у прикладі pos = 0).
Кожна клітинка поля може містити кавові зерна.


  |             |
  |R____________|
2 2 4 1 5 2 7 # Божевільний кролик на старті"

 Божевільний кролик з'їдає всі кавові зерна, які є в клітині.
 І його сила стрибка збільшується. Загальна сила стрибка дорівнює загальній кількості з’їдених бобів

  |             |
  |R____________|
   0 2 4 1 5 2 7 # Crazy rabbit eat coffee beans and his jump power is now 2

   Божевільний кролик стрибає (спочатку вправо), якщо у нього є сила стрибка.

     _
  | / \         |
  |R___↓________|
   0 2 4 1 5 2 7 #Божевільний кролик стрибає на наступну позицію

   Божевільний кролик відскакує від кордону, якщо він стрибає занадто сильно

           ___
  |       /   \ |
  |      /     \|
  |     /     / |
  |____R_____↓__|
   0 2 0 1 5 2 7  # наступний стрибок матиме ступінь 6, тому що він з'їв ще 4 кавових зерна)

Позиція божевільного кролика в польовій клітині завжди посередині. Це означає, що якщо Божевільний кролик залишиться поруч із межею та має силу стрибка = 1,
то він буде відскочений назад у ту саму позицію.

Після попадання в межу Божевільний кролик стрибає в протилежному напрямку.

Вам буде надано:
поле як лінійний масив чисел
Божевільний кролик початкове положення
Чи зможе Божевільний кролик з'їсти всю квасолю? повернути логічне значення*/

function rabbitTask($field) {
    $arraySize = count($field);
    $currentPosition = 0;
    $jumpLength = 0;
    $direction = 1;
    $visited = array_fill(0, $arraySize, false);
    while (true) {
        if ($field[$currentPosition] > 0) {
            $jumpLength += $field[$currentPosition];
            $field[$currentPosition] = 0;
        }
        if (array_sum($field) == 0) {
            return true;
        }
        if ($jumpLength == 0) {
            return false;
        }
        $nextPos = $currentPosition + ($jumpLength * $direction);
        if ($nextPos < 0 || $nextPos >= $arraySize) {
            $direction *= -1;
            $jumpLength = 1;
            continue;
        }
        if ($visited[$nextPos]) {
            return false;
        }
        $visited[$currentPosition] = true;
        $currentPosition = $nextPos;
    }
}

$field = [4, 2, 4, 1, 5, 2, 7];
echo rabbitTask($field);

/*Напишіть функцію, яка за допомогою рядка тексту (можливо, із знаками пунктуації та розривами рядків) повертає масив із трьох найбільш часто
зустрічаються слів у порядку спадання кількості входжень.

Припущення:
Слово — це рядок літер (від A до Z), який необов’язково містить один або більше апострофів (') у ASCII.
Апостроф може стояти на початку, в середині або в кінці слова ('abc, abc', 'abc', ab'c усі дійсні)
Будь-які інші символи (наприклад, #, \, /, . ...) не є частиною слова і повинні розглядатися як пробіли.
    Збіги мають бути нечутливими до регістру, а слова в результаті мають бути написані малими літерами.
Зв'язки можуть бути розірвані довільно.
Якщо текст містить менше трьох унікальних слів, то повинні бути повернуті або перші 2 або перші слова, або порожній масив, якщо текст не містить слів.

top_3_words("In a village of La Mancha, the name of which I have no desire to call to
mind, there lived not long since one of those gentlemen that keep a lance
in the lance-rack, an old buckler, a lean hack, and a greyhound for
coursing. An olla of rather more beef than mutton, a salad on most
nights, scraps on Saturdays, lentils on Fridays, and a pigeon or so extra
on Sundays, made away with three-quarters of his income.")
# => ["a", "of", "on"]

top_3_words("e e e e DDD ddd DdD: ddd ddd aa aA Aa, bb cc cC e e e")
# => ["e", "ddd", "aa"]

top_3_words("  //wont won't won't")
# => ["won't", "wont"]

Уникайте створення масиву, обсяг пам’яті якого приблизно такий же, як і вхідний текст.
Уникайте сортування всього масиву унікальних слів.*/

function top_3_words($text) {

    preg_match_all("/[a-zA-Z']+/", strtolower($text), $matches);
    $words = $matches[0];
    $wordCount = [];
    foreach ($words as $word) {
        if (preg_match("/[a-zA-Z]+/", $word)) {
            $wordCount[$word] = isset($wordCount[$word]) ? $wordCount[$word] + 1 : 1;
        }
    }
    arsort($wordCount);
    return array_slice(array_keys($wordCount), 0, 3);
}

// Приклади використання
print_r(top_3_words("In a village of La Mancha, the name of which I have no desire to call to
mind, there lived not long since one of those gentlemen that keep a lance
in the lance-rack, an old buckler, a lean hack, and a greyhound for
coursing. An olla of rather more beef than mutton, a salad on most
nights, scraps on Saturdays, lentils on Fridays, and a pigeon or so extra
on Sundays, made away with three-quarters of his income."));
// => ["a", "of", "on"]

print_r(top_3_words("e e e e DDD ddd DdD: ddd ddd aa aA Aa, bb cc cC e e e"));
// => ["e", "ddd", "aa"]

print_r(top_3_words("  //wont won't won't"));
// => ["won't", "wont"]

?>