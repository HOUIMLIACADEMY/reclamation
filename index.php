
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Abonnements</title>
    
    <!-- Lien vers Bootstrap pour faciliter la création du carrousel et des cartes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles pour ajuster les cartes et la mise en page */
        .offres-section {
            margin: 30px 0;
        }
        .offres-section h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            text-align: center;
            margin: 10px;
        }
        .carousel-inner img {
            width: 100%;
            height: 400px;
        }
        .carousel-control-prev, .carousel-control-next {
            filter: invert(1); /* Pour rendre les icônes de contrôle visibles */
        }
    </style>
</head>
<body>
<?php include("includes/header.php")
?>


    <!-- Carrousel d'images -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="1.jpg" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="2.jpg" class="d-block w-100" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="3.png" class="d-block w-100" alt="Image 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Lien vers Bootstrap JS pour activer le carrousel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   


    

    <?php include("includes/footer.php");?>
  
</body>
</html>


