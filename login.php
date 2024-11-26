<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    if (!empty($username)) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        echo "Veuillez saisir un nom d'utilisateur.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>
    <form method="POST">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" require>

        <button type="submit">Envoyer</button>
    </form>
</body>

</html>