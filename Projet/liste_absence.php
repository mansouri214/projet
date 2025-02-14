<?php
include 'baseDonnee.php'; // Connexion à la base de données

$message = "";

// Récupération des absences avec informations stagiaires
try {
    $stmt = $pdo->query("
        SELECT absences.*, stagiaires.nom, stagiaires.prenom 
        FROM absences 
        JOIN stagiaires ON absences.stagiaire_id = stagiaires.id 
        ORDER BY date_absence DESC
    ");
    $absences = $stmt->fetchAll();
} catch (PDOException $e) {
    $message = "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
}

// Suppression d'une absence
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM absences WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: liste_absence.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Absences</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="bi bi-list-check"></i> Liste des Absences</h3>
        </div>
        <div class="card-body">
            <?= $message; ?> <!-- Affichage du message d'erreur si besoin -->

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Stagiaire</th>
                            <th>Date</th>
                            <th>Cours</th>
                            <th>Raison</th>
                            <th>Justifiée</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($absences as $absence): ?>
                        <tr>
                            <td><?= $absence['id'] ?></td>
                            <td><?= htmlspecialchars($absence['nom'] . ' ' . $absence['prenom']) ?></td>
                            <td><?= htmlspecialchars($absence['date_absence']) ?></td>
                            <td><?= htmlspecialchars($absence['cours']) ?></td>
                            <td><?= htmlspecialchars($absence['raison']) ?></td>
                            <td>
                                <?php if ($absence['justifie']): ?>
                                    <span class="badge bg-success">Oui</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Non</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="modifier_absence.php?id=<?= $absence['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>
                            </td>
                            


                            <td>
                                <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?');">
                                    <input type="hidden" name="delete_id" value="<?= $absence['id'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
