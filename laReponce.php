<?php



// Vérifier si l'identifiant de demande est défini dans l'URL
if (isset($_GET['id_demande'])) {
    $id_demande = $_GET['id_demande'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier si les données du formulaire sont présentes
        if (isset($_POST['reponseAnnuler'])) {
            // Récupérer les données du formulaire
            $reponseAnnuler = $_POST['reponseAnnuler'];

            // Connexion à la base de données
            $connection = new mysqli("localhost", "root", "", "bd_stalgerie");

            // Vérifier la connexion à la base de données
            if ($connection->connect_error) {
                die("La connexion a échoué : " . $connection->connect_error);
            }

            // Préparation de la requête SQL d'UPDATE
            $sql_update = "UPDATE tab_demande SET reponseAnnuler = ? WHERE id_demande = ?";

            $stmt = $connection->prepare($sql_update);

            // Vérifier si la préparation de la requête a réussi
            if ($stmt) {
                // Liaison des paramètres et exécution de la requête
                $stmt->bind_param("si", $reponseAnnuler, $id_demande); // "s" pour une chaîne de caractères, "i" pour un entier
                $stmt->execute();
                $stmt->close();

                // Redirection vers une autre page ou affichage d'un message de succès
                header("Location: /GLT/pageConfirmer.php");
                exit;
            } else {
                echo "Erreur lors de la préparation de la requête.";
            }

            // Fermeture de la connexion à la base de données
            $connection->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Écrire une réponse</title>
    <?php require_once('_header/script.php'); ?>
    <?php require_once('_header/link.php'); ?>
    <?php require_once('_header/meta.php'); ?>
</head>
<body style="background:#000709e6; color:#fff;">
    <div align="center" class="container my-5">
        <h1>Écrire une réponse</h1>
        
        <!-- Formulaire pour écrire la réponse -->
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Réponse</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="reponseAnnuler" value="<?php if (isset($reponseAnnuler)) {echo htmlspecialchars($reponseAnnuler);}?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-6">
                    <button type="submit" name="submit" class="btn btn-primary">Soumettre</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    echo "L'identifiant de demande n'est pas défini.";
}
?>
