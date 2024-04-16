<?php
session_start();

if (isset($_GET["id_stage"]) && isset($_SESSION['matriculeEtudiant'])) {
    // Récupérer l'ID du stage depuis l'URL
    $id_stage = $_GET["id_stage"];
    $matricule_etudiant = $_SESSION['matriculeEtudiant'];

    // Vérifier si la confirmation a été confirmée
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "bd_stalgerie";
        $connection = new mysqli($servername, $username, $password, $database);

        // Vérifier la connexion
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Préparer la requête d'insertion
        $sql = "INSERT INTO tab_demande (matriculeEtudiant_fk, id_stage_fk) VALUES (?, ?)";
        $stmt = $connection->prepare($sql);

        // Vérifier si la préparation de la requête a réussi
        if ($stmt) {
            // Lier les paramètres et exécuter la requête
            $stmt->bind_param("ss", $matricule_etudiant, $id_stage);
            $stmt->execute();

          

            // Fermer la requête
            $stmt->close();
        }

        // Fermer la connexion
        $connection->close();

        // Rediriger vers la page d'accueil
        header("location: /GLT/lesstages.php");
        exit;
    } else {
        // Afficher un message de confirmation
        echo "
        <script>
        var confirmed = confirm('Êtes-vous sûr de vouloir ajouter cette demande ?');
        if (confirmed) {
            window.location.href = '/GLT/demande.php?id_stage=$id_stage&confirm=true';
        } else {
            window.location.href = '/GLT/index.php';
        }
        </script>
        ";
    }
}
?>