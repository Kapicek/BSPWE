<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace domény</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container w-50">
        <?php
        session_start();
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-fluid justify-content-center">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item"><span class="nav-link">Přihlášený uživatel: <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Odhlásit se</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="Login/userLogin.html">Přihlásit se</a></li>
                        <li class="nav-item"><a class="nav-link" href="UserRegister/userRegister.html">Registrovat</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <h2 class="text-center mb-4">Registrace domény</h2>
        <form action="register_domain.php" method="post" class="d-flex flex-column">
            <div class="mb-3">
                <label for="domain" class="form-label">Doména:</label>
                <input type="text" id="domain" name="domain" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrovat</button>
        </form>
    </div>
</body>
</html>
