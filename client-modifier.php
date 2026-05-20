<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Modification d'un client";
$msg_resultat = null;

try {
    $id_client = trim($_POST['id_client'] ?? '');
    verifierId($id_client);
    $nom = trim($_POST['nom'] ?? '');
    verifierNom($nom);
    $email = trim($_POST['email'] ?? '');
    verifierEmail($email);

    // Mise à jour effective du client
    $pdo = connexionBdd();
    $sql = "UPDATE client SET nom = :nom, email = :email WHERE id_client = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id_client, PDO::PARAM_INT);
    $stmt->execute();

    // Deconnexion de la base de données
    $pdo = $stmt = null;

    $msg_resultat = "Réussite de la modification du client : {$nom}";
} catch (Exception $e) {
    $msg_resultat = "Echec de la modification du client : " . $e->getMessage();
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