<?php
require "../vendor/autoload.php";

use Palmo\repository\ForumRepository;
use Palmo\repository\UserRepository;

session_start();

if (!isset($_SESSION['userId'])) {
    session_unset();
    session_destroy();
    header("Location:../views/login.php");
    exit();
}
$forumRepository = new ForumRepository();
$userRepository = new UserRepository();
$allMessages = $forumRepository->getMessages();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Forum</title>
    <link rel="stylesheet" href='../css/forum.css'>
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
<main>
    <div class="messages-box">
        <?php foreach ($allMessages as $message):
            $user = $userRepository->findById($message['user_id']);
            ?>
            <div class="message-item">
                <span class="message-user">Name: <?= $user->getName() ?></span>
                <p class="message-text"><?= htmlspecialchars($message['text']) ?></p>
                <span class="message-time"><?= $message['time'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="write-box">
        <form method="POST" action="../controller/run.php">
            <label for="message">Write new message here</label>
            <input type="text" id="message" name="message" placeholder="Type your message...">
            <input type="hidden" name="CSRFToken" value="<?php echo $_SESSION['CSRFToken'] ?>">
            <button type="submit">Send message</button>
        </form>
        <?php if (isset($_SESSION['error'])):?>
        <p style="color: #930e0e">Error: <?php echo $_SESSION['error']; unset($_SESSION['error']);?></p>
        <?php endif;?>
    </div>
</main>
</body>
</html>

