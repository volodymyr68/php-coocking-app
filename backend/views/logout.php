<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
    <link rel="stylesheet" href='../css/logout.css'>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../views/profile.php">Profile</a></li>
            <li><a href="../views/mydishes.php">My dishes</a></li>
            <li><a href="../views/random.php">Random dishes</a></li>
            <li><a href="../views/preferences.php">Preferences</a></li>
            <li><a href="../views/forum.php">Forum</a></li>
            <li><a href="../views/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
<div class="container">
    <h2>Logout</h2>
    <p>Are you sure you want to go out?</p>
    <form method="POST" action="../controller/run.php">
        <input type="hidden" name="logout" value="true">
        <input type="hidden" name="CSRFToken" value="<?php echo $_SESSION['CSRFToken'] ?>">
        <input type="submit" value="Logout">
    </form>
</div>
</body>
</html>