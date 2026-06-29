<?php
require_once "db.php";

$id = (int)($_GET["id"] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
$stmt->execute([$id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found");
}

if (isset($_POST["confirm"])) {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);

    setFlash("success", "Student deleted successfully");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
    <style>
        body { background:#0f0f1a; color:#e0e0e0; font-family:Arial,sans-serif; }
        .box { width:500px; margin:80px auto; background:rgba(255,255,255,0.04); padding:25px; border-radius:15px; text-align:center; }
        h1 { color:#f44336; }
        button, a { padding:12px 18px; border-radius:8px; text-decoration:none; font-weight:bold; border:none; margin:5px; }
        button { background:#f44336; color:white; }
        a { background:#ce93d8; color:#1a1a2e; }
    </style>
</head>
<body>

<div class="box">
    <h1>Delete Student</h1>
    <p>Are you sure you want to delete:</p>
    <h2><?= clean($student["name"]) ?></h2>

    <form method="POST">
        <button name="confirm" type="submit">Yes, Delete</button>
        <a href="index.php">Cancel</a>
    </form>
</div>

</body>
</html>