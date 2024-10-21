<?php

use Palmo\db\Db;

require_once '../vendor/autoload.php';

set_time_limit(0);

$dbh = (new Db())->getHandler();

$faker = Faker\Factory::create();
$faker->addProvider(new Faker\Provider\en_US\Address($faker));
$faker->addProvider(new Faker\Provider\en_US\Person($faker));
$faker->addProvider(new Faker\Provider\en_US\Company($faker));
$faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
$faker->addProvider(new Faker\Provider\en_US\Text($faker));


if (!empty($_POST['dish_amount'])) {
    $dishAmount = $_POST['dish_amount'];
    for ($i = 0; $i < $dishAmount; $i++) {

        $name = $faker->sentence(3);

        if (str_contains($name, "'")) {
            $street = str_replace("'", "\'", $name);
        }
        $categories = [
            "Dessert",
            "Main Course",
            "Appetizer",
            "Salad",
            "Soup",
            "Snack",
            "Breakfast",
            "Beverage",
            "Side Dish",
            "Sauce"
        ];
        $category = $categories[$faker->randomDigit()];

        if (str_contains($category, "'")) {
            $street = str_replace("'", "\'", $category);
        }
        $areas = [
            "Italian",
            "Chinese",
            "Mexican",
            "Indian",
            "Japanese",
            "French",
            "Greek",
            "Thai",
            "Spanish",
            "American"
        ];
        $area = $areas[$faker->randomDigit()];
        if (str_contains($category, "'")) {
            $street = str_replace("'", "\'", $area);
        }

        $img = $faker->imageUrl(360, 360, 'animals', true, 'cats');

        $description = $faker->sentence(20);
        if (str_contains($description, "'")) {
            $street = str_replace("'", "\'", $description);
        }

        $dbh->query("insert into Dish (name,category,area,img,description)
        VALUES ('{$name}', '{$category}', '{$area}', '{$img}', '{$description}')");
    }
}

if (!empty($_POST['preferences'])) {
    $preferences = $_POST['preferences'];
    for ($i = 0; $i < $preferences; $i++) {
        $user_id = $faker->numberBetween(1, 2);
        $dish_id = $faker->numberBetween(1, 1000);
        $dbh->query("insert into UserPreferences (user_id,dish_id)
        VALUES ({$user_id}, {$dish_id})");
    }
}


header('Location: ../views/hello-page.php');

