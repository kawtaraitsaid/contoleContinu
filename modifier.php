<?php
require_once 'User.php';
$user = new User($mysqli);

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){
    $userData = $user->getUserById($_GET['id']);
} elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($user->editUser($id, $username, $password)){
        header("location: index.php");
        exit;
    } else {
        $error = "Erreur lors de la modification de l'utilisateur.";
    }
}
?>
<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
    <div>
        <label>Nom d'utilisateur</label>
        <input type="text" name="username" value="<?php echo $userData['username']; ?>" required>
    </div>
    <div>
        <label>Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <input type="submit" value="Modifier">
    </div>
    <?php if(isset($error)) { echo $error; } ?>
</form>