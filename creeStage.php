<?php
// 1. Établir la connexion à la base de données
$connection = new mysqli('localhost', 'root', '', 'bd_stalgerie');

// Vérifier la connexion
if ($connection->connect_error) {
    die("Erreur de connexion à la base de données : " . $connection->connect_error);
}
$numeroRCommerce_fk = $specialite_demande = $service_stage = $nombrePdemande = $date_debut = $date_fin = "";
$errorMessage = $successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroRCommerce_fk = $_POST["numeroRCommerce_fk"];
    $specialite_demande = $_POST["specialite_demande"];
    $service_stage = $_POST["service_stage"];
    $nombrePdemande = $_POST["nombrePdemande"];
    $date_debut = $_POST["date_debut"];
    $date_fin = $_POST["date_fin"];
    $dataValid = true;

    
    $sql = "SELECT * FROM tab_identreprise WHERE numeroRCommerce = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $numeroRCommerce_fk);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        $dataValid = false;
        $errorMessage = "Le numéro de Registre Commerce saisi n'existe pas.";
    }

    
    if ($dataValid) {
        // Ajouter le stage à la base de données
        $sql = "INSERT INTO poste_stage (numeroRCommerce_fk, specialite_demande, service_stage, nombrePdemande, date_debut, date_fin) " .
            "VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $numeroRCommerce_fk, $specialite_demande, $service_stage, $nombrePdemande, $date_debut, $date_fin);
        $stmt->execute();

        // Vérifier si l'insertion a réussi
        if ($stmt->affected_rows > 0) {
            $successMessage = "Le stage a été ajouté avec succès.";
        } else {
            $errorMessage = "Erreur lors de l'ajout du stage : " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fermer la connexion
$connection->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<?php
    require_once('_header/script.php');
    require_once('_header/link.php');
    require_once('_header/meta.php');
    ?>
    <title>Créer des stage</title>
    
</head>
<body style="background:#000709e6; color:#fff;">
    <div  align="center" class="container my-5" >
    <div class="container my-5">
        <h2>new stage </h2>

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
                <label class="col-sm-3 col-form-label">numero RegidtreCommerce </label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="numeroRCommerce_fk" value="<?php echo $numeroRCommerce_fk;?> ">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">specialite_demande</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="specialite_demande" value="<?php echo $specialite_demande;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label"> $service_stage</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="service_stage" value="<?php echo $service_stage;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nombrePdemande</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" name="nombrePdemande" value="<?php echo $nombrePdemande;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">date_debut</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_debut" value="<?php echo $date_debut;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">date_fin</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_fin" value="<?php echo $date_fin;?>">
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
                <button type="submit" class="btn btn-primary">crée</button>
            </div>
                <div class="col-sm-3 d-grid">
                      <a class="btn btn-outline-primary" href="/firemen/index.php" role="button">cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>






            
            
           