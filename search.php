<?php
require_once "db.php";

$query = trim($_GET["q"] ?? "");
$students = [];

if (!empty($query)) {
    $stmt = $pdo->prepare("
        SELECT * FROM students
        WHERE name LIKE :q OR email LIKE :q OR major LIKE :q
        ORDER BY name ASC
    ");

    $stmt->execute([":q" => "%$query%"]);
    $students = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Students</title>
    <style>
        body { background:#0f0f1a; color:#e0e0e0; font-family:Arial,sans-serif; margin:0; }
        header { background:linear-gradient(135deg,#1a1a2e,#2d1b3d); padding:30px; text-align:center; }
        header h1 { color:#ce93d8; }
        .container { width:90%; margin:30px auto; }
        input { width:70%; padding:12px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:white; border-radius:8px; }
        button, a { background:#ce93d8; color:#1a1a2e; padding:12px 16px; border-radius:8px; text-decoration:none; border:none; font-weight:bold; }
        table { width:100%; border-collapse:collapse; margin-top:25px; background:rgba(255,255,255,0.03); }
        th, td { padding:14px; border-bottom:1px solid rgba(255,255,255,0.08); text-align:left; }
        th { color:#ce93d8; }
    </style>
</head>
<body>

<header>
    <h1>Search Students</h1>
    <p>Search by name, email, or major</p>
</header>

<div class="container">
    <form method="GET">
        <input type="text" name="q" placeholder="Type search keyword..." value="<?= clean($query) ?>">
        <button type="submit">Search</button>
        <a href="index.php">Back</a>
    </form>

    <?php if (!empty($query)): ?>
        <p>Found <?= count($students) ?> result(s)</p>

        <table>
            <tr>
                <th>ID</th>
                <th>Student Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Major</th>
                <th>GPA</th>
            </tr>

            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= $student["id"] ?></td>
                    <td><?= clean($student["name"]) ?></td>
                    <td><?= clean($student["email"]) ?></td>
                    <td><?= $student["age"] ?></td>
                    <td><?= clean($student["major"]) ?></td>
                    <td><?= $student["gpa"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>