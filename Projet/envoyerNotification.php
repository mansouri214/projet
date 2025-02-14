<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclure PHPMailer installé avec Composer
include 'baseDonnee.php';

// Fonction pour envoyer un email de notification
function envoyerNotificationEmail($email, $nom, $nombre_absences) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Remplace par ton serveur SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'ton-email@example.com';
        $mail->Password = 'mot-de-passe';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataire
        $mail->setFrom('admin@example.com', 'Administration MIAGE');
        $mail->addAddress($email, $nom);

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Alerte Absences - MIAGE';
        $mail->Body = "<h3>Bonjour $nom,</h3>
                       <p>Nous avons remarqué que vous avez accumulé <b>$nombre_absences absences</b>. 
                       Merci de régulariser votre situation.</p>
                       <p>Cordialement, <br>L'administration</p>";

        // Envoi de l'email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Vérifier les absences critiques (exemple : plus de 3 absences)
$stmt = $pdo->query("SELECT stagiaires.id, stagiaires.nom, stagiaires.email, COUNT(absences.id) AS nb_absences
                     FROM stagiaires
                     JOIN absences ON stagiaires.id = absences.stagiaire_id
                     GROUP BY stagiaires.id
                     HAVING nb_absences > 3");

while ($stagiaire = $stmt->fetch()) {
    envoyerNotificationEmail($stagiaire['email'], $stagiaire['nom'], $stagiaire['nb_absences']);
}

?>
