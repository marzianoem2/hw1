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
        <title>BookLife - Home utente</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style_home_utente.css">
        <link rel="icon" href="logo.png" type="image/icon type">

         <!-- font booklife -->
         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mr+Dafoe&display=swap" rel="stylesheet">

        <!-- font per headings -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">

        <!-- font body -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

        <!-- icone -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <script src="home_utente.js" defer="true"></script>
    </head>

    <body>
        <header>
            <nav>  
                <p>
                    BookLife
                </p>  

                <div> 
                    <a href="home_utente.php">ACCOUNT</a>
                    <a href="editor.php">SCRIVI</a> 
                    <a href="suggerimenti.php">SUGGERIMENTI</a> 
                    <a href="ricerca_articoli.php">RECENSIONI</a>
                    <a href="logout.php" class="log-in-sign-up">Log out</a> 
                </div>

                <div id="menu-mobile" class="material-icons">menu</div>
            </nav>

            <div id="profile">
                <img src="profilo.png">
                <p>
                    <?php
                        if(isset($_SESSION["username"])) {
                            echo "@" . $_SESSION["username"];
                        }
                    ?>
                </p>
            </div>

            <div id="overlay"></div>
        </header>

        <section>
            <div class="col-1">
                <p class="p-title">
                    LIBRI SALVATI
                </p>
                <div></div>
            </div>
            <div class="col-2">
                <p class="p-title">
                    RECENSIONI SCRITTE
                </p>
                <div></div>
            </div>
        </section>
    </body>
</html>