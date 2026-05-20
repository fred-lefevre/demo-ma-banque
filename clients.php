<?php
require_once __DIR__ .'/inc/outils.php';

$titre = "Clients";

// Méthode de tri de la liste des clients
$attribut_tri = $_GET["tri"] ?? 'nom';
if (! in_array($attribut_tri, ['id_client', 'nom', 'email'])) {
    $attribut_tri = 'nom';
}
$nom_attribut_tri = [
    'id_client' => 'Identificateur',
    'nom'       => 'Nom',
    'email'     => 'Adresse mail'
];

try {
    // Récupération de la liste triée des clients
    $pdo = connexionBdd();
    $sql = "SELECT id_client, nom, email FROM client ORDER BY {$attribut_tri} ASC";
    $stmt = $pdo->query($sql);
    $les_clients = $stmt->fetchAll();
    $nb_clients = count($les_clients);

    // Deconnexion de la base de données
    $pdo = $stmt = null;
} catch (Exception $e) {
    die("Echec de la récupération des informations des clients : " . $e->getMessage());
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
    <form action="./client-creer.php" method="post">
        <input type="hidden" name="jeton_csrf" value="<?= genererJetonCSRF(); ?>">
        Nouveau client
        <label for="nom">Nom :</label> <input type="text" id="nom" name="nom" maxlength="100" required>
        <label for="email">Email :</label> <input type="email" id="email" name="email" maxlength="100" required>
        <button type="submit">Créer</button>
    </form>
    <hr>
    <?php if ($nb_clients == 0): ?>
        <p>Aucun client</p>
    <?php else: ?>
        <p><?= $nb_clients ?> clients triés par <?= $nom_attribut_tri[$attribut_tri] ?></p>
        <table>
            <thead>
                <tr>
                    <th><?= $nom_attribut_tri['id_client'] ?></th>
                    <th><?= $nom_attribut_tri['nom'] ?></th>
                    <th><?= $nom_attribut_tri['email'] ?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($les_clients as $un_client) : ?>
                    <tr>
                        <td><?= $un_client['id_client'] ?></td>
                        <td><?= htmlspecialchars($un_client['nom'])  ?></td>
                        <td><?= htmlspecialchars($un_client['email'])  ?></td>
                        <td>
                            <form action="./client-modifier-demande.php" method="post">
                                <input type="hidden" name="id_client" value="<?= $un_client['id_client'] ?>">
                                <button type="submit">Modifier</button>
                            </form>
                        </td>
                        <td>
                            <form action="./client-supprimer-demande.php" method="post">
                                <input type="hidden" name="id_client" value="<?= $un_client['id_client'] ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;  ?>
            </tbody>
        </table>
    <?php endif; ?>
    <hr>
    <form action="./clients.php" method="get">
        <label for="tri">Clients triés par :</label>
        <select name="tri" id="tri">
            <option value="id_client" <?php if ($attribut_tri == 'id_client') echo ' selected'; ?>>
                <?= $nom_attribut_tri['id_client'] ?>
            </option>
            <option value="nom" <?php if ($attribut_tri == 'nom') echo ' selected'; ?>>
                <?= $nom_attribut_tri['nom'] ?>
            </option>
            <option value="email" <?php if ($attribut_tri == 'email') echo ' selected'; ?>>
                <?= $nom_attribut_tri['email'] ?>
            </option>
        </select>
        <button type="submit">Trier</button>
    </form>
    <hr>
    <ul>
        <li><a href="./index.php">Accueil</a></li>
    </ul>
</body>

</html>