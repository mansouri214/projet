<?php
include 'baseDonnee.php'; // Connexion à la base de données

$message = ""; // Message d'erreur ou de succès

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT); // Hachage du mot de passe
    $role = htmlspecialchars($_POST['role']); // "administrateur" ou "professeur"

    try {
        // Insertion dans la table utilisateurs
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $prenom, $email, $mot_de_passe, $role]);
        $message = "<div class='alert alert-success'>✅ Utilisateur enregistré avec succès ! <a href='login.php'>Se connecter</a></div>";
    } catch (PDOException $e) {
        $message = "<div class='alert alert-danger'>❌ Erreur : " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h3>Créer un compte</h3>
                </div>
                <div class="card-body">
                    <?= $message ?>

                    <form method="POST" action="enregistrement.php">
                        <div class="mb-3">
                            <label class="form-label">Nom :</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prénom :</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mot de passe :</label>
                            <input type="password" name="mot_de_passe" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rôle :</label>
                            <select name="role" class="form-select" required>
                                <option value="administrateur">Administrateur</option>
                                <option value="professeur">Professeur</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100">S'inscrire</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>Déjà inscrit ? <a href="login.php" class="text-success">Se connecter</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
