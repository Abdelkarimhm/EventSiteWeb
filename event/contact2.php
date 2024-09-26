<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $query = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $query)) {
        $success = "Message sent successfully!";
    } else {
        $error = "Error sending message: " . mysqli_error($conn);
    }
}
?>
<?php include 'header.php'; ?>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-image: url("images/Bg.jpg");
                        }
                         
                        #contact {
                            padding: 110px 0;
                            text-align: center;

                        }   
                        .wrapper-s {
                            max-width: 450px;
                            height: 460px;
                            margin: 20px auto;
                            padding: 3px;
                            border: 1px solid #ddd;
                            border-radius: 10px;
                            background-color: #fff;
                        }
                        .wrapper-s h3 {
                    
                            font-size: 24px;
                            text-align: center;
                            padding : 25px 0 ;
                        }
                    
                        .wrapper-s p {
                            margin-bottom: 20px;
                            font-size: 15px;
                            color: #666;
                            text-align: center;
                        }
                            
                        .wrapper-s label {
                            display: block;
                            margin-bottom: 10px;
                        }
                        .wrapper-s input, .wrapper-s textarea {
                            width: 90%;
                            padding: 15px;
                            margin-bottom: 10px;
                            border: 1px solid #ddd;
                            border-radius: 5px;
                        }
                        .button-3 {
                            background-color: #007BFF;
                            color: white;
                            padding: 10px 15px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                        }
                        .button-3:hover {
                            background-color: #0056b3;
                        }
                        .message {
                            margin-bottom: 30px;
                            padding: 10px;
                            border-radius: 5px;
                        }
                        .success {
                            background-color: #d4edda;
                            color: #155724;
                            border: 3px solid #c3e6cb;
                        }
                        .error {
                            background-color: #f8d7da;
                            color: #721c24;
                            border: 1px solid #f5c6cb;
                        }
                    </style>

<body>
<section id="contact">
<div class="wrapper-s">
<h3>Contactez-nous</h3>
<p>N'hésitez pas à nous contacter en envoyant un email via le formulaire ci-dessous</p>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Votre Nom" required>
        <input type="email" name="email" placeholder="Votre Email" required>
        <textarea name="message" placeholder="Votre Message" required></textarea>
        <input type="submit" name="contact" value="Envoyer" class="button-3">
    </form>
    <?php if (isset($success)): ?>
        <p><?php echo $success; ?></p>
    <?php endif; ?>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>
</html>
