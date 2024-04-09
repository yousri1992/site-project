        <?php
            session_start();
            include_once('_dbb/connexionDB.php');
            include_once('_class/inscriptionE.php');
            include_once('_class/inscriptionEN.php');
            include_once('_class/connexion.php');

            $_InscriptionE = new InscriptionE;
            $_InscriptionEN = new InscriptionEN;
            $_Connexion = new Connexion;
        ?>