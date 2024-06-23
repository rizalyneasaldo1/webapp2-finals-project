<?php

require 'config.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$errorMessage = '';

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('asaldo345678' === $password) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: posts.php");
                    exit;
                } else {
                    $errorMessage = "Invalid password!";
                }
            } else {
                $errorMessage = "User not found!";
            }
        }
    }
}
catch (PDOException $e) {
    $errorMessage = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Login Page</title>   

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            margin-left: 10%;
            align-items: center;
            height: 100vh;
            text-align: center;
            background-image: url('images/bg.png');
            background-size: cover; 
            background-position: center;
        }

        form {
            background-color: antiquewhite;
            opacity: 0.80;
            padding: 50px;
            border-radius: 10px;
            margin-left: 5%;
        }

        form:hover {
            opacity: 1;
        }

        h1 {
            font-family: "Bebas Neue", sans-serif;
            font-size: 40px;
        }

        .error-message {
            color: red;
            font-family: "Oswald", sans-serif;
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        label {
            font-family: "Oswald", sans-serif;
            font-size: 20px;
        }

        button {
            font-family: "Bebas Neue", sans-serif;
            font-size: 25px;
            border-radius: 5px;
        }

        button:hover {
            background-color: gray;
            color: white;
        }

        .image-container {
            width: 800px; 
            max-height: 100%; 
            display: flex;
            align-items: center; 
            justify-content: center; 
            overflow: hidden;
            margin-left: 5%;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%; 
            object-fit: cover; 
        }
    </style>
</head>

<body>
    <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <img src="images/icon.png" id="ui" height="130px" width="130px"> 
        <h1>USER'S LETTERS</h1>
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <label for="username"> Enter username : </label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password"> Enter password : </label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button id="submit">SUBMIT</button>
    </form>
    <div class="image-container">
        <img src="images/char.png">
    </div>
</body>
</html>