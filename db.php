<?php
session_start();

$host = "localhost";
$dbname = "student_system";
$username = "root";
$password = "";

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function setFlash($type, $message) {
    $_SESSION["flash"] = [
        "type" => $type,
        "message" => $message
    ];
}

function showFlash() {
    if (isset($_SESSION["flash"])) {
        $type = $_SESSION["flash"]["type"];
        $message = $_SESSION["flash"]["message"];

        echo "<div class='alert $type'>" . htmlspecialchars($message) . "</div>";

        unset($_SESSION["flash"]);
    }
}

function clean($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, "UTF-8");
}
?>