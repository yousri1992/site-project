<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bd_stage";

// CREATE CONNECTION
$connection = new mysqli($servername, $username, $password, $database);
$maticuleEtudiant= $nom = $prenom = $anneNaissance = $lieuNAISSANCE = $willayaResidence = $univercite = $specialite = $email  = $password ="";

$errorMessage = $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $maticuleEtudiant= htmlspecialchars( $_POST["maticuleEtudiant"]);
    $nom = htmlspecialchars( $_POST["nom"]);
    $prenom  =  htmlspecialchars($_POST["prenom"]);
    $anneNaissance = htmlspecialchars($_POST["anneNaissance"]);
    $lieuNAISSANCE = htmlspecialchars($_POST["lieuNAISSANCE"]);
    $willayaResidence =htmlspecialchars( $_POST["willayaResidence"]);
    $univercite =htmlspecialchars( $_POST["univercite"]);
    $specialite = htmlspecialchars($_POST["specialite"]);
    $email = htmlspecialchars($_POST["email"]);
    $inputPassword =  $_POST["password"];
    $passwordConfirm = $_POST["password_confirm"]; 

    $dataValid = true;

    // Validation
    if (empty($maticuleEtudiant) || empty($nom) || empty($prenom) || empty($anneNaissance) || empty($lieuNAISSANCE) || empty($willayaResidence)|| empty($univercite)|| empty($specialite)|| empty($email )|| empty( $inputPassword)||empty($passwordConfirm)) {
        $dataValid = false;
        $errorMessage = "tous les champs sont <font color= 'red'>obligatoires.</font>";
    } elseif ($inputPassword !== $passwordConfirm) {
        $dataValid = false;
        $errorMessage = "Password and confirm password do not match.";
    }

    // Additional validation if needed 

    if ($dataValid) {
        $hashedPassword = password_hash( $inputPassword, PASSWORD_BCRYPT);
        // ADD NEW STAGER TO DATABASE
        
        $sql = "INSERT INTO tab_idetudiant (maticuleEtudiant, nom, prenom, anneNaissance, lieuNAISSANCE, willayaResidence, univercite, specialite, email, password) " .
       "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);
        if (!$stmt) {
            die("Error in SQL query: " . $connection->error);
        }

        // Bind parameters
        $stmt->bind_param("ssssssssss", $maticuleEtudiant, $nom, $prenom, $anneNaissance, $lieuNAISSANCE, $willayaResidence, $univercite, $specialite, $email, $hashedPassword);
        

        // Execute the statement
        if ($stmt->execute()) {
            $successMessage = "Etudiant added correctly.";
        } else {
            $errorMessage = "Error adding etudiant: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create stagiaire</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body style="background:#000709e6; color:#fff;">
    <div  align="center" class="container my-5" >
        <h1>s'inscrire</h1>

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
        
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Matricule étudiant </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="maticuleEtudiant" value="<?php echo $maticuleEtudiant;?> ">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date de naissance</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="anneNaissance" value="<?php echo $anneNaissance;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lieu de naissance</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lieuNAISSANCE" value="<?php echo $lieuNAISSANCE;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Wilaya de résidence</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="willayaResidence" value="<?php echo $willayaResidence;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Université </label>
                <div class="col-sm-6">
                    <input type="text"  class="form-control" name="univercite" value="<?php echo $univercite;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Spécialité</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="specialite" value="<?php echo $specialite;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">mots de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> conferme mots de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password_confirm" placeholder="confirmez votre mots de passe" value="<?php echo $password;?>">
                </div>
            </div>

            <?php
        if (!empty($successMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>
            <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
                <div class="col-sm-3 d-grid">
                      <a class="btn btn-outline-primary" href="/GL/createE.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>