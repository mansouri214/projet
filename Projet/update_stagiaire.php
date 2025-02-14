<?php
include 'baseDonnee.php'; //  la connexion à la base de données

// Mise à jour d'un stagiaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $programme = htmlspecialchars($_POST['programme']);
    $email = htmlspecialchars($_POST['email']);

    try {
        $stmt = $pdo->prepare("UPDATE stagiaires SET nom = ?, prenom = ?, programme = ?, email = ? WHERE id = ?");
        $stmt->execute([$nom, $prenom, $programme, $email, $id]);
        echo "Stagiaire mis à jour avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// Suppression d'un stagiaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM stagiaires WHERE id = ?");
        $stmt->execute([$id]);
        echo "Stagiaire supprimé avec succès !";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
