<?php
require_once "db.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $age = $_POST["age"] ?? "";
    $major = trim($_POST["major"] ?? "");
    $gpa = $_POST["gpa"] ?? "";

    if (empty($name)) $errors[] = "Name is required";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email";
    if (!is_numeric($age) || $age < 16 || $age > 70) $errors[] = "Age must be between 16 and 70";
    if (empty($major)) $errors[] = "Major is required";
    if (!is_numeric($gpa) || $gpa < 0 || $gpa > 4) $errors[] = "GPA must be between 0 and 4";

    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO students (name, email, age, major, gpa)
            VALUES (:name, :email, :age, :major, :gpa)
        ");

        $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":age" => $age,
            ":major" => $major,
            ":gpa" => $gpa
        ]);

        setFlash("success", "Student added successfully");
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <style>
        body { background:#0f0f1a; color:#e0e0e0; font-family:Arial,sans-serif; }
        .box { width:500px; margin:50px auto; background:rgba(255,255,255,0.04); padding:25px; border-radius:15px; }
        h1 { color:#ce93d8; text-align:center; }
        input { width:100%; padding:12px; margin:8px 0; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.1); color:white; border-radius:8px; }
        button, a { background:#ce93d8; color:#1a1a2e; padding:12px; border:none; border-radius:8px; text-decoration:none; font-weight:bold; display:inline-block; margin-top:10px; }
        .error { background:#f44336; padding:10px; border-radius:8px; margin-bottom:10px; }
    </style>
</head>
<body>

<div class="box">
    <h1>Add New Student</h1>

    <?php foreach ($errors as $error): ?>
        <div class="error"><?= clean($error) ?></div>
    <?php endforeach; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Student Name">
        <input type="email" name="email" placeholder="Email Address">
        <input type="number" name="age" placeholder="Age">
        <input type="text" name="major" placeholder="Major">
        <input type="number" step="0.01" name="gpa" placeholder="GPA">
        <button type="submit">Save Student</button>
        <a href="index.php">Back</a>
    </form>
</div>

</body>
</html>