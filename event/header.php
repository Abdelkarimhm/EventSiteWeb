<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TicketEvent</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="style.css?v=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
</head>
<body>
    

    <header class="header">
        <div class="nav">
            <a href="index.php" class="nav_logo">TicketEvent</a>
            <nav>
                <ul class="nav_items">
                    <li class="nav_item">
                        <a href="index.php" class="nav_link">Accueil</a>
                        <a href="service.php" class="nav_link">Service</a>
                        <a href="contact2.php" class="nav_link">Contact</a>
                    </li>
                </ul>
            </nav>
            <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <form method="post" action="" style="display: inline;">
                    <button type="submit" name="logout" class="button-s" id="form-close">Déconnexion</button>
                </form>
            <?php else: ?>
                <button class="button" id="form-open">Connexion</button>
            <?php endif; ?>   
        </header>
        
        </body>
