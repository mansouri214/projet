<?php
include 'baseDonnee.php'; // Connexion à la base de données
require_once 'notifications.php';//iclusion du fichier notification
$message = "";

// Form Handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stagiaire_id = $_POST['stagiaire_id'];
    $date_absence = $_POST['date_absence'];
    $cours = htmlspecialchars($_POST['cours']);
    $raison = htmlspecialchars($_POST['raison']);
    $justifie = isset($_POST['justifie']) ? 1 : 0; // Absence justifiée ou non

    try {
        // Insertion dans la base de données
        $stmt = $pdo->prepare("INSERT INTO absences (stagiaire_id, date_absence, cours, raison, justifie) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$stagiaire_id, $date_absence, $cours, $raison, $justifie]);
        $message = "<div class='alert alert-success'>Absence ajoutée avec succès !</div>";



    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
    }
    verifierAbsencesEtNotifier($stagiaire_id, $pdo);

    
    header("Location: index.php?page=ajout_absence");
    exit();
}





// Récupération des stagiaires
$stagiaires = $pdo->query("SELECT id, nom, prenom FROM stagiaires")->fetchAll();
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Absence</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h3 class="mb-0">Ajouter une Absence</h3>
        </div>
        <div class="card-body">
            <?= $message; ?> <!-- Affichage du message de succès ou d'erreur -->

            <form method="POST" action="ajout_absence.php">
                <div class="mb-3">
                    <label class="form-label">Stagiaire :</label>
                    <select name="stagiaire_id" class="form-select" required>
                        <option value="">-- Sélectionnez un stagiaire --</option>
                        <?php foreach ($stagiaires as $stagiaire): ?>
                            <option value="<?= $stagiaire['id'] ?>">
                                <?= htmlspecialchars($stagiaire['nom'] . ' ' . $stagiaire['prenom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date de l'absence :</label>
                    <input type="date" name="date_absence" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cours :</label>
                    <input type="text" name="cours" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Raison :</label>
                    <textarea name="raison" class="form-control" rows="3"></textarea>
                </div>

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="justifie" id="justifie">
                    <label class="form-check-label" for="justifie">Absence Justifiée</label>
                </div>

                <button type="submit" class="btn btn-danger"><i class="bi bi-plus-lg"></i> Ajouter l'absence</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
