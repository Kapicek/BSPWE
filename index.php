<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace domény</title>
    <link rel="stylesheet" href="Styles/index.css">
</head>
<body>
    <?php
    session_start();
    ?>
    <nav>
        <ul>
            <?php if (isset($_SESSION['username'])): ?>
                <li>Přihlášený uživatel: <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                <li><a href="logout.php">Odhlásit se</a></li>
            <?php else: ?>
                <li><a href="Login/userLogin.html">Přihlásit se</a></li>
                <li><a href="UserRegister/userRegister.html">Registrovat</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <h2>Registrace domény</h2>
    <form action="register_domain.php" method="post">
        <label for="domain">Doména:</label>
        <input type="text" id="domain" name="domain" required>
        <input type="submit" value="Registrovat">
    </form>
</body>
</html>
