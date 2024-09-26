<?php
session_start();
include 'db_connect.php';


// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
    echo "<script>
        alert('Veuillez vous connecter pour continuer');
        window.location.href = 'index.php';
    </script>";
    exit();
}

// Récupération des données de l'événement sélectionné
if (isset($_GET['idEvent'])) {
    $idEvent = $_GET['idEvent'];
    $sql = "SELECT * FROM nomevent WHERE idEvent = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEvent);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();
} else {
    // Rediriger vers la page des événements si aucun événement n'est sélectionné
    header("Location: index.php");
    exit();
}

// Function to generate a unique ticket number
function generateUniqueTicketNumber($conn) {
    do {
        $numTicket = rand(1000, 9999);
        $sql = "SELECT * FROM venteticket WHERE NumTicket = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $numTicket);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    } while ($result->num_rows > 0);
    return $numTicket;
}

// Traitement du formulaire de commande
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $numPlaces = 1; // Par exemple, une seule place est achetée. Vous pouvez le rendre dynamique si nécessaire.
    $numTicket = generateUniqueTicketNumber($conn); // Générer un numéro de ticket unique

    // Insertion dans la table venteticket
    $sql = "INSERT INTO venteticket (date, Email, IDevent, NumberPlace, NumTicket) VALUES (CURDATE(), ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siii", $email, $idEvent, $numPlaces, $numTicket);

    if ($stmt->execute()) {
        // Rediriger vers une page de remerciement ou de confirmation finale
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Erreur lors de l'insertion du ticket: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<?php include 'header.php';?>
    <style>
        body {
            background-image: url("images/Bg.jpg");
           
        }
        .container-round {
            margin-left: 150px;
            padding-left: 260px;
        }
        .confirmation-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
        }
        .confirmation-details {
            font-size: 18px;
            margin-bottom: 15px;
        }
        .confirmation-price {
            font-size: 20px;
            color: #ff6600;
            margin-bottom: 15px;
        }
        .btn-confirm {
            background-color: #ff6600;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
        .btn-confirm:hover {
            background-color: #cc5200;
        }
    </style>

<body>
    <div style="padding: 170px 0px 50px 60px;width: 900px;">
    <div class="container-round">
        <div class="confirmation-card">
            <h2>Confirmation de l'Achat</h2>
            <?php if ($event): ?>
                <div class="confirmation-details">
                    <strong>Événement:</strong> <?php echo htmlspecialchars($event['titre']); ?><br>
                    <strong>Lieu:</strong> <?php echo htmlspecialchars($event['Ville']); ?><br>
                    <strong>Date:</strong> <?php echo htmlspecialchars($event['date']); ?><br>
                    <strong>Nombre de places:</strong> <?php echo htmlspecialchars($event['Nplace']); ?><br>
                </div>
                <div class="confirmation-price">
                    <strong>Prix:</strong> <?php echo htmlspecialchars($event['Prix']); ?> DH
                </div>
                <form method="post" action="">
                    <button type="submit" class="btn-confirm">Confirmer et Payer</button>
                </form>
            <?php else: ?>
                <p>Événement non trouvé.</p>
            <?php endif; ?>
        </div>
    </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
