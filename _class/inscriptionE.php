<?php
    class InscriptionE {
        private $isValid;
        private $errorMessage;
        private $matriculeEtudiant; 
        private $nom;
        private $prenom;
        private $date_naissance;
        private $lieu_naissance;
        private $WILLAYA_residence;
        private $univercite;
        private $specialite;
        private $email;
        private $password;
        private $password_confirm; 

        

        public function verification_Inscription($matriculeEtudiant, $nom, $prenom, $date_naissance, $lieu_naissance, $WILLAYA_residence, $univercite, $specialite, $email, $password, $password_confirm){
                         global $DB;
                        $matriculeEtudiant = trim($matriculeEtudiant);
                        $nom = trim($nom);
                        $prenom = trim($prenom);
                        $date_naissance = trim($date_naissance);
                        $lieu_naissance = trim($lieu_naissance);
                        $WILLAYA_residence = trim($WILLAYA_residence);
                        $univercite = trim($univercite);
                        $specialite = trim($specialite);
                        $email = trim($email);
                        $password = trim($password);
                        $password_confirm = trim($password_confirm); 
            $this->isValid = true;
    
            if (empty($matriculeEtudiant) || empty($nom) || empty($prenom) || empty($date_naissance) || empty($lieu_naissance) || empty($WILLAYA_residence) || empty($univercite) || empty($specialite) || empty($email) || empty($password)) {
                $this->isValid = false;
                $this->errorMessage = "Tous les champs sont obligatoires.";
            } else {
                $req = $DB->prepare("SELECT ID_etudiant  FROM tab_idetudiant WHERE matriculeEtudiant = ?");
                $req->execute(array($matriculeEtudiant));



                $req = $req->fetch();
                if (isset($req['ID_etudiant'])) {
                    $this->isValid = false;
                    $this->errorMessage = "Le matricule est déjà pris.";
                }
            }
            if ($password !== $password_confirm) {
                $this->isValid = false;
                $this->errorMessage = "Le mot de passe et sa confirmation ne correspondent pas.";
            }elseif(strlen($password)<6){
                $this->isValid= false;
                $this->errorMessage = "le mots de passe doit faire plus de 6 caracteres";
            }
    
            if (empty($matriculeEtudiant) || empty($nom) || empty($prenom) || empty($date_naissance) || empty($lieu_naissance) || empty($WILLAYA_residence) || empty($univercite) || empty($specialite) || empty($email) || empty($password)) {
                $this->isValid = false;
                $this->errorMessage = "Tous les champs sont obligatoires.";
            } else {
                $req = $DB->prepare("SELECT ID_etudiant  FROM tab_idetudiant WHERE email = ?");
                $req->execute(array($email));
                $req = $req->fetch();
                if (isset($req['ID_etudiant'])) {
                    $this->isValid = false;
                    $this->errorMessage = "L email est déjà pris.";
                }
            }
    
            if ($this->isValid) {
                // Hashage du mot de passe
                $crypt_password = password_hash($password, PASSWORD_ARGON2ID);
    
                // Date de création
                $date_creation = date('Y-m-d H:i:s');
    
                // Insertion dans la base de données
                $req = $DB->prepare("INSERT INTO tab_idetudiant(matriculeEtudiant, nom, prenom, date_naissance, lieu_naissance, WILLAYA_residence, univercite, specialite, email, mdp, date_creation, date_connexion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                if ($req->execute([$matriculeEtudiant, $nom, $prenom, $date_naissance, $lieu_naissance, $WILLAYA_residence, $univercite, $specialite, $email, $crypt_password, $date_creation, $date_creation])) {
                    // Redirection après l'inscription réussie
                    header("Location: /GLT/index.php");
                    exit;
                } else {
                    $this->isValid =false;
                    $this->errorMessage =  "Une erreur s est produite lors de l inscription Veuillez réessayer.";
                }
        }
        return [$this->errorMessage];
        }
    }
?>
