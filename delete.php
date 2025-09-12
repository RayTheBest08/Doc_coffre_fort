<?php
session_start();

// 1. Sécurité : Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Vérifier si le nom de fichier a été passé en paramètre
if (isset($_GET['file']) && !empty($_GET['file'])) {
    
    // 3. Valider le nom de fichier pour des raisons de sécurité
    $file_to_delete = basename(urldecode($_GET['file']));
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . $file_to_delete;
    
    // 4. Vérifier que le fichier existe et qu'il est bien dans le dossier "uploads"
    if (file_exists($file_path) && is_file($file_path)) {
        // 5. Supprimer le fichier
        if (unlink($file_path)) {
            $_SESSION['message'] = "Le fichier '" . htmlspecialchars($file_to_delete) . "' a été supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Une erreur est survenue lors de la suppression du fichier.";
        }
    } else {
        $_SESSION['error'] = "Le fichier n'existe pas.";
    }
} else {
    $_SESSION['error'] = "Nom de fichier non spécifié.";
}

// 6. Rediriger l'utilisateur vers la page principale
header("Location: index.php");
exit();