<?php 
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione non esistente
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BookLife - Suggerimenti</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style_suggerimenti.css">
        <link rel="icon" href="logo.png" type="image/icon type">

        <!-- font per headings -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">

        <!-- font body -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

        <!-- icona di ricerca del bottone nel form -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        <script src="suggerimenti.js" defer="true"></script>
    </head>
    <body>
        <nav>
            <div>
                <p class="left-arrow"></p>
                <a href="home_utente.php">Torna alla home</a>
            </div>
            
            <span>
                CERCA SUGGERIMENTI PER I TUOI LIBRI!
            </span>
        </nav>

        <section>
            <div id="search-bar">
                <form name="form-search" id="form-search" method="post">
                    <input type="search" name="search" placeholder="Cerca una parola chiave/un titolo...">
                    <button type="submit" class="material-icons">search</button> 
                    <!-- l'uso di button type submit e input type submit è analogo, cambia che il button può avere un content, mentre l'input ha null -->
                </form>
            </div>

            <div class="hidden">
                <span class="err hidden">
                    Digitare una ricerca
                </span>
                
                <ol class="list"></ol>
            </div>
        </section>
    </body>
</html>