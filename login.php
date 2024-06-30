<?php
require 'User.php';
$user = new User($mysqli);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($user->login($username, $password)){
        header("location: index.php");
        exit;
    } else {
        $error = "Nom d'utilisateur ou mot de passe invalide.";
    }
}
?>
<form action="login.php" method="post">
    <div>
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
    <?php if(isset($error)) { echo $error; } ?>
</form>