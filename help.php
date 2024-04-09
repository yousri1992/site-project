
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <title>help stalgerie</title>
    
    
    <?php
            
            require_once('_header/script.php');
            
            require_once('_header/meta.php');
        ?>

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
    <?php
            
            require_once('_menu/menu.php');
        ?>
                    <div class="search">
                <input class="srch" type="search" id="searchInput" name="" placeholder="Type To Text">
                <button type="button" class="btn" onclick="searchInParagraph()">Search</button>
            </div>
        
                    <div class="content">
                    <h1>MY FIRST</h1>
                        <span>STAGE</span>
                        <br>
                           <p class="paragraphe">HELP PAGE HOW TO USE STALGERIE</p>
                              
                             
                    </div>
                    
        
        
    </div>
    

    
    
    </form>
    <?php
            
            require_once('_footer/footer.php');
    ?> 
</body>
</html>