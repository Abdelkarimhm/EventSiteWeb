<?php
session_start();
include 'header.php'; // Inclure le header

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Fermer la session après l'achat
session_destroy();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Merci pour votre achat</title>
    <style>
        body {
            background-image: url("images/Bg.jpg");
            font-family: Arial, sans-serif;
            text-align: center;
            color: #333;
        }
        .container-round {
            margin: 50px auto;
            width: 60%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .thank-you-title {
            font-size: 24px;
            color: #ff6600;
            margin-bottom: 20px;
        }
        .thank-you-message {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .btn-home {
            background-color: #ff6600;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .btn-home:hover {
            background-color: #cc5200;
        }
    </style>
</head>
<body>
    <section style="padding: 100px">
    <div class="container-round" style="padding: 100px">
        <h1 class="thank-you-title">Merci pour votre achat !</h1>
        <p class="thank-you-message">Votre commande a été traitée avec succès. Vous recevrez bientôt un email de confirmation.</p>
        <a href="index.php" class="btn-home">Retour à l'accueil</a>
    </section>
    
</body>
</html>
