<?php
include 'baseDonnee.php'; // Connexion à la base de données

$message = "";

// Vérifier si un ID est passé en paramètre
if (!isset($_GET['id'])) {
    die("ID d'absence non spécifié.");
}

$id = $_GET['id'];

// Récupérer les données actuelles de l'absence
$stmt = $pdo->prepare("SELECT * FROM absences WHERE id = ?");
$stmt->execute([$id]);
$absence = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$absence) {
    die("Absence introuvable.");
}

// Mettre à jour les données en cas de soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_absence = $_POST['date_absence'];
    $cours = $_POST['cours'];
    $raison = $_POST['raison'];
    $justifie = isset($_POST['justifie']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE absences SET date_absence = ?, cours = ?, raison = ?, justifie = ? WHERE id = ?");
    $stmt->execute([$date_absence, $cours, $raison, $justifie, $id]);

    $message = "<div class='alert alert-success'>Absence mise à jour avec succès.</div>";
    // Redirection après mise à jour
    header("Location: index.php?page=liste_absence");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Absence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h3 class="mb-0">Modifier l'Absence</h3>
        </div>
        <div class="card-body">
            <?= $message; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Date d'absence :</label>
                    <input type="date" name="date_absence" class="form-control" value="<?= htmlspecialchars($absence['date_absence']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cours :</label>
                    <input type="text" name="cours" class="form-control" value="<?= htmlspecialchars($absence['cours']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Raison :</label>
                    <textarea name="raison" class="form-control" required><?= htmlspecialchars($absence['raison']) ?></textarea>
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="justifie" <?= $absence['justifie'] ? 'checked' : '' ?>> Justifiée
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="index.php?page=liste_absence" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
