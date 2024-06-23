<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fahkwang:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <title>Letter Page</title>
    <style>
        body {
            background-image: url('images/letter-bg.jpg');
            background-size: cover; 
            background-position: center;
            text-align: center;
            margin: 50px auto;
            text-align: center;
        }

        .post-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            padding-top: 5px;
            border: 1px solid white;
            height: 220px;
            display: flex;
            text-align: left;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-family: "Amaranth", sans-serif;
            font-weight: 700;
            font-size: 50px;
            margin: 15px;
            color: white;
            font
        }

        h6 {
            font-family: "Amaranth", sans-serif;
            font-weight: 700;
            font-size: 20px;
            margin: 15px;
        }

        p {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-size: 15px;
            margin: 15px;
        }

        #back {
            font-family: "Bebas Neue", sans-serif;
            font-size: 25px;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.3); 
            backdrop-filter: blur(10px); 
        }

        #back:hover {
            background-color: gray;
            color: white;
        }

        .styled-text {
            color: white; 
            font-size: 48px; 
            font-weight: bold;
            text-shadow: 2px 2px 0px black; 
        }


    </style>
</head>

<body>
    <h1 class="styled-text">THE LETTER</h1>
    <div class="post-container">
        <div id="postDetails">
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
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query = "SELECT * FROM `posts` WHERE id = :id";
                        $statement = $pdo->prepare($query);
                        $statement->execute([':id' => $id]);

                        $post = $statement->fetch(PDO::FETCH_ASSOC);

                        if ($post) {
                            echo '<p><h6>Title: </h6>' . $post['title'] . '</p>';
                            echo "<hr>";
                            echo '<p><h6>Message: </h6>' . $post['body']. '</p>';
                        } else {
                            echo "No post found with ID $id!";
                        }
                    } else {
                        echo "No post ID provided!";
                    }
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            ?>
        </div>
    </div>
        </div>
    <button id="back">BACK TO MAIN PAGE</button>
</body>

<script>
    document.getElementById("back").addEventListener("click", function() {
        window.location.href = "posts.php";
    });
</script>
</html>