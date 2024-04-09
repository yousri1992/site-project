<?php
class InscriptionEN {
    private $isValid;
    private $errorMessage;
    private $numeroRCommerce; 
    private $nom_Entreprise;
    private $directeur_General;
    private $produits_Comercialises;
    private $siege_Social;
    private $willaya;
    private $email;
    private $password;
    private $password_confirm; 

    public function verification_Inscription($numeroRCommerce, $nom_Entreprise, $directeur_General, $produits_Comercialises, $siege_Social, $willaya, $email, $password, $password_confirm) {
        global $DB;
        $numeroRCommerce = trim($numeroRCommerce);
        $nom_Entreprise = trim($nom_Entreprise);
        $directeur_General = trim($directeur_General);
        $produits_Commercialises = trim($produits_Comercialises);
        $siege_Social = trim($siege_Social);
        $willaya = trim($willaya);
        $email = trim($email);
        $password = trim($password);
        $password_confirm = trim($password_confirm); 

        $this->isValid = true;

        if (empty($numeroRCommerce) || empty($nom_Entreprise) || empty($directeur_General) || empty($produits_Comercialises) || empty($siege_Social) || empty($willaya)  || empty($email) || empty($password)) {
            $this->isValid = false;
            $this->errorMessage = "Tous les champs sont obligatoires.";
        } else {
            $req = $DB->prepare("SELECT ID_entreprise FROM tab_identreprise WHERE numeroRCommerce = ?");
            $req->execute(array($numeroRCommerce));
            $req = $req->fetch();
            if (isset($req['ID_entreprise'])) {
                $this->isValid = false;
                $this->errorMessage = "Le numéro de registre de commerce est déjà pris.";
            }
        }

        if ($password !== $password_confirm) {
            $this->isValid = false;
            $this->errorMessage = "Le mot de passe et sa confirmation ne correspondent pas.";
        } elseif (strlen($password) < 6) {
            $this->isValid = false;
            $this->errorMessage = "Le mot de passe doit contenir au moins 6 caractères.";
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->isValid = false;
            $this->errorMessage = "L'adresse email est invalide.";
        } else {
            $req = $DB->prepare("SELECT ID_entreprise FROM tab_identreprise WHERE email = ?");
            $req->execute(array($email));
            $req = $req->fetch();
            if (isset($req['ID_entreprise'])) {
                $this->isValid = false;
                $this->errorMessage = "L'adresse email est déjà prise.";
            }
        }

        if ($this->isValid) {
            $crypt_password = password_hash($password, PASSWORD_ARGON2ID);
            $date_creation = date('Y-m-d H:i:s');
            $req = $DB->prepare("INSERT INTO tab_identreprise(numeroRCommerce, nom_Entreprise, directeur_General, produits_Comercialises, siege_Social, willaya, email, mdp, date_creation, date_connexion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($req->execute([$numeroRCommerce, $nom_Entreprise, $directeur_General, $produits_Comercialises, $siege_Social, $willaya, $email, $crypt_password, $date_creation, $date_creation])) {
                header("Location: /GLT/index.php");
                exit;
            } else {
                $this->isValid = false;
                $this->errorMessage = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
            }
        }
        return [$this->errorMessage];
    }
}
?>
