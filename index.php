<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <h1>Bienvenue, <?php echo $_SESSION['username']; ?>!</h1>
    <p><a href="logout.php">Se déconnecter</a></p>
    <p><a href="add.php">Ajouter un utilisateur</a></p>
    <!-- Liste des utilisateurs -->
</body>
</html>