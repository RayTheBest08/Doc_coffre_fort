<?php
$password_a_hacher = "1234"; // Remplacez par le mot de passe de votre choix (ex: "password123")
$hachage = password_hash($password_a_hacher, PASSWORD_DEFAULT);
echo $hachage;
?>