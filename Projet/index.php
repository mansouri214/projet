<?php
session_start();
include 'baseDonnee.php'; // Connexion à la base de données
require_once 'notifications.php'; // Inclusion du fichier des notifications 

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header("Location: login.php");
    exit();
}

// Récupérer le rôle de l'utilisateur
$user_id = $_SESSION['utilisateur_id'];
$stmt = $pdo->prepare("SELECT role FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$role = $user['role'] ?? 'professeur';

// Récupérer les notifications de l'utilisateur connecté
$stmtNotif = $pdo->prepare("SELECT * FROM notifications WHERE utilisateur_id = ? ORDER BY date_notification DESC LIMIT 5");
$stmtNotif->execute([$user_id]);
$notifications = $stmtNotif->fetchAll();

// Récupération des statistiques pour le tableau de bord
$nbStagiaires = $pdo->query("SELECT COUNT(*) FROM stagiaires")->fetchColumn();
$nbAbsences = $pdo->query("SELECT COUNT(*) FROM absences")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Gestion des absences</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-icon {
            font-size: 2rem;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Gestion des absences</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($role === 'administrateur') : ?>
                    <li class="nav-item"><a class="nav-link" href="?page=ajout_stagiaire">Ajouter un stagiaire</a></li>
                    <li class="nav-item"><a class="nav-link" href="?page=report_absence">Rapports d'absences</a></li>
                <?php else : ?>
                    <li class="nav-item"><a class="nav-link" href="?page=ajout_absence">Ajouter une absence</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="?page=liste_stagiaire">Liste des stagiaires</a></li>
                <li class="nav-item"><a class="nav-link" href="?page=liste_absence">Liste des absences</a></li>
                <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Déconnexion</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Affichage des notifications -->
<div class="container mt-3">
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownNotifications" data-bs-toggle="dropdown" aria-expanded="false">
            Notifications <span class="badge bg-danger"><?= count($notifications) ?></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownNotifications">
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notif): ?>
                    <li>
    <a class="dropdown-item" href="voir_notification.php?id=<?= $notif['id'] ?>">
        <?= htmlspecialchars($notif['message']) ?> - <small><?= $notif['date_notification'] ?></small>
    </a>
</li>

                <?php endforeach; ?>
            <?php else: ?>
                <li><a class="dropdown-item text-muted">Aucune notification</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!-- Dashboard -->
<div class="container mt-4">
    <h2 class="text-center">Bienvenue, <?= ucfirst($role) ?></h2>

    <!-- Dashboard Widgets -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <div class="card-icon text-primary"><i class="bi bi-people"></i></div>
                    <h5 class="card-title"><?= $nbStagiaires ?></h5>
                    <p class="card-text">Total Stagiaires</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <div class="card-icon text-danger"><i class="bi bi-x-circle"></i></div>
                    <h5 class="card-title"><?= $nbAbsences ?></h5>
                    <p class="card-text">Absences Enregistrées</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Inclusion des pages -->
    <div class="mt-4">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $allowed_pages = ['ajout_stagiaire', 'liste_stagiaire', 'ajout_absence', 'liste_absence', 'report_absence', 'modifier_absence'];

            if (in_array($page, $allowed_pages)) {
                include $page . '.php';
            } else {
                echo "<div class='alert alert-danger'>Page non autorisée.</div>";
            }
        } else {
            echo "<div class='alert alert-info text-center'>Utilisez le menu pour naviguer.</div>";
        }
        ?>
    </div>
</div>
<!--notif des pages -->
<script>
function chargerNotifications() {
    fetch('notifications_ajax.php')
        .then(response => response.json())
        .then(data => {
            let menuNotif = document.getElementById("dropdownNotifications");
            let badge = menuNotif.querySelector("span.badge");
            let dropdownMenu = document.querySelector(".dropdown-menu");

            dropdownMenu.innerHTML = ""; // Nettoyer

            if (data.length > 0) {
                badge.textContent = data.length;
                data.forEach(notif => {
                    let li = document.createElement("li");
                    li.innerHTML = `<a class="dropdown-item" href="voir_notification.php?id=${notif.id}">${notif.message} - <small>${notif.date_notification}</small></a>`;
                    dropdownMenu.appendChild(li);
                });
            } else {
                badge.textContent = "0";
                dropdownMenu.innerHTML = "<li><a class='dropdown-item text-muted'>Aucune notification</a></li>";
            }
        });
}

// Rafraîchir toutes les 10 secondes
setInterval(chargerNotifications, 10000);
chargerNotifications();
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</body>
</html>
