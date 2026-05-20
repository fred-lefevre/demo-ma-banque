<?php

// Initialisation d'une session pour conserver des inforamtions engtre les différentes pages du site
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Initialise et configure la connexion à la base de données MySQL via PDO.
 * Cette fonction récupère les identifiants de connexion depuis les variables 
 * d'environnement (avec des valeurs de secours par défaut). Elle configure 
 * également l'instance PDO pour lever des exceptions en cas d'erreur SQL 
 * et pour retourner des tableaux associatifs par défaut lors des extractions (fetch).
 * @return PDO Une instance configurée de l'objet PDO prête à l'emploi.
 * @throws Exception Si la connexion à la base de données échoue.
 */
function connexionBdd() {
    $host = getenv('DB_BANQUE_HOST') ?: '127.0.0.1';
    $port = getenv('DB_BANQUE_PORT') ?: '3306';
    $db   = getenv('DB_BANQUE_NAME') ?: 'ma_banque';
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

    $user = getenv('DB_BANQUE_USER') ?: 'usr_ma_banque';
    $pass = getenv('DB_BANQUE_PASS') ?: 'secret_password';

    try {
        $pdo = new PDO($dsn, $user, $pass);
        // Quand une erreur survient, PDO génère une exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Par défaut, un fetch retournera un tableau associatif
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (Exception $e) {
        throw new Exception("Connexion impossible à la base de données : " . $e->getMessage());
    }
}

/**
 * Génère un jeton CSRF (Cross-Site Request Forgery) unique et le stocke en session s'il n'existe pas déjà.
 * @return string Le jeton CSRF.
 */
function genererJetonCSRF() {
    if (empty($_SESSION['jeton_csrf'])) {
        $_SESSION['jeton_csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['jeton_csrf'];
}

/**
 * Vérifie si le jeton fourni correspond à celui stocké en session.
 * @param string $jeton_candidat Le jeton envoyé par le formulaire.
 * @return bool True si le jeton est valide, False sinon.
 */
function verifierJetonCSRF($jeton_candidat) {
    if (empty($_SESSION['jeton_csrf']) || empty($jeton_candidat)) {
        return false;
    }
    return hash_equals($_SESSION['jeton_csrf'], $jeton_candidat);
}

/**
 * Valide le format et les contraintes de longueur d'une adresse email.
 * Cette fonction s'assure que l'email n'est pas vide, qu'il respecte la syntaxe
 * d'une adresse de messagerie et qu'il ne dépasse pas 100 caractères.
 * @param string $email L'adresse email brute à vérifier.
 * @return void
 * @throws Exception Si l'email est vide, syntaxiquement incorrect ou trop long.
 */
function verifierEmail($email) {
    if ($email === '') {
        throw new Exception("L'email du client ne doit pas être vide");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("L'email n'est pas valide : {$email}");
    }
    if (mb_strlen($email) > 100) {
        throw new Exception("L'email du client est trop long");
    }
}

/**
 * Valide le format et la valeur d'un identificateur numérique.
 * Cette fonction s'assure que l'identifiant n'est pas vide, qu'il s'agit bien
 * d'un nombre entier et qu'il est strictement supérieur à zéro.
 * @param string $id L'identificateur brut à vérifier.
 * @return void
 * @throws Exception Si l'identifiant est vide, n'est pas un entier, ou est inférieur ou égal à 0.
 */
function verifierId($id) {
    if ($id === '') {
        throw new Exception("L'identificateur d'un client ne doit pas être vide");
    }
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        throw new Exception("L'identificateur n'est pas valide : {$id}");
    }
    if ($id <= 0) {
        throw new Exception("L'identificateur d'un client doit être strictement supérieur à 0");
    }
}

/**
 * Valide l'existence et la longueur du nom d'un client.
 * Cette fonction s'assure que le nom n'est pas vide et qu'il ne dépasse pas
 * la limite maximale autorisée de 100 caractères.
 * @param string $nom Le nom du client à vérifier.
 * @return void
 * @throws Exception Si le nom est vide ou s'il dépasse 100 caractères.
 */

function verifierNom($nom) {
    if ($nom === '') {
        throw new Exception("Le nom client ne doit pas être vide");
    }
    if (mb_strlen($nom) > 100) {
        throw new Exception("Le nom du client est trop long");
    }
}

/**
 * Récupère les informations d'un client ou lève une exception s'il n'existe pas.
 * Cette fonction interroge la base de données pour extraire le nom et l'email 
 * du client correspondant à l'ID fourni. Si l'identifiant ne correspond à 
 * aucun enregistrement, une exception est immédiatement levée.
 * @param int $id L'identifiant unique du client.
 * @return array Retourne un tableau associatif contenant les clés 'id_client', 'nom' et 'email'.
 * @throws Exception Si aucun client n'est trouvé avec l'identifiant fourni.
 */
function informationClient($id) {
    $pdo = connexionBdd();
    $sql = "SELECT id_client, nom, email FROM client WHERE id_client = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $resultat = $stmt->fetch();
    if ($resultat === false) {
        throw new Exception("Aucun client n'a pour identificateur {$id}");
    }
    return $resultat;
}