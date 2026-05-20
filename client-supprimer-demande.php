<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Demande de suppression d'un client";

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
    <p>Confirmez-vous la demande de suppression du client <?= htmlspecialchars($info['nom']) ?> d'identificateur <?= $info['id_client'] ?> ?</p>
    <form action="./client-supprimer.php" method="post">
        <input type="hidden" name="id_client" value="<?= $info['id_client'] ?>">
        <button type="submit">Oui</button>
        <button type="button" onclick="history.back();">Annuler</button>
    </form>
    <hr>
</body>

</html>