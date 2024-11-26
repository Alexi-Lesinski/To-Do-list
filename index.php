<?php
session_start();

// creation tableau pour stocker les taches
if (!isset($_SESSION['taches'])) {
    $_SESSION['taches'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deco'])) {
    // Déconnexion : destruction de la session
    session_unset();
    session_destroy();

    // Redirection vers la page de connexion
    header('Location: login.php');
    exit;
} 
// ajout d'une nouvelle tâche dans le tableau avec nom, description, id, date et état
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['nameTask']) ? trim(htmlspecialchars($_POST['nameTask'])) : '';
    $description = isset($_POST['descriptionTask']) ? trim(htmlspecialchars($_POST['descriptionTask'])) : '';

    if (!empty($name)) {
        $id = uniqid();  // génération d'un id unique
        $date = date('d/m/Y'); // création de la date
        $_SESSION['taches'][] = [
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'completed' => false,
            'date' => $date,
        ];
    }
}

// suppression d'une tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $taskId = $_POST['delete'];
    foreach ($_SESSION['taches'] as $index => $task) {
        if ($task['id'] === $taskId) {
            unset($_SESSION['taches'][$index]);
            $_SESSION['taches'] = array_values($_SESSION['taches']);
        }
    }
}

// modification d'une tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['completed'])) {
    $taskId = $_POST['task_id'];
    foreach ($_SESSION['taches'] as & $task) {
        if ($task['id'] === $taskId) {
            $task['completed'] = true;
            header("Location: ".$_SERVER['PHP_SELF']); 
            exit;
        }
    }
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do list Eval</title>
    <link rel="stylesheet" href="CSS/styles.css">

</head>

<header>
    <?php require_once 'nav.php';?>  <!-- inclusion du menu de navigation -->

</header>


<body>
    
    <?php
    // Si utilisateur connecté, afficher le titre et la to do list
    if (isset($_SESSION['username'])) {
        echo '<h1>' . "Bienvenue " . $_SESSION['username'] . PHP_EOL . "voici votre to do list : " .  '</h1>';
    } else {
        echo '<h1>Veuillez vous connecter pour voir votre to do list</h1>';
        header('Location: login.php');
    }

    ?>

    <form method="POST">
        <input type="text" placeholder="Nom de votre tâche" id="nameTask" name="nameTask" required>
        <input type="text" placeholder="Description de votre tâche" id="descriptionTask" name="descriptionTask">
        <input type="submit" value="Ajouter une tâche">
    </form>

    <div id="tacheActuelle">
        <?php if (!empty($_SESSION['taches'])): 
            // Si il y a des tâches dans le tableau alors affichage de la tâche dans un tableau
            ?>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Actions</th>
                        <th>Date :</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['taches'] as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task['id']) // affichage de l'id?></td>
                            <td><?= str_replace(' ', '-', htmlspecialchars($task['name'])) //affichage du nom + modification des espaces par un - ?></td> 
                            <td><?= htmlspecialchars($task['description']) // affichage de la description?></td>
                            <td style="color: <?= $task['completed'] ? 'green' : 'red'  // Affichage de la tâche est compléter et modifie la couleur ?>;">

                                <?= $task['completed'] ? 'Terminée' : 'En cours' //Affiche un message si tâche compléter ou pas ?>
                            </td>
                            <td>
                                <!-- Formulaire pour la suppression -->
                                <form method="POST">
                                    <input type="hidden" name="delete" value="<?= htmlspecialchars($task['id']) ?>">
                                    <input type="submit" value="Supprimer">
                                </form>
                                <!-- Formulaire pour la modification d'état -->
                                <form method="POST" >
                                    <input type="hidden" name="task_id" value="<?= htmlspecialchars($task['id']) ?>">
                                    <input type="submit" name="completed" value="Tâche complétée">
                                </form>
                                <!-- Affichage de la date -->
                            <td class="Date"><?= htmlspecialchars($task['date']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Si il n'y a pas de tâche dans le tableau alors affichage d'un message --> 
            <p>Aucune tâche n'a été ajoutée.</p>
        <?php endif; ?>
    </div>
</body>

</html>