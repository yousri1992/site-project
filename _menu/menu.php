<?php
$var = "STALGERIE";
?>

<div class="navbar">
    <div class="icon">
        <h2 class="logo"><?php echo $var ?></h2>
    </div>
    <div class="menu">
        <ul>
            
            <?php
            if (!isset($_SESSION['ID_etudiant']) && !isset($_SESSION['ID_entreprise'])) {
            ?>
                <li class="active"><a href="/GLT/connexion.php">CONNEXION/INSCRIPTION</a></li>
            <?php
            } else {
            ?>
                <li class="active"><a href="/GLT/deconnexion.php">DECONNEXION</a></li>
            <?php
            }
            ?>
            <li class="active"><a href="/GLT/about.php">ABOUT</a></li>
            <li class="active"><a href="/GLT/contact.php">CONTACT</a></li>
            <li class="active"><a href="/GLT/help.php">HELP</a></li>
        </ul>
    </div>
</div>

<div class="content">
    <?php
    if (isset($_SESSION['ID_etudiant']) || isset($_SESSION['ID_entreprise'])) {
    ?>
        


        <a class="btn2" href="/GLT/lesstages.php" role="button">
    <?php
    if (isset($_SESSION['ID_etudiant'])) {
        echo "LES STAGES";
    }
    
    ?>
</a>



        <a class="btn2" href="/GLT/voirEditDelite.php" role="button">
    <?php
    if (isset($_SESSION['ID_entreprise'])) {
        echo "CREE UN STAGE";
    }
    
    ?>
</a>

<a class="btn2" href="/GLT/afficherDemande.php" role="button">
    <?php
   
    if (isset($_SESSION['ID_entreprise'])) {
        echo "LES DEMANDES ";
    }
    ?>
</a>


    <?php
    }
    ?>
</div>
