<?php
// Configuration des paramètres de connexion
$host = 'localhost'; // Hôte de la base de données
$dbname = 'gestion_absences'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur MySQL
$password = ''; 

// Connexion à la base de données avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Activation des erreurs PDO pour faciliter le débogage
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}


?>