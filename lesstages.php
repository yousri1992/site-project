<!DOCTYPE html>
<html lang="en">
<head>
<?php
session_start();
require_once('_header/script.php');
require_once('_header/meta.php');
require_once('_header/link.php');
?>
<title>Liste des stages</title>
</head>
<body>
    <div class="container my-5">
        <h2>Liste des stages</h2>
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
                $sql = "SELECT tab_identreprise.nom_Entreprise, poste_stage.* FROM poste_stage
        INNER JOIN tab_identreprise ON poste_stage.numeroRCommerce_fk = tab_identreprise.numeroRCommerce";

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
                            <a class='btn btn-primary btn-sm' href='/GLT/edit.php?id_stage=<?php echo $row['id_stage']; ?>'>INSCRIRE</a>
                            
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>





    
     
      