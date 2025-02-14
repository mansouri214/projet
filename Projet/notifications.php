<?php
require_once 'baseDonnee.php'; // Connexion à la base de données



// Fonction pour ajouter une notification
function ajouterNotification($utilisateur_id, $message) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO notifications (utilisateur_id, message, date_notification) VALUES (?, ?, NOW())");
    $stmt->execute([$utilisateur_id, $message]);
}

// Récupérer les notifications d'un utilisateur
function getNotifications($utilisateur_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM notifications WHERE utilisateur_id = ? ORDER BY date_notification DESC");
    $stmt->execute([$utilisateur_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Marquer une notification comme lue (si nécessaire)
function marquerCommeLue($notification_id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE notifications SET lue = 1 WHERE id = ?");
    return $stmt->execute([$notification_id]);
}

// Supprimer une notification
function supprimerNotification($notification_id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM notifications WHERE id = ?");
    return $stmt->execute([$notification_id]);
}

function verifierAbsencesEtNotifier($stagiaire_id, $pdo) {
    // Récupérer les infos du stagiaire
    $stmt = $pdo->prepare("SELECT nom, prenom FROM stagiaires WHERE id = ?");
    $stmt->execute([$stagiaire_id]);
    $stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stagiaire) {
        // Vérifier le nombre d'absences
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM absences WHERE stagiaire_id = ?");
        $stmt->execute([$stagiaire_id]);
        $nbAbsences = $stmt->fetchColumn();

        // Si plus de 3 absences, envoyer une notification
        if ($nbAbsences >= 3) {
            $nomComplet = $stagiaire['nom'] . ' ' . $stagiaire['prenom'];

            // Récupérer l'ID de l'admin
            $adminStmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE role = 'administrateur' LIMIT 1");
            $adminStmt->execute();
            $admin = $adminStmt->fetch(PDO::FETCH_ASSOC);

            if ($admin) {
                ajouterNotification($admin['id'], "⚠️ Le stagiaire $nomComplet a dépassé 3 absences.");
            }
        }
    }
}


?>
