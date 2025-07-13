<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if (strlen($title) < 5) {
        echo "Title too short";
        exit;
    }

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $post = $stmt->fetch();
}
?>
<form method="post">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <input type="text" name="title" value="<?= $post['title'] ?>" required><br>
    <textarea name="content" required><?= $post['content'] ?></textarea><br>
    <input type="submit" value="Update">
</form>
