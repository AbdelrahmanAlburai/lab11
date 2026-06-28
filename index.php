<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Card Generator</title>
    <style>
        body{
            margin:0;
            font-family:Arial, sans-serif;
            background:#0f1020;
            color:white;
        }

        header{
            text-align:center;
            padding:40px;
            background:linear-gradient(135deg,#1f1835,#341d46);
            border-bottom:3px solid #d783ff;
        }

        header h1{
            color:#d783ff;
            margin:10px 0;
        }

        .stats{
            display:flex;
            justify-content:center;
            gap:25px;
            margin:35px 0;
        }

        .stat{
            background:#1d1e2e;
            padding:20px 40px;
            border-radius:15px;
            text-align:center;
            border:1px solid #3a3b52;
        }

        .stat h2{
            color:#d783ff;
            margin:0;
        }

        .cards{
            width:90%;
            margin:30px auto;
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
            gap:25px;
        }

        .card{
            background:#1b1c2c;
            border-radius:20px;
            padding:25px;
            text-align:center;
            border:1px solid #34364d;
            box-shadow:0 10px 25px rgba(0,0,0,0.4);
            transition:0.3s;
        }

        .card:hover{
            transform:translateY(-8px);
            border-color:#d783ff;
        }

        .avatar{
            width:85px;
            height:85px;
            margin:auto;
            border-radius:50%;
            background:linear-gradient(135deg,#d783ff,#6ee7ff);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:32px;
            font-weight:bold;
            color:#111;
        }

        .card h2{
            color:#fff;
            margin-top:15px;
        }

        .role{
            color:#d783ff;
            font-weight:bold;
        }

        .info{
            color:#bbb;
            margin:8px 0;
        }

        .skills{
            margin-top:15px;
        }

        .skill{
            display:inline-block;
            background:#2c2d42;
            color:#6ee7ff;
            padding:6px 10px;
            border-radius:20px;
            margin:4px;
            font-size:13px;
        }

        footer{
            text-align:center;
            color:#777;
            padding:25px;
        }
    </style>
</head>
<body>

<?php

$people = [
    [
        "name" => "Abdelrahman Alburai",
        "role" => "Smart Systems Student",
        "email" => "abdelrahmanalburai@gmail.com",
        "city" => "Palestine",
        "skills" => ["HTML", "CSS", "PHP"]
    ],
    [
        "name" => "Mohammed Salem",
        "role" => "Web Developer",
        "email" => "mohammed@example.com",
        "city" => "Gaza",
        "skills" => ["JavaScript", "Bootstrap", "PHP"]
    ],
    [
        "name" => "Sara Ahmed",
        "role" => "UI Designer",
        "email" => "sara@example.com",
        "city" => "Khan Younis",
        "skills" => ["Figma", "CSS", "Design"]
    ]
];

function getInitials($name) {
    $parts = explode(" ", $name);
    return strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
}

function showSkills($skills) {
    foreach ($skills as $skill) {
        echo "<span class='skill'>$skill</span>";
    }
}

?>

<header>
    <h3>Al-Aqsa University</h3>
    <h1>Profile Card Generator</h1>
    <p>Week 11 - Task 01: PHP Arrays, Functions & Loops</p>
</header>

<section class="stats">
    <div class="stat">
        <h2><?php echo count($people); ?></h2>
        <p>Total People</p>
    </div>

    <div class="stat">
        <h2><?php echo date("Y-m-d"); ?></h2>
        <p>Current Date</p>
    </div>
</section>

<section class="cards">

    <?php foreach ($people as $person): ?>

        <div class="card">
            <div class="avatar">
                <?php echo getInitials($person["name"]); ?>
            </div>

            <h2><?php echo $person["name"]; ?></h2>

            <p class="role"><?php echo $person["role"]; ?></p>

            <p class="info">Email: <?php echo $person["email"]; ?></p>
            <p class="info">City: <?php echo $person["city"]; ?></p>

            <div class="skills">
                <?php showSkills($person["skills"]); ?>
            </div>
        </div>

    <?php endforeach; ?>

</section>

<footer>
    Al-Aqsa University — Web Development 1
</footer>

</body>
</html>