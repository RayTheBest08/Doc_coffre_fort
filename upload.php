<?php
// Démarrer la session pour vérifier que l'utilisateur est connecté.
session_start();

// 1. Sécurité : Vérifier si l'utilisateur est bien connecté.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 2. Définir les paramètres de téléchargement
$upload_dir = 'uploads/'; // Le dossier où les fichiers seront stockés
$max_size = 5000000; // Taille maximale du fichier : 5 Mo
$allowed_types = ['jpg', 'png', 'jpeg', 'gif', 'pdf', 'docx']; // Types de fichiers autorisés

$error_message = '';
$success_message = '';

// 3. Vérifier si un fichier a été soumis via le formulaire.
if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    
    // Récupérer les informations du fichier
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // 4. Validation du fichier pour la sécurité
    // Vérifier la taille du fichier.
    if ($file_size > $max_size) {
        $error_message = "Erreur : Le fichier est trop grand (max 5 Mo).";
    }
    
    // Vérifier le type de fichier.
    if (!in_array($file_extension, $allowed_types)) {
        $error_message = "Erreur : Type de fichier non autorisé. Types acceptés : " . implode(', ', $allowed_types);
    }

    // 5. Si aucune erreur n'a été trouvée, procéder au déplacement du fichier.
    if (empty($error_message)) {
        // Créer un nom de fichier unique pour éviter les conflits et écraser des fichiers existants.
        $new_file_name = uniqid('file_', true) . '.' . $file_extension;
        $destination = $upload_dir . $new_file_name;

        // Déplacer le fichier du répertoire temporaire vers le dossier de destination.
        if (move_uploaded_file($file_tmp_name, $destination)) {
            $success_message = "Le fichier " . htmlspecialchars($file_name) . " a été téléchargé avec succès.";
        } else {
            $error_message = "Une erreur est survenue lors du téléchargement.";
        }
    }

} else {
    // Si une erreur PHP s'est produite lors du téléchargement (ex: fichier trop grand côté serveur).
    if (isset($_FILES['fileToUpload']['error'])) {
        $php_error_code = $_FILES['fileToUpload']['error'];
        $error_message = "Erreur de téléchargement : Code " . $php_error_code;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut du téléchargement</title>
    <meta http-equiv="refresh" content="3;url=index.php">
</head>
<body>
    <div class="message-container">
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

</body>
</html>

<style>.message-container {
    text-align: center;
    margin-top: 50px;
}

.message-container p {
    padding: 15px;
    border-radius: 5px;
    font-weight: bold;
}

.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

    </style>