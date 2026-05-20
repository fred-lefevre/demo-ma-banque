<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Suppression d'un client";
$msg_resultat = null;

try {
    $id_client = trim($_POST['id_client'] ?? '');
    verifierId($id_client);

    // Suppression effective du client
    $pdo = connexionBdd();
    $sql = "DELETE FROM client WHERE id_client = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id_client, PDO::PARAM_INT);
    $stmt->execute();

    // Nombre de ligne supprimée
    $nb_sup = $stmt->rowCount();

    // Deconnexion de la base de données
    $pdo = $stmt = null;

    if ($nb_sup == 1) {
        $msg_resultat = "Réussite de la suppression du client d'identificateur {$id_client}";
    } else {
        $msg_resultat = "Le client d'identificateur {$id_client} n'existait plus au moment de la demande de suppression";
    }
} catch (Exception $e) {
    $msg_resultat = "Echec de la suppression du client : " . $e->getMessage();
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
    <hr>
    <p><?= $msg_resultat ?></p>
    <hr>
    <ul>
        <li><a href="./clients.php">Clients</a></li>
    </ul>
</body>

</html>