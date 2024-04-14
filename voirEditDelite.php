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
        <a class="btn btn-success" href="/GLT/creeStage.php" role="button">Nouveau stage</a>
        <br><br>
        <table class="table">
            <thead>
                <tr> 
                    <th>ID du stage</th>
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
                // Create connection
                $connection = new mysqli($servername, $username, $password, $database);
                // Check connection
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                }
                
                $sql = "SELECT * FROM poste_stage
        INNER JOIN tab_identreprise ON poste_stage.numeroRCommerce_fk = tab_identreprise.numeroRCommerce
        WHERE tab_identreprise.ID_entreprise = ?";
               	 
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("i", $_SESSION['ID_entreprise']);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$result) {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }
                // Read data of each row 
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>	
                        <td><?php echo htmlspecialchars($row['id_stage']); ?></td>
                        <td><?php echo htmlspecialchars($row['specialite_demande']); ?></td>
                        <td><?php echo htmlspecialchars($row['service_stage']); ?></td>
                        <td><?php echo htmlspecialchars($row['nombrePdemande']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_debut']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_fin']); ?></td>
                        <td><?php echo htmlspecialchars($row['date_creation']); ?></td>							
                        <td>
                            <a class='btn btn-primary btn-sm' href='/GLT/edit.php?id_stage=<?php echo $row['id_stage']; ?>'>Modifier</a>
                            <a class='btn btn-danger btn-sm' href='/GLT/delete.php?id_stage=<?php echo $row['id_stage']; ?>'>Supprimer</a>
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
