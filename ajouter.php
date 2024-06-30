<?php
require 'User.php';
$user = new User($mysqli);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($user->addUser($username, $password)){
        header("location: index.php");
        exit;
    } else {
        $error = "Erreur lors de l'ajout de l'utilisateur.";
    }
}
?>
<form action="add.php" method="post">
    <div>
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Ajouter">
    </div>
    <?php if(isset($error)) { echo $error; } ?>
</form>