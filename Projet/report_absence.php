<?php
include 'baseDonnee.php'; // Connexion à la base de données

$filter_date = $_GET['date'] ?? null;
$filter_stagiaire_name = $_GET['stagiaire_name'] ?? null;

try {
    $query = "
        SELECT absences.*, stagiaires.nom, stagiaires.prenom 
        FROM absences 
        JOIN stagiaires ON absences.stagiaire_id = stagiaires.id 
        WHERE 1=1
    ";
    $params = [];

    // Filtrage par date
    if ($filter_date) {
        $query .= " AND DATE(absences.date_absence) = ?";
        $params[] = $filter_date;
    }

    // Filtrage par stagiaire (nom ou prénom)
    if ($filter_stagiaire_name) {
        $query .= " AND (stagiaires.nom LIKE ? OR stagiaires.prenom LIKE ?)";
        $params[] = "%$filter_stagiaire_name%";
        $params[] = "%$filter_stagiaire_name%";
    }

    // Trier les absences par date
    $query .= " ORDER BY absences.date_absence DESC";

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $absences = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<div class="container mt-4">
    <h1 class="mb-4">Liste des Absences</h1>

    <!-- Filtres -->
    <form id="filter-form" method="GET" action="index.php">
        <input type="hidden" name="page" value="report_absence"> <!-- Ensures the same page -->

        <div class="row g-3">
            <div class="col-md-4">
                <label for="date" class="form-label">Date :</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($filter_date) ?>">
            </div>
            <div class="col-md-4">
                <label for="stagiaire_name" class="form-label">Stagiaire :</label>
                <input type="text" name="stagiaire_name" class="form-control" value="<?= htmlspecialchars($filter_stagiaire_name) ?>" placeholder="Nom ou prénom du stagiaire">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <button type="reset" class="btn btn-secondary ms-2" onclick="resetFilters()">Réinitialiser</button>
            </div>
        </div>
    </form>

    <!-- Tableau des absences -->
    <div id="absence-results">
        <table class="table table-bordered table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Stagiaire</th>
                    <th>Date</th>
                    <th>Cours</th>
                    <th>Raison</th>
                    <th>Justifiée</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($absences): ?>
                    <?php foreach ($absences as $absence): ?>
                        <tr>
                            <td><?= $absence['id'] ?></td>
                            <td><?= htmlspecialchars($absence['nom'] . ' ' . $absence['prenom']) ?></td>
                            <td><?= htmlspecialchars($absence['date_absence']) ?></td>
                            <td><?= htmlspecialchars($absence['cours']) ?></td>
                            <td><?= htmlspecialchars($absence['raison']) ?></td>
                            <td>
                                <span class="badge <?= $absence['justifie'] ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $absence['justifie'] ? 'Oui' : 'Non' ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Aucune absence trouvée</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function resetFilters() {
    window.location.href = "index.php?page=report_absence";
}
</script>
