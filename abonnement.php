<?php
include('includes/header.php');
include('includes/db.php');
$client_id = 1; // Remplacez par l'ID du client connecté

// Récupérer les abonnements du client
$sql = "SELECT a.*, o.nom, o.prix FROM abonnements a JOIN offres o ON a.offre_id = o.id WHERE a.client_id = $client_id";
$result = $conn->query($sql);
?>
<center>
<main>
    <h2>Mes Abonnements</h2>
    <table>
        <tr>
            <th>Offre</th>
            <th>Date de Souscription</th>
            <th>Prix</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nom']); ?></td>
            <td><?php echo htmlspecialchars($row['date_souscription']); ?></td>
            <td><?php echo htmlspecialchars($row['prix']); ?> TND</td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="modifier_abonnement.php?abonnement_id=<?php echo $row['id']; ?>">Modifier</a> |
                <a href="annuler_abonnement.php?abonnement_id=<?php echo $row['id']; ?>">Annuler</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</main>
</center>
<?php include('includes/footer.php'); ?>
