# Démonstration "Ma banque"
- Mini-site web de gestion d'une base de données MySQL avec le langage PHP.
- Ce site n'est pas finalisé : c'est un contexte destiné à des exercices d'ajout de fonctionnalités, de refactorisation de code, d'amélioration de sa sécurité, …
- Site destiné à être déployé dans un environnement AMP.

## Mise en oeuvre
- Afin d'utiliser localement ce site, il est nécessaire de restaurer la base de données, de configurer l'environnement d'exécution, puis de copier le code du dépôt dans un dossier servi par Apache.

## Restauration de la base de données
- Le fichier `sql/ma_banque.DUMP.5.sql` doit être executé dans la base données gérée par le site web.
- Une méthode de restauration dans une base de données nommée `ma_banque` est par exemple :
```
DROP DATABASE IF EXISTS ma_banque;

CREATE DATABASE ma_banque
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

use ma_banque

-- En supposant que le dépôt a été cloné dans le dossier C:\demo, restauration avec :
SOURCE C:\demo\ma_banque.DUMP.5.sql
```

## Configuration de l'environnement
Les variables d'environnement suivantes permettent de personnaliser le contexte de fonctionnement du site.

| Variable | Signification | Valeur par défaut |
| :---:            | :---           | :---: |
| `DB_BANQUE_HOST` | nom de l'hôte qui héberge le serveur de base de données | 127.0.0.1 |
| `DB_BANQUE_PORT` | port à utiliser pour se connecter au serveur de base de données | 3306 |
| `DB_BANQUE_NAME` | nom de la base de données | ma_banque |
| `DB_BANQUE_USER` | compte utilisateur permettant de se connecter à la base de donneés | usr_ma_banque |
| `DB_BANQUE_PASS` | mot de passe du compte | secret_password |

## Copie du code
- Copier tout le code du dépôt (à l'exception du sous-dossier `sql/`) dans un sous-dossier (nommé par exemple `banque`) du dossier servi par votre serveur Apache. Par exemple, copier le code vers `C:\wamp64\www\banque` avec WAMP ou vers `/var/www/html/banque/` sous Linux/Debian.

## Accès au site
- Si le code a été copié dans le sous-dossier `banque`, l'URL de la page d'accueil est http://localhost/banque/
