<?php
require_once 'config.php';

class User {
    private $db;

    public function __construct($mysqli) {
        $this->db = $mysqli;
    }

    public function login($username, $password) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 0) {
                $stmt->bind_result($id, $username, $hashed_password);
                $stmt->fetch();
                if(password_verify($password, $hashed_password)) {
                    session_start();
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    return true;
                }
            }
        }
        return false;
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    }

    public function addUser($username, $password) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if($stmt = $this->db->prepare($sql)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ss", $username, $hashed_password);
            return $stmt->execute();
        }
        return false;
    }

    public function editUser($id, $username, $password) {
        $sql = "UPDATE users SET username = ?, password = ? WHERE id = ?";
        if($stmt = $this->db->prepare($sql)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssi", $username, $hashed_password, $id);
            return $stmt->execute();
        }
        return false;
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }
        return false;
    }

    public function getUserById($id) {
        $sql = "SELECT id, username FROM users WHERE id = ?";
        if($stmt = $this->db->prepare($sql)){
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }
        return null;
    }
}
?>