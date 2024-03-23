
<?php

//session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_sapeurpompier";

$matricule;
$email;
$password;

// Create connection
$connection = new mysqli($servername, $username, $password, $database);
$errorMessage = $successMessage = "";
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $matricule = $_POST["numMatricule_fk"];
    $email = $_POST["adressEmail"];
    $password = $_POST["mots_de_passe"];


    echo $matricule,$email,$password;
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM tab_login WHERE numMatricule_fk = ? AND mots_de_passe = ? AND adressEmail = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $matricule, $password, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['is_admin'] == 1) { 
            // المستخدم مشرف (أدمن)
            $_SESSION['numMatricule_fk'] = $matricule;
            header("Location: /firemen/index.php");
            exit();
        } else if ($user['is_admin'] == 0) {
            // المستخدم غير مشرف
            $_SESSION['numMatricule_fk'] = $matricule;
            header("Location: /firemen/homepagefiremen.php");
            exit();
        }
    } else {
        $errorMessage = "Invalid login credentials. Please try again.";
    }

    
}

// Close connection
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>stage d etudiant</title>
    <script src="app.js"></script>
    <style>
        
    </style>
</head>
<body>
<form method="post">
    <div class="main">
        <div class="navbar">
            <div class="icon">  
                <h2 class="logo">STALGERIE</h2>    
            </div>
                   <div class="menu">
            
                        <ul >
                        <Li class="active"><a href="/firemen/accueil.php">HOME</a></Li>
                        <Li class="active"><a href="/firemen/about.php">ABOUT</a></Li>
                        <Li class="active"><a href="/firemen/service.php">SERVICE</a></Li>
                        <Li class="active"><a href="#">CONTACT</a></Li>
                        <Li class="active"><a href="#">HELP</a></Li>
                        
                        </ul>
                
                    </div>
                    <?php
            if (!empty($errorMessage)) {
                echo '<div class="error-message">' . $errorMessage . '</div>';
            }
        ?>
                    
        </div>
                    <div class="content">
                           <h1>lES STAGE</h1> <br> <span> DISPONIBLE</span>
                           <br>
                           <button class="btn1" href="/firemen/service.php" role="button"> LES STAGES</button>
                              <div class="form">
                        <h2>LOGIN </h2>
                        <input type="number" id="numMatricule_fk" name="numMatricule_fk" placeholder="ENTER MATRICULE HERE">
                        <input type="email" id="adressEmail" name="adressEmail" placeholder="ENTER EMAIL HERE">
                        <input type="password" id="mots_de_passe" name="mots_de_passe" placeholder="ENTER password HERE">
                        <button class="btn1" href="/firemen/create.php" role="button">LOGIN</button>
                        <P>IF YOU HAVEN'T COUNT INSCRIRE PLEASE</P>
                        <button class="btn1" href="/GL/create.php" role="button">INSCRIPTION</button>
        
    

                    </div>
                    </div>
                    
        
        
    </div>
    

    
    
    </form>
</body>
</html>