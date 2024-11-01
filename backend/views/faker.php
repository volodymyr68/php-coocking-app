<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Backend</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
</head>
<body>
<form method="POST" action="../faker/db_seeder.php">
    <div>
        <span>dish_amount</span>
        <input type="number" min="0" name="dish_amount">
    </div>
    <div>
        <span>User preferences</span>
        <input type="number" min="0" name="preferences">
    </div>
    <div>
        <span>User amount</span>
        <input type="number" min="0" name="user_amount">
    </div>
    <button type="submit" class="btn btn-primary">Seed</button>
</form>
</body>
</html>