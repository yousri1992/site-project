<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="style.css">
    <?php
            
            require_once('_header/script.php');
            require_once('_header/meta.php');

        ?>
    <title>choix inscreption</title>
    
    <style> </style>
</head>
<body>
<form method="post">
    <div class="mainCI">
    <?php
            
            require_once('_menu/menu.php');
        ?>
        <div >
  


        <table  class="table">
        <h2  class = "titre" >who are you</h2>
          <thead>
                <tr>
                    <th>ETUDIANT </th>	
                    <th button type="button" class="btn2" onclick="window.location.href='/GLT/inscriptionE.php'">INSCRIPTION</button></th>

                </tr>	
                <tr>
                    <th>ENTREPRISE</th>
                    <th button type="button" class="btn2" onclick="window.location.href='/GLT/inscriptionEN.php'">INSCRIPTION</button></th>

                </tr>	
                
               
            </thead>   
            
                 
                
            </tbody>
        </table>
            </div>
                    
        
        
    </div>
    

    
    
    </form>
</body>
</html>