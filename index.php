<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Démo ma_banque";

try {
    // Récupération de la liste triée des clients
    $pdo = connexionBdd();
    $stmt = $pdo->query("SELECT COUNT(*) AS nb FROM client");
    $resultat = $stmt->fetch();
    $nb_clients = $resultat['nb'];

    $msg_client = match ($nb_clients) {
        0       => "Aucun client",
        1       => "1 client",
        default => "{$nb_clients} clients"
    };

    // Deconnexion de la base de données
    $pdo = $stmt = null;
} catch (Exception $e) {
    die("Echec de la récupération du nombre de clients : " . $e->getMessage());
}
?>
<!DOCTYPE HTML>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= $titre ?></title>
</head>

<body>
    <h1><?= $titre ?></h1>
    <ul>
        <li><a href="./clients.php"><?= $msg_client ?></a></li>
    </ul>
</body>

</html>