<?php
require_once 'baseDonnee.php';
require_once 'notifications.php';

$utilisateur_id = 1; // Remplace par un ID valide
$notifications = getNotifications($utilisateur_id);

echo "<pre>";
print_r($notifications);
echo "</pre>";
?>
