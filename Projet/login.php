<?php
include 'baseDonnee.php'; // Connexion à la base de données
session_start(); // Démarrer une session

$message = ""; // Message d'erreur

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['email']);
    $mot_de_passe = $_POST['mot_de_passe'];

    try {
        // Vérification de l'utilisateur
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $utilisateur = $stmt->fetch();

        if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
            // Connexion réussie
            $_SESSION['utilisateur_id'] = $utilisateur['id'];
            $_SESSION['role'] = $utilisateur['role'];
            header('Location: index.php');
            exit();
        } else {
            $message = "❌ Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Connexion</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($message)) : ?>
                        <div class="alert alert-danger"><?= $message ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="login.php">
                        <div class="mb-3">
                            <label class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Mot de passe :</label>
                            <input type="password" name="mot_de_passe" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>

                    <div class="text-center mt-3">
                        <p>Pas encore de compte ? <a href="enregistrement.php" class="text-primary">Créer un compte</a></p>
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
