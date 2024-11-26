<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deco'])) {
    // Déconnexion : destruction de la session
    session_unset();
    session_destroy();

    // Redirection vers la page de connexion
    header('Location: login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/nav.css">
</head>
<body>
    <header>
        <form method="POST" class="navDeconexion">
            <nav>
                <input type="hidden" name="deco" value="1"> 
                <input type="submit" value="Déconnexion" id="deco"> 
             </nav>
        </form>
    </header>
</body>
</html>