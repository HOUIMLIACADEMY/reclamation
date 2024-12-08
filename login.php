<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM clients WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Vérifier le mot de passe
        if (password_verify($password, $user['password'])) {
            $_SESSION['client_id'] = $user['id']; // Stocker l'ID de l'utilisateur dans la session
            header("Location: index.php"); // Redirection vers la page principale
        } else {
            $error = "Mot de passe incorrect";
        }
    } else {
        $error = "Email non trouvé";
    }
}
?>

<?php include('includes/header.php'); ?>
<center>
    <style>
        input{
            padding: 5px 10px;
            width: 70%;
            text-align:center;
        }
        p a {
            color:blue;
        }
    </style>
<main>
   <h2>Connexion</h2>
    
    <br>
    <form method="POST" action="login.php">
        <label for="email">Email :</label>
        <br>
        <br>
        <input type="email" id="email" name="email" required>
        <br>
        <br>
        <label for="password">Mot de passe :</label>
        <br>
        <br>
        <input type="password" id="password" name="password" required>
        <br>
        <br>
        <button type="submit">Se connecter</button>
        <br>
        <br>
        
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    </form>
    <p><font color="blue"><a href="register.php">Inscrivez-vous ici</a></font></p>
</main>
</center>
<?php include('includes/footer.php'); ?>
