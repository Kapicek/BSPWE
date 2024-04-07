<?php
require_once '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkUser = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $checkUser->store_result();
    
    if ($checkUser->num_rows() == 0 ) {
        $insert = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $insert->bind_param("ss", $username, $password);
        
        if ($insert->execute()) {
            echo '<script>alert("Uživatel byl úspěšně zaregistrován.")</script>';
            echo '<script>window.location="../index.php"</script>';
        } else {
            echo '<script>alert("Nepodařilo se zaregistrovat uživatele.")</script>';
            echo '<script>window.location="userRegister.html"</script>';
        }
    } else {
        echo '<script>alert("Uživatelské jméno již existuje.")</script>';
        echo '<script>window.location="userRegister.html"</script>';
    }
    $checkUser->close();
    $insert->close();
    $conn->close();
} else {
    echo '<script>alert("Chybný požadavek.")</script>';
    echo '<script>window.location="userRegister.html"</script>';
}
?>
