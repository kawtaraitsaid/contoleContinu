<?php
require 'User.php';
$user = new User($mysqli);

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){
    if($user->deleteUser($_GET['id'])){
        header("location: index.php");
        exit;
    } else {
        echo "Erreur lors de la suppression de l'utilisateur.";
    }
}
?>