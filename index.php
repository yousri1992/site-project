
<?php

require_once('include.php');
if (isset($_SESSION['ID_etudiant'])) {
    $var1 = "bonjour yousri" . $_SESSION['email'];
}else{
    $var1 = "bonjour a tous";
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>index </title>
    <link rel="stylesheet" href="style.css">
    
    
    
    <?php
            
            require_once('_header/script.php');
            require_once('_header/meta.php');

        ?>
</head>
<body>

    <form method="post">
        <div class="main">
        <?php
            
            require_once('_menu/menu.php');
        ?>
       
       
            <div class="content">
                <h1>LES STAGES</h1>
                <span>DISPONIBLE</span>
                <br>
                
            </div>
        </div>
    </form>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <?php
            
            require_once('_footer/footer.php');
    ?>    
</body>
</html>
