<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=McLaren&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Sofia+Sans+Extra+Condensed:ital,wght@0,1..1000;1,1..1000&display=swap" rel="stylesheet">
    <title>Titles Page</title>
    <style>
        body {
            background-image: url('images/bg.png');
            background-size: cover; 
            background-position: center;
            text-align: center;
        }

        .posts-container {
            max-width: 50%;
            max-height: 100%;
            padding: 20px;
            padding-top: 10px;
            padding-bottom: 5px;
            border: 1px solid white;
            border-radius: 5px;
            margin: 50px auto;
        }

        h1 {
            font-family: "McLaren", sans-serif;
            font-weight: 600;
            color: black;
            font-size: 30px;
            padding: 10px;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
            color: black;
        }

        li {
            margin-bottom: 10px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        li a {
            text-decoration: none; 
            color: black; 
            display: block; 
            width: 100%;
            height: 100%;
            font-family: "Fahkwang", sans-serif;
            font-weight: 400;
            font-size: 20px;
            margin:auto;
            margin-top: 10px;
            text-align: center;
        }

        li:hover {
            color: white;
            background-color: white;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px); 
        }

        button {
            font-family: "Bebas Neue", sans-serif;
            font-size: 25px;
            border-radius: 5px;
            margin-bottom: 20px;
            background: rgba(255, 255, 255, 0.3); 
            backdrop-filter: blur(10px); 
        }

        button:hover {
            background-color: gray;
            color: white;
        }

    </style>
</head>

<body>
    <div class="posts-container">
        <h1>TITLE OF LETTERS</h1>
        <ul id="postLists">
            <?php

            require 'config.php';

            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit;
            }

            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

            try {
                $pdo = new PDO($dsn, $user, $password, $options);

                if ($pdo) {
                    $user_id = $_SESSION['user_id'];

                    $query = "SELECT * FROM `posts` WHERE user_id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $user_id]);

                    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($rows as $row) {
                        echo '<li><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </ul>
            <button id="back">LOG OUT</button>
    </div>
</body>

<script>
    document.getElementById("back").addEventListener("click", function() {
        window.location.href = "logout.php";
    });
</script>
</html>