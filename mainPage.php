<?php

session_start();

include("class/User.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page Principale</title>
    <style>
        /* Styling for the Proviflix button */
        .proviflix-btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 20px;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            background-color: #FF5733;
            border-radius: 10px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;

        }
        .proviflix-btn:hover {
            background-color: #FF6E4A;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <?php
    $GLOBALS["pdo"] = new PDO('mysql:host=192.168.64.213;dbname=Lawrence', 'root', 'root');
    $User = new User(null, null, null);

    if (!$User->isConnect()) {
        header("Location: index.php");
    }

    // echo "coucou";

    ?>

    <!-- Adding the Proviflix button -->
    <center><a target="_blank"href="https://bit.ly/proviflix" class="proviflix-btn">ALLEZ SUR PROVIFLIX</a></center>

</body>
</html>
