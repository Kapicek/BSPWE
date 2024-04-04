<?php
require_once '../db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: ../index.php");
        } else {
            echo "Nesprávné heslo.";
        }
    } else {
        echo "Uživatelské jméno neexistuje.";
    }
    $query->close();
    $conn->close();
} else {
    echo "Chybný požadavek.";
}
?>
