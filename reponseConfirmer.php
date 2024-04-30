<!DOCTYPE html>
<html lang="fr">
<head>
    
    <title>Réponse </title>
    <?php require_once('_header/script.php'); ?>
    <?php require_once('_header/link.php'); ?>
    <?php require_once('_header/meta.php'); ?>
</head>
    
<body style="background:#000709e6; color:#fff;">
    <div align="center" class="container my-5">
        <h1>Réponse </h1>
        <?php
        // Votre code PHP ici
        session_start();

        // Vérifier si l'identifiant de l'étudiant est présent dans la session
        if (isset($_SESSION['ID_etudiant'])) {
            // Récupérer l'identifiant de l'étudiant de la session
            $id_etudiant = $_SESSION['ID_etudiant'];
            

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

                // Requête SQL pour sélectionner la réponse de l'étudiant
                $sql = "SELECT d.*, e.nom_Entreprise     
                    FROM tab_demande d  
                    INNER JOIN tab_idetudiant i ON i.matriculeEtudiant = d.matriculeEtudiant_fk 
                    INNER JOIN poste_stage s ON s.id_stage = d.id_stage_fk 
                    INNER JOIN tab_identreprise e ON e.numeroRCommerce = s.numeroRCommerce_fk
                    WHERE i.ID_etudiant = ? AND d.etat_demande = 1";
                
                // Préparation de la requête
                $stmt = $connection->prepare($sql);

                // Vérifier si la préparation de la requête a réussi
                if ($stmt) {
                    // Liaison des paramètres et exécution de la requête
                    $stmt->bind_param("i", $id_etudiant); 
                    $stmt->execute();
                    
                    // Récupération du résultat de la requête
                    $result = $stmt->get_result();
                    
                    // Vérification s'il y a des résultats
                    if ($result->num_rows > 0) {
                        // Récupérer la première ligne de résultat
                        while ($row = $result->fetch_assoc()) {

                        // Afficher la réponse de l'étudiant
                        echo "<table class='table'>
                        <thead>
                            <tr>
                                <th>nom_Entreprise</th>
                                <th>reponseAnnuler</th>
                                <th>date_demande</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>" . htmlspecialchars($row['nom_Entreprise']) . "</td>
                                <td>" . htmlspecialchars($row['reponseAnnuler']) . "</td> 
                                <td>" . htmlspecialchars($row['date_demande']) . "</td>
                            </tr>
                        </tbody>
                    </table>";
                        }
                    } else {
                        echo "Aucune donnée trouvée.";
                    }
                    
                    // Fermer le statement
                    $stmt->close();
                } else {
                    echo "Erreur lors de la préparation de la requête.";
                }

                // Fermer la connexion à la base de données
                $connection->close();
            } else {
                // Afficher un message de confirmation
                echo "
                <script>
                    if (confirm('Êtes-vous sûr de vouloir ajouter cette demande ?')) {
                        window.location.href = '/GLT/reponseConfirmer.php?confirm=true';  
                    } else {
                        window.location.href = '/GLT/index.php';
                    }
                </script>";
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
