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
            echo '<script>alert("Nesprávné heslo.")</script>';
            echo '<script>window.location="../userLogin"</script>';
        }
    } else {
        echo '<script>alert("Uživatelské jméno neexistuje.")</script>';
        echo '<script>window.location="../userLogin"</script>';  
    }
    $query->close();
    $conn->close();
} else {
    echo '<script>alert("Chybný požadavek.")</script>';
    echo '<script>window.location="userRegister.html"</script>';
}
?>
