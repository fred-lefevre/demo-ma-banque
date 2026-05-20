<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Création d'un client";
$msg_resultat = null;

try {
    // Vérification du jeton CSRF
    $jeton_recu = $_POST['jeton_csrf'] ?? '';
    if (!verifierJetonCSRF($jeton_recu)) {
        throw new Exception("Problème de sécurité car l'origine de la requête n'est pas vérifiée (CSRF).");
    }

    // Validation des entrées
    $nom = trim($_POST['nom'] ?? '');
    verifierNom($nom);
    $email = trim($_POST['email'] ?? '');
    verifierEmail($email);

    // Création effective du client
    $pdo = connexionBdd();
    $sql = "INSERT INTO client (nom, email)  VALUES (:nom, :email)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    // Deconnexion de la base de données
    $pdo = $stmt = null;

    $msg_resultat = "Réussite de la création du client : {$nom}";
} catch (Exception $e) {
    $msg_resultat = "Echec de la création du client : " . $e->getMessage();
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