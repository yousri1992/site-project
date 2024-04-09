<?php

require_once('include.php');
$connexion = new Connexion();
if (isset($_SESSION['ID_etudiant']) || isset($_SESSION['ID_entreprise'])){
    header("Location: /GLT/index.php");
                exit; 
}

if (!empty($_POST)) {
    extract($_POST);
    if (isset($_POST['connexion'])) {
       [$errorMessage] = $_Connexion->verification_connexionE($email,$password);
       if (!isset($_SESSION['ID_entreprise'])) {
        // Vérification pour les entreprises si l'utilisateur n'est pas un étudiant
        [$errorMessageEN] = $_Connexion->verification_connexionEN($email, $password);
    }
       
        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    
    <?php
            
            require_once('_header/script.php');
            require_once('_header/meta.php');

        ?>
</head>
<body>
<?php
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?> 
    <form method="post">
        <div class="main">
        <?php
            
            require_once('_menu/menu.php');
        ?>
       
            <div class="content">
                <h1>LES STAGES</h1>
                <span>DISPONIBLE</span>
                <br>
               
                <div class="form">
                    <h2>LOGIN</h2>
                    <input type="email" id="email" name="email" placeholder="ENTER EMAIL HERE">
                    <input type="password" id="password" name="password" placeholder="ENTER password HERE">
                    <button type="submit" name="connexion" class="btn1" role="button">LOGIN</button>
                    <p>IF YOU HAVEN'T ACCOUNT, PLEASE REGISTER</p>
                    <button type="button" class="btn1" onclick="window.location.href='/GL/choix_inscription.php'">INSCRIPTION</button>
                </div>
            </div>
        </div>
    </form>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <?php
            
            require_once('_footer/footer.php');
    ?>    
</body>
</html>
