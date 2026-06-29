<?php
require_once "db.php";

$perPage = 10;
$currentPage = max(1, (int)($_GET["page"] ?? 1));
$offset = ($currentPage - 1) * $perPage;

$totalStmt = $pdo->query("SELECT COUNT(*) FROM students");
$totalStudents = $totalStmt->fetchColumn();
$totalPages = ceil($totalStudents / $perPage);

$stmt = $pdo->prepare("SELECT * FROM students ORDER BY id DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(":limit", $perPage, PDO::PARAM_INT);
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->execute();
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <style>
        body { background:#0f0f1a; color:#e0e0e0; font-family:Arial,sans-serif; margin:0; }
        header { background:linear-gradient(135deg,#1a1a2e,#2d1b3d); padding:30px; text-align:center; }
        header h1 { color:#ce93d8; margin:0; }
        .container { width:90%; margin:30px auto; }
        .top { display:flex; justify-content:space-between; gap:10px; margin-bottom:20px; }
        a, button { background:#ce93d8; color:#1a1a2e; padding:10px 14px; border-radius:8px; text-decoration:none; font-weight:bold; border:none; }
        table { width:100%; border-collapse:collapse; background:rgba(255,255,255,0.03); border-radius:12px; overflow:hidden; }
        th, td { padding:14px; border-bottom:1px solid rgba(255,255,255,0.08); text-align:left; }
        th { color:#ce93d8; }
        .danger { background:#f44336; color:white; }
        .edit { background:#4caf50; color:white; }
        .alert { padding:12px; margin-bottom:15px; border-radius:8px; }
        .success { background:#4caf50; color:white; }
        .error { background:#f44336; color:white; }
        .pagination { margin-top:20px; text-align:center; }
        .pagination a { margin:4px; display:inline-block; }
        .active { background:#ce93d8 !important; color:#1a1a2e !important; }
    </style>
</head>
<body>

<header>
    <h1>Student Management System</h1>
    <p>Assignment 11 - PHP + MySQL CRUD</p>
</header>

<div class="container">

    <?php showFlash(); ?>

    <div class="top">
        <a href="add.php">+ Add Student</a>
        <a href="search.php">Search Students</a>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Major</th>
            <th>GPA</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student["id"] ?></td>
                <td><?= clean($student["name"]) ?></td>
                <td><?= clean($student["email"]) ?></td>
                <td><?= $student["age"] ?></td>
                <td><?= clean($student["major"]) ?></td>
                <td><?= $student["gpa"] ?></td>
                <td>
                    <a class="edit" href="edit.php?id=<?= $student["id"] ?>">Edit</a>
                    <a class="danger" href="delete.php?id=<?= $student["id"] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="<?= $i === $currentPage ? 'active' : '' ?>" href="?page=<?= $i ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

</div>

</body>
</html>