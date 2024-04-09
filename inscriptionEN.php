<?php

require_once('include.php');
if (isset($_SESSION['ID_entreprise'])) {
    header("Location: /GLT/connexion.php");
                exit; 
}



if (!empty($_POST)) {
    extract($_POST);
    if (isset($_POST['inscription'])) {
        [$errorMessage] = $_InscriptionEN->verification_Inscription($numeroRCommerce, $nom_Entreprise, $directeur_General, $produits_Comercialises, $siege_Social, $willaya, $email, $password, $password_confirm);
       
}
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>

    <title>Créer une entreprise</title>
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
                <label class="col-sm-3 col-form-label">numero Registre Commerce </label>
                <div class="col-sm-6">
                     <input type="number" class="form-control" name="numeroRCommerce" value="<?php if (isset($numeroRCommerce)) {echo $numeroRCommerce;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">nom Entreprise</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom_Entreprise" value="<?php if (isset($nom_Entreprise)) {echo $nom_Entreprise;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">directeur General</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="directeur_General" value="<?php if (isset($directeur_General)) {echo $directeur_General;}?>">
                </div>
            </div> 
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">produits Comercialises</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="produits_Comercialises" value="<?php if (isset($produits_Comercialises)) {echo $produits_Comercialises;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">siege Social</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="siege_Social" value="<?php if (isset($siege_Social)) {echo $siege_Social;}?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">willaya</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="willaya" value="<?php if (isset($willaya)) {echo $willaya;}?>">
                </div>
            </div>
            <div class="row mb-3">
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
