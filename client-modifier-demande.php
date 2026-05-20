<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Demande de modification d'un client";

try {
    $id_client = trim($_POST['id_client'] ?? '');
    verifierId($id_client);
    $info = informationClient($id_client);
} catch (Exception $e) {
    die("Echec de la récupération des informations du client d'id {$id_client} : " . $e->getMessage());
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
    <form action="./client-modifier.php" method="post">
        <input type="hidden" name="id_client" value="<?= $info['id_client'] ?>">
        Client d'identificateur <?= $info['id_client'] ?><br>
        <label for="nom">Nom :</label> <input type="text" id="nom" name="nom" maxlength="100" value="<?= htmlspecialchars($info['nom']) ?>" required><br>
        <label for="email">Email :</label> <input type="email" id="email" name="email" maxlength="100" value="<?= htmlspecialchars($info['email']) ?>" required>
        <button type="submit">Modifier</button>
        <button type="button" onclick="history.back();">Annuler</button>
    </form>
    <hr>
</body>

</html>