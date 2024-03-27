<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>about stalgerie</title>
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
    <div class="mainA">
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
                           <p class="paragraphe">This website was created by a group of students for the purpose of facilitating the search for training opportunities before completing their studies
The site allows students to find a company willing to train students and benefit from their knowledge
  It also allows students to gain sufficient experience in the field of work and the jobs available after graduation
The site also allows for bringing together companies in the field of manufacturing and students in the field of research
The site reduces the obstacles present in the departments and connects the student directly to the users’ office or the training office
During the training experience, the company builds a CV about the student through the website with the company’s seal and saves it in the database in case the company needs recruiters.</p>
                              
                             
                    </div>
                    
        
        
    </div>
    

    
    
    </form>
  
</body>
</html>