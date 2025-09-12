<?php
session_start();

// Vérifier si l'utilisateur n'est pas connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer le nom de l'utilisateur ou l'email pour l'affichage
$user_info = $_SESSION['user_username'];

// Chemin du dossier de téléchargement
$upload_dir = 'uploads';

// Fonction pour lister les fichiers
function listFiles($dir) {
    $files = scandir($dir);
    $fileList = [];
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $fileList[] = $file;
        }
    }
    return $fileList;
}

$files = listFiles($upload_dir);
?>

<body>

    <div class="container">
    <div class="header-container">
        <h1>Bienvenue !!!, Mme/Mr <?php echo htmlspecialchars($user_info); ?></h1>
        <div class="header-buttons">
            <a href="logout.php" class="btn logout-btn">Déconnexion</a>
        </div>
    </div>

    <div class="message-container">
    <?php if (isset($_SESSION['message'])): ?>
        <p class="success">
            <?php echo htmlspecialchars($_SESSION['message']); ?>
        </p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
</div>
    
    <div class="main-container">
        <h2>Télécharger un nouveau fichier que vous pouver ajouter Doc coffre fort</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload" required><br>
            <button type="submit" name="submit">Ajouter</button>
        </form>

        <h2>Vos fichiers</h2>
        <?php if (empty($files)): ?>
            <p>Aucun fichier trouvé. Téléchargez-en un pour commencer !</p>
        <?php else: ?>
            <ul class="file-list">
                <?php foreach ($files as $file): ?>
                    <li>
                        <span class="file-name"><?php echo htmlspecialchars($file); ?></span>
                        <div class="file-actions">
                            <a href="<?php echo htmlspecialchars($upload_dir . $file); ?>" download class="btn download-btn">Télécharger</a>
                            <a href="delete.php?file=<?php echo urlencode($file); ?>" class="btn delete-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?')">Supprimer</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    </div>

</div>
</body>


<style>

    body{
        background: url(https://unsplash.com/fr/photos/panneau-de-commande-noir-et-gris-YriuRFYUP0I) no-repeat center center fixed;
    }
    .container {
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
}
.header-container {
    display:flex;
    gap:40px;
    justify-content:space-around;
    padding: 20px 40px;
    margin-bottom: 20px;
    border-radius: 8px;
}


.header-container h1 {
    margin: 0;
    font-size: 1.8rem;
}

.main-container {
    max-width: 900px;
    margin: 0 auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.main-container h2 {
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
    margin-top: 0;
    text-align:center;
}

form {
    margin-bottom: 30px;
    align-items: center;
}


input{
    margin-bottom:20px;
    font-size:1.2rem;
    padding: 10px;
    padding-bottom:10px;
    width: 100%;
    border: 1px dashed #da8e1dff;
    border-radius: 5px;
    box-sizing: border-box;
    padding-left: 300px;
    cursor: pointer;
    
    transition: border-color 0.3s ease;

}


button.btn, .btn {

    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

button[type="submit"] {
    background-color: #0d6efd;
    color: white;
    text-align: center;
    width: 100%;
    padding: 15px;
    font-size: 1.2rem;
    border: none;
    border-radius: 5px;
}

button[type="submit"]:hover {
    background-color: #0b5ed7;
}

.btn.logout-btn {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
}

.btn.logout-btn:hover {
    background-color: #c82333;
}

.file-list {
    list-style: none;
    padding: 0;
}

.file-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #f8f9fa;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #e9ecef;
}

.file-name {
    font-weight: 500;
}

.file-actions {
    display: flex;
    gap: 10px;
}

.btn.download-btn {
    background-color: #28a745;
    color: white;
    text-decoration: none;
}

.btn.download-btn:hover {
    background-color: #218838;
}

.btn.delete-btn {
    background-color: #6c757d;
    color: white;
    text-decoration: none;
}

.btn.delete-btn:hover {
    background-color: #5a6268;
}

.message-container {
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