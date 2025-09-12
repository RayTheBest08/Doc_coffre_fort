<?php
// Démarrer la session pour gérer la connexion de l'utilisateur
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $servername = "localhost";
    $username_db = "root"; 
    $password_db = ""; 
    $dbname = "coffre_fort"; 

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = ''; 


    $stmt = $conn->prepare("SELECT id, email, username, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    

    // 4. Vérifier l'utilisateur et le mot de passe
    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
         $_SESSION['user_username'] = $user['username'];

        // Rediriger l'utilisateur vers la page principale
        header("Location: index.php");
        exit();
    } else {
        // Authentification échouée
        $error = "Email ou mot de passe incorrect.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | File Manager Pro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
    
    <div class="login-container">
        <h2>Connexion</h2>
        <form action="login.php" method="post">

        <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
                <i class="fas fa-envelope"></i>

            </div>

            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <i class="fas fa-lock"></i>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>