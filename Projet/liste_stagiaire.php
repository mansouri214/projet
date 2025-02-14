<?php
include 'baseDonnee.php'; // Connexion à la base de données

try {
    // Récupération des stagiaires
    $stmt = $pdo->query("SELECT * FROM stagiaires ORDER BY date_inscription DESC");
    $stagiaires = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erreur : " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Stagiaires</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Liste des Stagiaires</h3>
        </div>
        <div class="card-body">
            <!-- Search Bar -->
            <div class="mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher un stagiaire...">
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Programme</th>
                            <th>Email</th>
                            <th>Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody id="stagiaireTable">
                        <?php foreach ($stagiaires as $stagiaire): ?>
                        <tr>
                            <td><?= $stagiaire['id'] ?></td>
                            <td><?= htmlspecialchars($stagiaire['nom']) ?></td>
                            <td><?= htmlspecialchars($stagiaire['prenom']) ?></td>
                            <td>
                                <span class="badge bg-info"><?= htmlspecialchars($stagiaire['programme']) ?></span>
                            </td>
                            <td><?= htmlspecialchars($stagiaire['email']) ?></td>
                            <td><?= date("d/m/Y", strtotime($stagiaire['date_inscription'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- No Data Message -->
            <?php if (empty($stagiaires)) : ?>
                <div class="alert alert-warning text-center">Aucun stagiaire trouvé.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Search Filter Script -->
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("#stagiaireTable tr");

    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>

</body>
</html>
