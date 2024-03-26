

    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>stage d etudiant</title>
    <script src="app.js"></script>
    <style>
        
    </style>
</head>
<body>
<form method="post">
    <div class="main">
        <div class="navbar">
            <div class="icon">  
                <h2 class="logo">STALGERIE</h2>    
            </div>
                   <div class="menu">
            
                        <ul >
                        <Li class="active"><a href="/firemen/accueil.php">HOME</a></Li>
                        <Li class="active"><a href="/firemen/about.php">ABOUT</a></Li>
                        <Li class="active"><a href="/firemen/service.php">SERVICE</a></Li>
                        <Li class="active"><a href="#">CONTACT</a></Li>
                        <Li class="active"><a href="#">HELP</a></Li>
                        
                        </ul>
                
                    </div>
                    
                    
        </div>
                    <div class="content">
                           <h1>lES STAGE</h1> <br> <span> DISPONIBLE</span>
                           <br>
                           <button class="btn1" href="/firemen/service.php" role="button"> LES STAGES</button>
                              <div class="form">
                        <h2>LOGIN </h2>
                        <input type="number" id="numMatricule_fk" name="numMatricule_fk" placeholder="ENTER MATRICULE HERE">
                        <input type="email" id="adressEmail" name="adressEmail" placeholder="ENTER EMAIL HERE">
                        <input type="password" id="mots_de_passe" name="mots_de_passe" placeholder="ENTER password HERE">
                        <form method="post" action="/GL/login.php">
                             <button type="submit" class="btn1" role="button">LOGIN</button>
                        </form>
                        <P>IF YOU HAVEN'T COUNT INSCRIRE PLEASE</P>
                        <form method="get" action="/GL/create.php">
                             <button type="submit" class="btn1" role="button">INSCRIPTION</button>
                        </form>
                        
        
    

                    </div>
                    </div>
                    
        
        
    </div>
    

    
    
    </form>
</body>
</html>