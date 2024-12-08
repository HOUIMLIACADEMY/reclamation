<?php
session_start();
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Vérifier si l'email existe déjà
    $sql_check = "SELECT * FROM clients WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $error = "Cet email est déjà utilisé";
    } else {
        // Insérer l'utilisateur dans la base de données
        $sql = "INSERT INTO clients (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $hashed_password);
        
        if ($stmt->execute()) {
            $_SESSION['client_id'] = $conn->insert_id; // Stocker l'ID du nouvel utilisateur dans la session
            header("Location: index.php"); // Redirection vers la page principale
        } else {
            $error = "Erreur lors de l'inscription";
        }
    }
}
?>

<?php include('includes/header.php'); ?>
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
    <center>
<main>
    <h2>Inscription</h2>
    <form method="POST" action="register.php">
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
        <button type="submit">S'inscrire</button>
        
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    </form>
    <p><a href="login.php">Connectez-vous ici</a></p>
</main>
</center>

<?php include('includes/footer.php'); ?>
