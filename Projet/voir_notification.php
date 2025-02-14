<?php
session_start();
include 'baseDonnee.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si un ID de notification est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID de notification manquant.");
}

$notif_id = intval($_GET['id']); // Sécurisation de l'ID

// Récupérer la notification
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE id = ?");
$stmt->execute([$notif_id]);
$notification = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si la notification existe
if (!$notification) {
    die("Notification introuvable.");
}

// Marquer la notification comme lue
$stmt = $pdo->prepare("UPDATE notifications SET lu = 1 WHERE id = ?");
$stmt->execute([$notif_id]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Détails de la Notification</h3>
        </div>
        <div class="card-body">
            <p><strong>Message :</strong> <?= htmlspecialchars($notification['message']) ?></p>
            <p><strong>Date :</strong> <?= htmlspecialchars($notification['date_notification']) ?></p>
            <a href="index.php" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
</body>
</html>
