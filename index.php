<?php

//session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_stage";

$maticuleEtudiant;
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
    $maticuleEtudiant = $_POST["maticuleEtudiant"];
    $email = $_POST["email"];
    $password = $_POST["password"];


    echo $maticuleEtudiant,$email,$password;
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM tab_idetudiant WHERE maticuleEtudiant = ? AND email = ? AND password = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss", $maticuleEtudiant, $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['is_admin'] == 1) { 
            // المستخدم مشرف (أدمن)
            $_SESSION['maticuleEtudiant'] = $maticuleEtudiant;
            header("Location: /GL/ADMIN.php");
            exit();
        } else if ($user['is_admin'] == 0) {
            // المستخدم غير مشرف
            $_SESSION['maticuleEtudiant'] = $maticuleEtudiant;
            header("Location: /GL/create.php");
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
                        <Li class="active"><a href="/GL/index.php">HOME</a></Li>
                        <Li class="active"><a href="/GL/about.php">ABOUT</a></Li>
                        <Li class="active"><a href="/GL/contact.php">CONTACT</a></Li>
                        <Li class="active"><a href="/GL/help.php">HELP</a></Li>
                        </ul>
                
                    </div>
                       <?php
                          if (!empty($errorMessage)) {
                            echo '<div class="error-message">' . $errorMessage . '</div>';
                         }
                        ?>
                    
                    
        </div>
        <div class="content">
            <h1>LES STAGES</h1>
            <span>DISPONIBLE</span>
            <br>
            <button class="btn1" href="/firemen/service.php" role="button"> LES STAGES</button>
            <div class="form">
                <h2>LOGIN</h2>
                <input type="number" id="maticuleEtudiant" name="maticuleEtudiant" placeholder="ENTER MATRICULE HERE">
                <input type="email" id="email" name="email" placeholder="ENTER EMAIL HERE">
                <input type="password" id="password" name="password" placeholder="ENTER password HERE">
                <button type="submit" class="btn1" role="button">LOGIN</button>
                <p>IF YOU HAVEN'T ACCOUNT, PLEASE REGISTER</p>
                <button type="button" class="btn1" onclick="window.location.href='/GL/create.php'">INSCRIPTION</button>
            </div>
        </div>
    </div>
</form>    
</body>
</html>