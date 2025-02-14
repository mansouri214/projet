<?php
session_start();
include 'baseDonnee.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    echo json_encode([]);
    exit();
}

$user_id = $_SESSION['utilisateur_id'];
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE utilisateur_id = ? ORDER BY date_notification DESC LIMIT 5");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notifications);
$stmt = $pdo->prepare("SELECT * FROM notifications WHERE utilisateur_id = ? AND lu = 0 ORDER BY date_notification DESC LIMIT 5");

?>
