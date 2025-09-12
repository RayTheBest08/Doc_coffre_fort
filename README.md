# Doc coffre fort

Description du Projet Doc coffre fort est un gestionnaire de fichiers en ligne simple et sécurisé, développé en PHP. Il permet aux utilisateurs de téléverser, de visualiser et de supprimer des documents et des fichiers depuis une interface web. Idéal pour un usage personnel ou comme outil interne pour une petite équipe.

# Fonctionnalités

Authentification sécurisée : Connexion via un email et un mot de passe haché.

Téléchargement de fichiers : Interface intuitive pour ajouter de nouveaux documents.

# Sécurité 

Validation des types de fichiers autorisés.

Génération de noms de fichiers uniques pour éviter les conflits et les risques d'écrasement.

Liste des fichiers : Affichage clair et organisé de tous les fichiers téléversés.

Suppression de fichiers : Fonctionnalité sécurisée pour supprimer des documents.

# Installation

Pour installer et faire fonctionner ce projet en local, suivez ces étapes :

Prérequis : Assurez-vous d'avoir un environnement de développement PHP avec une base de données MySQL (comme WAMP, XAMPP, ou MAMP).

# Configuration du projet 

Clonez ce dépôt ou téléchargez les fichiers et placez-les dans le dossier racine de votre serveur web (par exemple, htdocs pour XAMPP).

Créez une base de données MySQL.

# Configuration de la base de données 

Ouvrez phpMyAdmin et créez une table nommée users.

Ajoutez les colonnes suivantes :

id : INT, PRIMARY KEY, AUTO_INCREMENT

email : VARCHAR(255),

username : VARCHAR(255),

password : VARCHAR(255)

Pour créer un premier utilisateur, utilisez un script PHP pour générer un mot de passe haché (comme nous l'avons fait ensemble) et insérez-le manuellement dans la table.

Mise à jour des informations de connexion : Ouvrez le fichier login.php. Modifiez les variables de connexion à la base de données avec vos propres informations (nom d'utilisateur, mot de passe, nom de la base de données).

Utilisation Accédez à l'application via votre navigateur : http://localhost/nom_du_projet/login.php Connectez-vous avec l'utilisateur que vous avez créé. Vous serez redirigé vers la page d'accueil (index.php) où vous pourrez télécharger et gérer vos fichiers.
