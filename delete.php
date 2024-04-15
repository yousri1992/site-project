<?php
if (isset($_GET["id_stage"])) {
    $id_stage = $_GET["id_stage"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "bd_stalgerie";

    // create connection
    $connection = new mysqli($servername, $username, $password, $database);

    // Check if the user has confirmed the deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        // Use prepared statement to delete the entry
        $sql = "DELETE FROM poste_stage WHERE id_stage = ?";
        $stmt = $connection->prepare($sql);
        
        // Bind the parameter
        $stmt->bind_param("s", $id_stage);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the statement
        $stmt->close();

        // Redirect to the index page
        header("location: /GLT/voirEditDelite.php");
        exit;
    }

    // Display a confirmation message
    echo "
    <script>
    var confirmed = confirm('Are you sure you want to delete this entry?');
    if (confirmed) {
        window.location.href = '/GLT/delete.php?id_stage=$id_stage&confirm=true';
    } else {
        window.location.href = '/GLT/voirEditDelite.php';
    }
</script>
    ";
}
?>