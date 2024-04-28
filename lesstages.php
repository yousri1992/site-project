<?php
session_start();
require_once('_header/script.php');
require_once('_header/meta.php');
require_once('_header/link.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Liste des stages</title>
</head>
<body>
    <div class="container my-5">
        <h2>Liste des stages disponibles</h2>
        <br>
        <table class="table">
            <thead>
                <tr> 
                    <th>LA SOCIETE</th>	
                    <th>Spécialité demandée</th>
                    <th>Service du stage</th>
                    <th>Nombre de stagiaires demandés</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Date de création</th>
                    <th>Actions</th>						
                </tr>
            </thead>
            <tbody>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "bd_stalgerie";
                // create connection
                $connection = new mysqli($servername, $username, $password, $database);
                // CHECK CONNECTION
                if ($connection->connect_error) {
                    die("connection failed" . $connection->connect_error);
                }
                // READ ALL ROW FROM DATABASE TABLE poste stage
                $sql = "SELECT tab_identreprise.nom_Entreprise, poste_stage.*, tab_demande.etat_demande 
                FROM poste_stage
                INNER JOIN tab_identreprise ON poste_stage.numeroRCommerce_fk = tab_identreprise.numeroRCommerce
                LEFT JOIN tab_demande ON tab_demande.id_stage_fk = poste_stage.id_stage";
                $result = $connection->query($sql);
                if (!$result) {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                // READ DATA OF EACH ROW 
                while ($row = $result->fetch_assoc()) {
            ?>                  

                <tr>	
                    <td><?php echo htmlspecialchars($row['nom_Entreprise']); ?></td>
                    <td><?php echo htmlspecialchars($row['specialite_demande']); ?></td>
                    <td><?php echo htmlspecialchars($row['service_stage']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombrePdemande']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_debut']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_fin']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_creation']); ?></td>							
                    <td>
                    <?php
                                // Vérifier si une demande existe déjà pour ce stage et cet utilisateur
                                $id_stage = $row['id_stage'];
                                $sql_check = "SELECT * FROM tab_demande WHERE matriculeEtudiant_fk = '{$_SESSION['matriculeEtudiant']}' AND id_stage_fk = '$id_stage'";
                                $result_check = $connection->query($sql_check);
                                if ($result_check->num_rows > 0) {
                                    
                                        $etat_demande = $row['etat_demande'];
                                        if ($etat_demande == 0) {
                                            echo "<span class='text-danger'>Vous avez déjà demandé ce stage. Attendez la réponse de l'entreprise.</span>";
                                        } elseif ($etat_demande == 1) {
                                            echo "<a class='btn btn-success' href='/GLT/reponseConfirmer.php'>Votre demande est acceptée</a>";
                                        } elseif ($etat_demande == 2) {
                                            echo "<a class='btn btn-danger' href='/GLT/reponseAnnuler.php'>Votre demande est annulée</a>";
                                        } 
                                }else {
                                    // Afficher le bouton de demande
                                    echo "<a class='btn btn-primary btn-sm' href='/GLT/demande.php?id_stage=$id_stage'>demander</a>";
                                }
                            ?>
                        
                    </td>
                </tr>

            <?php
                }
            ?>
            </tbody>
        </table>
        <a class="btn btn-outline-primary" href="/GLT/index.php" role="button">RETOUR</a>
    </div>
</body>
</html>
