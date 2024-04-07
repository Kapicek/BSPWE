<?php
require_once 'db.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
} else {
    die("Uživatel není přihlášen.");
}

$domain = filter_input(INPUT_POST, 'domain');
$path = "C:\Users\Admin\Documents\Domens\\" . $domain;

if (!empty($domain)) {
    if (preg_match("/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $domain)) {
        $query = $conn->prepare("SELECT * FROM users_domains WHERE domain = ?");
        $query->bind_param("s", $domain);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows == 0) {
            $insertQuery = $conn->prepare("INSERT INTO users_domains (id_user, domain, path) VALUES (?, ?, ?)");
            $insertQuery->bind_param("iss", $id_user, $domain, $path);
            if ($insertQuery->execute()) {
                echo '<script>alert("Doména byla úspěšně zaregistrovaná s cestou: '.$path.'")</script>';
                echo '<script>window.location="index.php"</script>';
                if (!file_exists($path)) {
                    if (mkdir($path, 0777, true)) { // Povolení čtení, zápisu a spuštění pro všechny uživatele
                        echo '<script>alert(" Složka byla úspěšně vytvořena.")</script>';
                        echo '<script>window.location="index.php"</script>';
                    } else {
                        echo '<script>alert(" Nelze vytvořit složku.")</script>';
                        echo '<script>window.location="index.php"</script>';
                    }
                } else {
                    echo '<script>alert(" Složka již existuje.")</script>';
                    echo '<script>window.location="index.php"</script>';
                }
            } else {
                echo '<script>alert("Chyba při registraci domény.")</script>';
                echo '<script>window.location="index.php"</script>';
            }
        } else {
            echo '<script>alert("Doména je již zaregistrovaná.")</script>';
            echo '<script>window.location="index.php"</script>';
        }
    } else {
        echo '<script>alert("Neplatný formát domény.")</script>';
        echo '<script>window.location="index.php"</script>';
    }
} else {
    echo '<script>alert("Prosím, zadejte doménu.")</script>';
    echo '<script>window.location="index.php"</script>';
}

$conn->close();
?>
