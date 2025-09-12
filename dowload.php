<!--  cette section en cour de developpement -->  
<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['file']) && !empty($_GET['file'])) {
    $file = basename($_GET['file']);
    $upload_dir = 'uploads/';
    $file_path = $upload_dir . $file;

    if (file_exists($file_path)) {
        // Définir les headers pour forcer le téléchargement
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file . '"'); // Use the original filename
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        ob_clean();
        flush();
        readfile($file_path);
        exit;
    } else {
        // Fichier non trouvé
        $_SESSION['error'] = "Fichier non trouvé.";
        header("Location: index.php");
        exit();
    }
} else {
    // Paramètre 'file' manquant
    $_SESSION['error'] = "Paramètre de fichier manquant.";
    header("Location: index.php");
    exit();
}
?>
