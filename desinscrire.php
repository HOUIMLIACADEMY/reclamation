<?php
session_start();
include('includes/db.php');

// Vérifier si l'ID de l'offre est passé dans l'URL
if (isset($_GET['offre_id'])) {
    $offre_id = $_GET['offre_id'];
    $client_id = $_SESSION['client_id']; // ID du client connecté

    // Annuler l'abonnement de cette offre pour le client connecté
    $sql = "UPDATE abonnements SET status = 'Annulé' WHERE client_id = ? AND offre_id = ? AND status = 'Actif'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $client_id, $offre_id);
    
    if ($stmt->execute()) {
        // Redirection vers la page des offres après l'annulation
        header("Location: offres.php");
        exit;
    } else {
        echo "Erreur lors de l'annulation de l'abonnement.";
    }
} else {
    echo "Aucune offre spécifiée.";
    exit;
}
?>
