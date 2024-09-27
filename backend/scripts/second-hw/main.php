<?php
//Створіть функцію, яка обчислює середнє арифметичне значення з масиву чисел.
function average(array $data): int
{
    if (empty($data)) {
        return 0;
    }
    return array_sum($data) / count($data);
}

echo average([1, 2, 3, 4, 5]);
echo "<br>";
//Напишіть функцію для перевертання рядка.
function reverseString(string $str): string
{
    return strrev($str);
}

echo reverseString('Hello, World!');
echo "<br>";
//Створіть функцію, яка приймає масив чисел і повертає новий масив, в якому всі елементи збільшені на 10.
function multiplyArray(array $array): array
{
    foreach ($array as $key => $value) {
        $array[$key] = $value * 10;
    }
    return $array;
}

print_r(multiplyArray([1, 2, 3, 4, 5]));
echo "<br>";
//Напишіть функцію для визначення кількості голосних літер у рядку.

function countVowels(string $str): int
{
    $str = strtolower($str);
    define('vowels', ['a', 'e', 'i', 'o', 'u']);
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++) {
        if (in_array($str[$i], vowels)) {
            $count++;
        }
    }

    return $count;
}

echo countVowels('Hello, World!');
echo "<br>";
//Створіть функцію для видалення дублікатів з масиву.
function removeDuplicates(array $data): array
{
    return array_unique($data);
}

print_r(removeDuplicates([1, 2, 2, 3, 4, 4, 5]));
echo "<br>";
//Напишіть функцію для перевірки того, чи є слово паліндромом.

function isPalindrome(string $str): bool
{
    $str = strtolower(str_replace(' ', '', $str));
    return $str === strrev($str);
}

echo isPalindrome('abbac');
echo "<br>";
//Створіть функцію, яка повертає масив, який складається з парних чисел від 1 до 50.
function getOddArray(): array
{
    $arr = [];
    for ($i = 0; $i <= 50; $i += 2) {
        if ($i !== 0) {
            $arr[] = $i;
        }
    }
    return $arr;
}

print_r(getOddArray());
echo "<br>";
//Напишіть функцію для знаходження найменшого та найбільшого значення в масиві чисел.
function findMinMax(array $numbers): array
{
    $min = min($numbers);
    $max = max($numbers);
    return ['min' => $min, 'max' => $max];
}

$result = findMinMax([3, 5, 1, 9, 2, 8]);
echo 'Min: ' . $result['min'];
echo "<br>";
echo 'Max: ' . $result['max'];
echo "<br>";
//Створіть функцію, яка приймає асоціативний масив і повертає новий масив зі значеннями, відсортованими за алфавітом за ключами.
function sortArrayByKeys(array $data): array
{
    ksort($data);
    return $data;
}

$assocArray = [
    'c' => 3,
    'b' => 1,
    'a' => 2,
    'd' => 4
];
$sortedArray = sortArrayByKeys($assocArray);
print_r($sortedArray);
echo "<br>";
//Напишіть функцію для обчислення факторіала числа.
function factorial(int $number): int
{
    if ($number <= 1) {
        return true;
    }
    return $number * factorial($number - 1);
}

echo factorial(5);
echo "<br>";
//Створіть функцію, яка знаходить всі прості числа в заданому діапазоні.
function getPrimeArray(int $start, int $end): array
{
    function isPrime(int $value): bool
    {
        if ($value < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($value); $i++) {
            if ($value % $i === 0) {
                return false;
            }
        }
        return true;
    }

    $primeArray = [];
    for ($i = $start; $i <= $end; $i++) {
        if (isPrime($i)) {
            $primeArray[] = $i;
        }
    }
    return $primeArray;
}

print_r(getPrimeArray(1, 17));
echo "<br>";
//Напишіть функцію для об'єднання двох масивів без повторень.
function mergeArrays(array $arr1, array $arr2): array
{
    return array_unique(array_merge($arr1, $arr2));
}

print_r(mergeArrays([1, 2, 3], [2, 3, 4]));
echo "<br>";
//Створіть функцію, яка приймає рядок та повертає новий рядок, в якому кожне слово починається з великої літери.
function capitalizeWords(string $str): string
{
    $words = explode(" ", $str);
    foreach ($words as &$word) {
        $word = ucfirst($word);
    }
    return implode(" ", $words);
}

echo capitalizeWords('hello world  test');
echo "<br>";
//Напишіть функцію для генерації випадкового пароля заданої довжини.
function generateRandomPassword(int $length): string
{
    define('characters', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+[]{}|;:,.<>/?');
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= characters[rand(0, strlen(characters) - 1)];
    }
    return $password;
}

echo generateRandomPassword(10);
echo "<br>";
//Створіть функцію для знаходження суми елементів на головній діагоналі квадратної матриці.
function sumMainDiagonal(array $matrix): int
{
    $sum = 0;
    for ($i = 0; $i < count($matrix); $i++) {
        $sum += $matrix[$i][$i];
    }
    return $sum;
}

$matrix = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9]
];
echo sumMainDiagonal($matrix);
echo "<br>";
//Напишіть функцію для видалення всіх HTML-тегів з рядка.
function removeHtmlTags(string $str): string
{
    return preg_replace('/<[^>]*>/', '', $str);
}

echo removeHtmlTags("<h1>Hello, World!</h1>");
echo "<br>";
//Створіть функцію для реверсу асоціативного масиву (замініть ключі на значення і навпаки).
function reverseAssocArray(array $data): array
{
    return array_flip($data);
}

$assocArray = [
    'name' => 'John',
    'age' => 30,
    'city' => 'New York'
];
print_r(reverseAssocArray($assocArray));
echo "<br>";
//Напишіть функцію для перетворення рядка у крапковану нотацію (camelCase).
function toCamelCase(string $string): string
{
    $words = preg_split('/[\s_-]+/', $string);
    $camelCase = strtolower(array_shift($words));
    foreach ($words as $word) {
        $camelCase .= ucfirst(strtolower($word));
    }

    return $camelCase;
}

echo toCamelCase('test test test');
echo "<br>";
//Створіть функцію, яка перевіряє, чи є число ступенем двійки.
function isPowerOfTwo(int $number): bool
{
    if ($number < 1) {
        return false;
    }
    while ($number % 2 === 0) {
        $number /= 2;
    }
    return $number === 1;
}

echo isPowerOfTwo(16);
echo "<br>";
//Створіть функцію для знаходження суму елементів масиву, які діляться на 3.
function sumDivisibleByThree(array $array): int
{
    $sum = 0;
    foreach ($array as $value) {
        if ($value % 3 === 0) {
            $sum += $value;
        }
    }
    return $sum;
}

$array = [1, 2, 3, 4, 5, 6, 7, 8, 9];
echo sumDivisibleByThree($array);
echo "<br>";
//Напишіть функцію для сортування масиву об'єктів за значенням конкретного ключа
function sortArrayByKey(array $array, int $key): array
{
    usort($array, function ($a, $b) use ($key) {
        return $a[$key] <=> $b[$key];
    });
    return $array;
}

$array = [
    ['name' => 'John', 'age' => 30],
    ['name' => 'Alice', 'age' => 25],
    ['name' => 'Bob', 'age' => 35]
];
print_r(sortArrayByKey($array, 'age'));
echo "<br>";
