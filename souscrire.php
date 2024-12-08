<?php
session_start();
include('includes/db.php');

// Vérifier si l'ID de l'offre est passé dans l'URL
if (isset($_GET['offre_id'])) {
    $offre_id = $_GET['offre_id'];
    $client_id = $_SESSION['client_id']; // ID du client connecté

    // Vérifier si l'utilisateur est déjà souscrit à cette offre
    $sql_check = "SELECT * FROM abonnements WHERE client_id = ? AND offre_id = ? AND status = 'Actif'";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ii", $client_id, $offre_id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    // Si l'utilisateur n'est pas déjà souscrit, l'ajouter
    if ($result_check->num_rows == 0) {
        // Insérer un nouvel abonnement pour le client connecté
        $sql = "INSERT INTO abonnements (client_id, offre_id, status) VALUES (?, ?, 'Actif')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $client_id, $offre_id);
        
        if ($stmt->execute()) {
            // Redirection vers la page des offres après la souscription
            header("Location: offres.php");
            exit;
        } else {
            echo "Erreur lors de la souscription à l'offre.";
        }
    } else {
        // Si l'utilisateur est déjà souscrit, afficher un message
        echo "Vous êtes déjà souscrit à cette offre.";
    }
} else {
    echo "Aucune offre spécifiée.";
    exit;
}
?>
