<?php
include('includes/header.php');
include('includes/db.php');
session_start();

// Récupérer l'ID du client connecté
$client_id = $_SESSION['client_id']; 

// Récupérer les offres disponibles
$sql = "SELECT * FROM offres";
$result = $conn->query($sql);
?>
<center>
<main>
    <h2>Nos Offres</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Action</th>
        </tr>
        
        <?php while ($row = $result->fetch_assoc()) { 
            $offre_id = $row['id'];
            
            // Vérifier si l'utilisateur est déjà souscrit à cette offre
            $sql_check = "SELECT * FROM abonnements WHERE client_id = ? AND offre_id = ? AND status = 'Actif'";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->bind_param("ii", $client_id, $offre_id);
            $stmt_check->execute();
            $result_check = $stmt_check->get_result();
            $is_subscribed = $result_check->num_rows > 0;

            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><?php echo htmlspecialchars($row['prix']); ?> TND</td>
                <td>
                    <?php if ($is_subscribed) { ?>
                        <a href="desinscrire.php?offre_id=<?php echo $offre_id; ?>"><button>Annuler l'inscription</button></a>
                    <?php } else { ?>
                        <a href="souscrire.php?offre_id=<?php echo $offre_id; ?>"><button>Souscrire</button></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</main></center>

<?php include('includes/footer.php'); ?>
