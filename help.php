<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>help stalgerie</title>
    <script src="app.js"></script>
    <script>
        function searchInParagraph() {
            var searchTerm = document.getElementById("searchInput").value.toLowerCase();
            var paragraphText = document.querySelector('.paragraphe').innerText.toLowerCase();
            var foundIndex = paragraphText.indexOf(searchTerm);

            if (foundIndex !== -1) {
                var foundText = document.querySelector('.paragraphe').childNodes[0].splitText(foundIndex + searchTerm.length);
                var range = document.createRange();
                range.setStart(document.querySelector('.paragraphe').childNodes[0], foundIndex);
                range.setEnd(foundText, 0);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(range);
                document.querySelector('.paragraphe').scrollIntoView({ behavior: "smooth", block: "start", inline: "nearest" });
            } else {
                alert("Word not found in the paragraph.");
            }
        }
    </script>
    <style>
        
    </style>
</head>
<body>
<form method="post">
    <div class="mainH">
        <div class="navbar">
        <div class="icon">  
                <h2 class="logo">STALGERIE</h2>    
            </div>
                   <div class="menu">
            
                        <ul >
                        <Li class="active"><a href="/GL/index.php">HOME</a></Li>
                        <Li class="active"><a href="/GL/about.php">ABOUT</a></Li>
                        <Li class="active"><a href="/GL/contact.php">CONTACT</a></Li>
                        <Li class="active"><a href="/GL/help.php">HELP</a></Li>
                        </ul>
                
                    </div>
                    <div class="search">
                <input class="srch" type="search" id="searchInput" name="" placeholder="Type To Text">
                <button type="button" class="btn" onclick="searchInParagraph()">Search</button>
            </div>
        </div>
                    <div class="content">
                    <h1>LES STAGES</h1><br><span>DISPONIBLE</span>
                           <p class="paragraphe">HELP PAGE HOW TO USE STALGERIE</p>
                              
                             
                    </div>
                    
        
        
    </div>
    

    
    
    </form>
  
</body>
</html>