<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
</head>
<body>

<nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
    </ul>
</nav>

<div class="container">
    <h2>Выход из системы</h2>
    <p>Вы уверены, что хотите выйти?</p>
    <form method="POST" action="../controller/auth.php">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>
</div>

</body>
</html>