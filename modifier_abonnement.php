<?php
session_start();
include('includes/db.php');

// Récupérer l'ID de l'abonnement depuis l'URL
if (isset($_GET['abonnement_id'])) {
    $abonnement_id = $_GET['abonnement_id'];

    // Récupérer les détails de l'abonnement
    $sql = "SELECT * FROM abonnements WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $abonnement_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $abonnement = $result->fetch_assoc();
    } else {
        echo "Aucun abonnement trouvé.";
        exit;
    }
} else {
    echo "Aucun ID d'abonnement spécifié.";
    exit;
}

// Mettre à jour l'abonnement après soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nouveau_status = $_POST['status'];

    // Mise à jour dans la base de données
    $sql_update = "UPDATE abonnements SET status = ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $nouveau_status, $abonnement_id);
    
    if ($stmt_update->execute()) {
        echo "Abonnement mis à jour avec succès.";
        header("Location: abonnement.php");
        exit;
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<?php include('includes/header.php'); ?>

<main>
    <h2>Modification de l'abonnement #<?php echo $abonnement_id; ?></h2>
    
    <form method="POST" action="">
        <label for="status">Statut de l'abonnement :</label>
        <select name="status" id="status">
            <option value="Actif" <?php echo ($abonnement['status'] == 'Actif') ? 'selected' : ''; ?>>Actif</option>
            <option value="Annulé" <?php echo ($abonnement['status'] == 'Annulé') ? 'selected' : ''; ?>>Annulé</option>
        </select>
        
        <button type="submit">Mettre à jour</button>
    </form>
</main>

<?php include('includes/footer.php'); ?>
