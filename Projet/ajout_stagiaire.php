<?php
include 'baseDonnee.php'; //  la connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $programme = htmlspecialchars($_POST['programme']);
    $email = htmlspecialchars($_POST['email']);

    try {
        // Insertion dans la table stagiaires
        $stmt = $pdo->prepare("INSERT INTO stagiaires (nom, prenom, programme, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $programme, $email]);
        $_SESSION['message'] = "<div class='alert alert-success'>✅ Stagiaire ajouté avec succès !</div>";
        header('location: index.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['message'] = "<div class='alert alert-danger'>❌ Erreur : " . $e->getMessage() . "</div>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Stagiaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="mb-4">Ajouter un Stagiaire</h1>

    <!-- Display session message if available -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-dismissible fade show" role="alert">
            <?= $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?> <!-- Clear the message after displaying -->
    <?php endif; ?>

    <!-- Stagiaire Form -->
    <form method="POST" action="ajout_stagiaire.php">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom :</label>
            <input type="text" class="form-control" id="prenom" name="prenom" required>
        </div>

        <div class="mb-3">
            <label for="programme" class="form-label">Programme :</label>
            <input type="text" class="form-control" id="programme" name="programme" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

