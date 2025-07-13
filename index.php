<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    echo "<p>Please <a href='login.php'>login</a>.</p>";
    exit;
}

$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head><title>Blog - Home</title></head>
<body>
<h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> (<?= $_SESSION['role'] ?>)</h2>
<a href="add_post.php">Add Post</a> | <a href="logout.php">Logout</a>
<hr>
<h3>All Posts</h3>
<?php foreach ($posts as $post): ?>
<div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
    <h4><?= htmlspecialchars($post['title']) ?></h4>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <small><?= $post['created_at'] ?></small><br>
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="edit_post.php?id=<?= $post['id'] ?>">Edit</a> |
        <a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
    <?php endif; ?>
</div>
<?php endforeach; ?>
</body>
</html>
