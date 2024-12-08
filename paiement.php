<?php
include("includes/header.php");
include('includes/db.php');
$offre_id = $_GET['offre_id'];

// Récupérer les informations de l'offre pour le paiement
$sql = "SELECT * FROM offres WHERE id = $offre_id";
$result = $conn->query($sql);
$offre = $result->fetch_assoc();
?>
<center>
    
<main>
    <h2>Paiement</h2>
    <span>Offre : <?php echo htmlspecialchars($offre['nom']); ?></span>
    <span>Prix : <?php echo htmlspecialchars($offre['prix']); ?> TND</span>

    <!-- Formulaire de paiement fictif -->
    <form method="POST" action="success.php">
        <input type="hidden" name="offre_id" value="<?php echo $offre_id; ?>">
         <br>
        <button type="submit">Payer maintenant</button>
    </form>
</main>
</center>

<?php include('includes/footer.php'); ?>
