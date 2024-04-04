<?php
require_once 'db.php';

session_start();
if (isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id'];
} else {
    die("Uživatel není přihlášen.");
}

$domain = filter_input(INPUT_POST, 'domain');
$relativePath = "ZatimRandomJsemLinejLol/" . $domain;
$path = __DIR__ . '/' . $relativePath;

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
                echo "Doména byla úspěšně zaregistrovaná s cestou: $path";
                
                if (!file_exists($path)) {
                    if (mkdir($path, 0777, true)) { // Povolení čtení, zápisu a spuštění pro všechny uživatele
                        echo " Složka byla úspěšně vytvořena.";
                    } else {
                        echo " Nelze vytvořit složku.";
                    }
                } else {
                    echo " Složka již existuje.";
                }
            } else {
                echo "Chyba při registraci domény.";
            }
        } else {
            echo "Doména je již zaregistrovaná.";
        }
    } else {
        echo "Neplatný formát domény.";
    }
} else {
    echo "Prosím, zadejte doménu.";
}

$conn->close();
?>
