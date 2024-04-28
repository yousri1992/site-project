<?php
session_start();
require_once('_header/script.php');
require_once('_header/meta.php');
require_once('_header/link.php');

if (isset($_SESSION['ID_entreprise'])) {
    $id_entreprise = $_SESSION['ID_entreprise'];
   
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd_stalgerie";
    
    // Créer une connexion
    $connection = new mysqli($servername, $username, $password, $database);
    // Vérifier la connexion
    if ($connection->connect_error) {
        die("La connexion a échoué : " . $connection->connect_error);
    }
    
    // Requête SQL pour récupérer les demandes des étudiants liées aux postes de stage créés par l'entreprise avec la session ouverte
    $sql = "SELECT
    td.id_demande, 
    ti.nom,
    ti.prenom,
    ti.date_naissance,
    ti.WILLAYA_residence,
    ti.specialite AS 'specialite d etude',
    ps.specialite_demande AS 'la specialite demande',
    ti.email,
    td.date_demande,
    ps.date_debut,
    ps.date_fin,
    td.etat_demande
FROM 
    tab_demande td
JOIN 
    tab_idetudiant ti ON td.matriculeEtudiant_fk = ti.matriculeEtudiant
JOIN 
    poste_stage ps ON td.id_stage_fk = ps.id_stage
JOIN
    tab_identreprise ie ON ps.numeroRCommerce_fk = ie.numeroRCommerce
WHERE
    ps.numeroRCommerce_fk = ?";
           

    
    // Préparation de la requête SQL
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        // Lier les paramètres et exécuter la requête
        $stmt->bind_param("i", $id_entreprise);
        $stmt->execute();

        // Résultat de la requête
        $result = $stmt->get_result();
    
        // Vérification s'il y a des résultats
        if ($result->num_rows > 0) {
            // Affichage des résultats
?>
            <title>Liste des DEMANDE</title>
        </head>
        <body>

            <div class="container my-5">
                <h2>Liste demandes</h2>
                <br>
                <table class="table">
                    <thead> 
                        <tr>
                            <th>id</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de naissance</th>
                            <th>Wilaya de résidence</th>
                            <th>Spécialité d'étude</th>
                            <th>La spécialité demandée</th>
                            <th>Email</th>
                            <th>Date de demande</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Actions1</th>
                            <th>Actions2</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
            while ($row = $result->fetch_assoc()) {
                // Afficher les données dans le tableau
                $etat_demande = $row['etat_demande'];
?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_demande']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_naissance']); ?></td>
                            <td><?php echo htmlspecialchars($row['WILLAYA_residence']); ?></td>
                            <td><?php echo htmlspecialchars($row['specialite d etude']); ?></td>
                            <td><?php echo htmlspecialchars($row['la specialite demande']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_demande']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_debut']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_fin']); ?></td>
                            <td>
                            
                        <?php
                                $id_demande = $row['id_demande'];
                                echo "<a class='btn btn-success' href='/GLT/laReponce.php?id_demande=$id_demande'>confirmer</a>";
                                if ($etat_demande == 1 ) {
                                    echo "<span class='text-danger'>Vous avez déjà rCONFIRMER.</span>";
                                }
                                   
                            ?>

                            </td>
                            <td>
                            <?php
                                $id_demande = $row['id_demande'];
                                    
                                    echo "<a class='btn btn-danger' href='/GLT/laReponce.php?id_demande=$id_demande'>ANNULER</a>";
                                    if ($etat_demande == 2) {
                                        echo "<span class='text-danger'>Vous avez déjà ANNULER.</span>";
                                    }
                            ?>                            </td>

                       
                        </tr>
<?php
            }
?>
                    </tbody>
                </table>
            </div>
        </body>
    </html>
<?php
        } else {
            echo "Aucune demande trouvée pour vous.";
        }

        // Fermer la requête
        $stmt->close();
    }

    // Fermeture de la connexion
    $connection->close();
}
?>