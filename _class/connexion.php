<?php 
    class Connexion {
        private $isValid;
        private $errorMessage;
        
        public function verification_connexionE($email, $password){
            global $DB;
            $email = trim($email);
            $password = trim($password);

            $this->isValid = true;

            if (empty($email) || empty($password)) {
                $this->isValid = false;
                $this->errorMessage = "Tous les champs sont obligatoires.";
            } 

            if ($this->isValid) {
                $req = $DB->prepare("SELECT mdp FROM tab_idetudiant WHERE email = ?");
                $req->execute(array($email));
                $req = $req->fetch();
                if (isset($req['mdp'])) {
                    if (!password_verify($password, $req['mdp'])) {
                        $this->isValid = false;
                        $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                    }
                } else {
                    $this->isValid = false;
                    $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                }
            }

            if ($this->isValid) {
                $req = $DB->prepare("SELECT * FROM tab_idetudiant WHERE email = ?");
                $req->execute(array($email));
                $req_user = $req->fetch();
                if (isset($req_user['ID_etudiant'])) {
                    $date_connexion = date('Y-m-d H:i:s');
                    $req = $DB->prepare("UPDATE tab_idetudiant SET date_connexion = ? WHERE ID_etudiant = ?");
                    $req->execute(array($date_connexion, $req_user['ID_etudiant']));
                    
                    $_SESSION['ID_etudiant'] = $req_user['ID_etudiant'];
                    $_SESSION['matriculeEtudiant'] = $req_user['matriculeEtudiant'];
                    $_SESSION['nom'] = $req_user['nom'];
                    $_SESSION['prenom'] = $req_user['prenom'];
                    $_SESSION['date_naissance'] = $req_user['date_naissance'];
                    $_SESSION['lieu_naissance'] = $req_user['lieu_naissance'];
                    $_SESSION['WILLAYA_residence'] = $req_user['WILLAYA_residence'];
                    $_SESSION['univercite'] = $req_user['univercite'];
                    $_SESSION['specialite'] = $req_user['specialite'];
                    $_SESSION['email'] = $req_user['email'];
                    $_SESSION['role'] = $req_user['role'];
                    
                    header("Location: /GLT/index.php");
                    exit;
                } else {
                    $this->isValid = false;
                    $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                }
            } 
            return [$this->errorMessage];
        }
        
        public function verification_connexionEN($email, $password){
            global $DB;
            $email = trim($email);
            $password = trim($password);

            $this->isValid = true;

            if (empty($email) || empty($password)) {
                $this->isValid = false;
                $this->errorMessage = "Tous les champs sont obligatoires.";
            } 

            if ($this->isValid) {
                $req = $DB->prepare("SELECT mdp FROM tab_identreprise WHERE email = ?");
                $req->execute(array($email));
                $req = $req->fetch();
                if (isset($req['mdp'])) {
                    if (!password_verify($password, $req['mdp'])) {
                        $this->isValid = false;
                        $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                    }
                } else {
                    $this->isValid = false;
                    $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                }
            }

            if ($this->isValid) {
                $req = $DB->prepare("SELECT * FROM tab_identreprise WHERE email = ?");
                $req->execute(array($email));
                $req_user = $req->fetch();
                if (isset($req_user['ID_entreprise'])) {
                    $date_connexion = date('Y-m-d H:i:s');
                    $req = $DB->prepare("UPDATE tab_identreprise SET date_connexion = ? WHERE ID_entreprise = ?");
                    $req->execute(array($date_connexion, $req_user['ID_entreprise']));
                    
                    $_SESSION['ID_entreprise'] = $req_user['ID_entreprise']; 
                    $_SESSION['numeroRCommerce'] = $req_user['numeroRCommerce'];
                    $_SESSION['nom_Entreprise'] = $req_user['nom_Entreprise'];
                    $_SESSION['directeur_General'] = $req_user['directeur_General'];
                    $_SESSION['produits_Commercialises'] = $req_user['produits_Commercialises'];
                    $_SESSION['siege_Social'] = $req_user['siege_Social'];
                    $_SESSION['willaya'] = $req_user['willaya'];  
                    $_SESSION['email'] = $req_user['email'];
                    $_SESSION['role'] = $req_user['role'];
                    
                    header("Location: /GLT/index.php");
                    exit;
                } else {
                    $this->isValid = false;
                    $this->errorMessage = "La combinaison du email / mot de passe est incorrecte";
                }
            } 
            return [$this->errorMessage];
        }
    }
?>
