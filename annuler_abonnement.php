<?php
session_start();
include('includes/db.php');

// Vérifier si l'ID d'abonnement est passé dans l'URL
if (isset($_GET['abonnement_id'])) {
    $abonnement_id = $_GET['abonnement_id'];

    // Annuler l'abonnement en mettant à jour son statut
    $sql = "UPDATE abonnements SET status = 'Annulé' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $abonnement_id);
    
    if ($stmt->execute()) {
        // Redirection vers la page des abonnements après l'annulation
        header("Location: abonnement.php");
        exit;
    } else {
        echo "Erreur lors de l'annulation de l'abonnement.";
    }
} else {
    echo "Aucun ID d'abonnement spécifié.";
    exit;
}
