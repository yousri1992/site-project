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
    $maticuleEtudiant=  $_POST["maticuleEtudiant"];
    $nom = $_POST["nom "];
    $prenom  = $_POST["prenom"];
    $anneNaissance = $_POST["anneNaissance"];
    $lieuNAISSANCE = $_POST["lieuNAISSANCE"];
    $willayaResidence = $_POST["willayaResidence"];
    $univercite = $_POST["univercite"];
    $specialite = $_POST["specialite"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $dataValid = true;

    // Validation
    if (empty($maticuleEtudiant) || empty($nom) || empty($prenom) || empty($anneNaissance) || empty($lieuNAISSANCE) || empty($willayaResidence)|| empty($univercite)|| empty($specialite)|| empty($email )|| empty($password)) {
        $dataValid = false;
        $errorMessage = "All fields are required.";
    }

    // Additional validation if needed 

    if ($dataValid) {
        // ADD NEW CENGIN TO DATABASE
        
        $sql = "INSERT INTO tab_engin (maticuleEtudiant, nom, prenom, anneNaissance, lieuNAISSANCE, willayaResidence, univercite, specialite, email, password ) " .
            "VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $connection->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssss",$maticuleEtudiant, $nom, $prenom, $anneNaissance, $lieuNAISSANCE, $willayaResidence, $univercite, $specialite, $email, $password);
        

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
<body>
    <div class="container my-5">
        <h2>new stagiaire </h2>

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
                <label class="col-sm-3 col-form-label">maticuleEtudiant </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="maticuleEtudiant" value="<?php echo $maticuleEtudiant;?> ">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php echo $nom;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> prenom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php echo $prenom;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">anneNaissance</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="anneNaissance" value="<?php echo $anneNaissance;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">lieuNAISSANCE</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lieuNAISSANCE" value="<?php echo $lieuNAISSANCE;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">willayaResidence</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="willayaResidence" value="<?php echo $willayaResidence;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">univercite</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="univercite" value="<?php echo $univercite;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">specialite</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="willayaResidence" value="<?php echo $specialite;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password" value="<?php echo $password;?>">
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
                      <a class="btn btn-outline-primary" href="/GL/accueil.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>