<?php

require_once('include.php');
if (isset($_SESSION['ID_etudiant'])) {
    header("Location: /GLT/connexion.php");
                exit; 
}



if (!empty($_POST)) {
    extract($_POST);
    if (isset($_POST['inscription'])) {
        [$errorMessage] = $_InscriptionE->verification_Inscription($matriculeEtudiant, $nom, $prenom, $date_naissance, $lieu_naissance, $WILLAYA_residence, $univercite, $specialite, $email, $password, $password_confirm);
       
}
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <title>Créer un stagiaire</title>
    <?php
    require_once('_header/script.php');
    require_once('_header/link.php');
    require_once('_header/meta.php');
    ?>
</head>
<body style="background:#000709e6; color:#fff;">
    <div  align="center" class="container my-5" >
        <h1>S'inscrire</h1>

        <?php
        if (!empty($errorMessage)) {
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
                     <input type="number" class="form-control" name="matriculeEtudiant" value="<?php if (isset($matriculeEtudiant)) {echo $matriculeEtudiant;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom" value="<?php if (isset($nom)) {echo $nom;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prénom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenom" value="<?php if (isset($prenom)) {echo $prenom;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date de naissance</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="date_naissance" value="<?php if (isset($date_naissance)) {echo $date_naissance;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Lieu de naissance</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lieu_naissance" value="<?php if (isset($lieu_naissance)) {echo $lieu_naissance;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Wilaya de résidence</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="WILLAYA_residence" value="<?php if (isset($WILLAYA_residence)) {echo $WILLAYA_residence;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Université</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="univercite" value="<?php if (isset($univercite)) {echo $univercite;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Spécialité</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="specialite" value="<?php if (isset($specialite)) {echo $specialite;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php if (isset($email)) {echo $email;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Mot de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Confirmer le mot de passe</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" name="password_confirm" placeholder="Confirmez votre mot de passe">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" name="inscription" class="btn btn-primary">inscription</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/GLT/index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
