<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Gestion de Login
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $Mpasse = $_POST['Mpasse'];

        // Protect against SQL injection
        $email = mysqli_real_escape_string($conn, $email);
        $Mpasse = mysqli_real_escape_string($conn, $Mpasse);

        // Query to check if the user exists
        $query = "SELECT * FROM utilisateur WHERE email = '$email' AND Mpasse = '$Mpasse'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            // Set session variable and redirect to welcome page
            $_SESSION['email'] = $email;
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
            exit();
        } else {
            // Set error message for invalid credentials
            $error = "Invalid email or Mpasse";
        }
    }

    // Handle logout
    if (isset($_POST['logout'])) {
        // Destroy the session and redirect to login page
        session_destroy();
        header('Location: index.php');
        exit();
    }

    // Gestion du signup
    if (isset($_POST['signup'])) {
        $email = $_POST['email'];
        $mpasse = $_POST['mpasse'];
        $mpasse_confirm = $_POST['mpasse_confirm'];

        if ($mpasse != $mpasse_confirm) {
            echo "<script>alert('Les mots de passe ne correspondent pas');</script>";
        } else {
            $sql = "SELECT * FROM utilisateur WHERE Email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>alert('Email déjà utilisé');</script>";
            } else {
                $sql = "INSERT INTO utilisateur (Email, Mpasse) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $email, $mpasse);

                if ($stmt->execute()) {
                    echo "<script>alert('Inscription réussie');</script>";
                } else {
                    echo "<script>alert('Erreur lors de l\'inscription: " . $stmt->error . "');</script>";
                }
            }

            $stmt->close();
        }
    }
}

$conn->close();
?>

<?php include 'header.php';?>
<body>
    <section class="home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- Login Form -->
            <div class="form login_form">
                <form method="post" action="">
                    <h2>Se Connecter</h2>
                    <div class="input_box">
                        <input type="email" name="email" placeholder="Entrez votre email" required>
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="Mpasse" placeholder="Entrez votre Mpasse" required>
                        <i class="uil uil-lock Mpasse"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="option_field">
                        <span class="checkbox">
                            <input type="checkbox" id="check">
                            <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot Mpasse?</a>
                    </div>
                    <button type="submit" name="login" class="button">connecter maintenant</button>
                    <div class="login_signup">
                        Don't have an account? <a href="#" id="signup">S'inscrire</a>
                    </div>

                </form>
                        <?php if (isset($error)) 
                        echo "<script>alert('Erreur connexion');</script>";
                       ?>
            </div>

            <!-- Signup Form -->
            <div class="form signup_form">
                <form method="post" action="">
                    <h2>S'inscrire</h2>
                    <div class="input_box">
                        <input type="text" name="firstname" placeholder="Entrez votre prénom" required>
                    </div>
                    <div class="input_box">
                        <input type="text" name="name" placeholder="Entrez votre nom" required>
                    </div>
                    <div class="input_box">
                        <input type="email" name="email" placeholder="Entrez votre email" required>
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="mpasse" placeholder="Créer un Mpasse" required>
                        <i class="uil uil-lock Mpasse"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" name="mpasse_confirm" placeholder="Confirmer Mpasse" required>
                        <i class="uil uil-lock Mpasse"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <button type="submit" name="signup" class="button">S'inscrire maintenant</button>
                    <div class="login_signup">
                        Vous avez déjà un compte? <a href="#" id="login">Se Connecter</a>
                    </div>
                </form>
            </div>
        </div>
        <div id="main-image" style="/*! text-align: center; *//*! padding: 120px; */font-weight: normal;text-align: center;padding: 225px;">
           <div class="wrapper" style="width: 940px;margin: 0 auto;padding: 0 20px;">
            <h2 style="color: #fff;font-size: 45px; ">Bienvenue !<br><strong> Réservez vos billets</strong><br><strong>pour les meilleurs événements</strong><br></h2>
  

          </div>
        </div>
    </section>
    
    
    <script src="js/script.js"></script>
</body>
</html>