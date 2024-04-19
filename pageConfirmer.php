<?php
session_start();

// Vérifier si l'identifiant de la demande est présent dans la requête GET et si l'utilisateur est connecté
if (isset($_GET['id_demande']) && isset($_SESSION['ID_entreprise'])) {
    $id_demande = $_GET['id_demande'];
    $matricule_entreprise = $_SESSION['ID_entreprise'];

    // Vérifier si la confirmation a été confirmée
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "bd_stalgerie";
        $connection = new mysqli($servername, $username, $password, $database);

        // Vérifier la connexion à la base de données
        if ($connection->connect_error) {
            die("La connexion a échoué : " . $connection->connect_error);
        }

        $sql_update = "UPDATE tab_demande SET etat_demande = 1 WHERE id_demande = ?";
$stmt = $connection->prepare($sql_update);

// Vérifier si la préparation de la requête a réussi
if ($stmt) {
    // Liaison des paramètres et exécution de la requête
    $stmt->bind_param("i", $id_demande); 
    $stmt->execute();
    $stmt->close();
} else {
    echo "Erreur lors de la préparation de la requête.";
}

        // Fermeture de la connexion à la base de données
        $connection->close();
        
        // Redirection vers la page d'affichage des demandes après la confirmation
        header("location: /GLT/leDocier.php");
        exit;
    } else {
        // Afficher un message de confirmation
        echo "
        <script>
        var confirmed = confirm('Êtes-vous sûr de vouloir ajouter cette demande ?');
        if (confirmed) {
            window.location.href = '/GLT/pageConfirmer.php?id_demande=$id_demande&confirm=true';
        } else {
            window.location.href = '/GLT/index.php';
        }
        </script>
        ";
    }
}
?>
