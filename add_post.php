<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (strlen($title) < 5) {
        echo "Title too short";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);

    header("Location: index.php");
}
?>
<form method="post" onsubmit="return validatePostForm()">
    <input type="text" name="title" id="title" required placeholder="Title"><br>
    <textarea name="content" id="content" required placeholder="Content"></textarea><br>
    <input type="submit" value="Add Post">
</form>
