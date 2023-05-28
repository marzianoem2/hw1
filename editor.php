<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione inesistente
        header("Location: login.php");
        exit;
    }

    # connessione al database hw1
    $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    # conteggio del numero di articoli scritti dall'utente loggato
    $query = "SELECT count(*) FROM Articoli WHERE autore = '" . $_SESSION["id_utente"] . "'";
    $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $row = mysqli_fetch_row($results);

    mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BookLife - Scrivi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style_editor.css">
        <link rel="icon" href="logo.png" type="image/icon type">

        <!-- font per headings -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">

        <!-- font body -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

        <script src="editor.js" defer="true"></script>
    </head>
    
    <body>
        <nav>
            <div>
                <p class="left-arrow"></p>
                <a href="home_utente.php">Torna alla home</a>
            </div>
            
            <span>
                RICORDA DI SALVARE LA TUA RECENSIONE!
            </span>
        </nav>

        <section>
            <div class="first-c">
                <p>
                    Utente: @<?php echo $_SESSION["username"]; ?>
                </p>
                <p>
                    <em>Recensioni scritte:
                    <?php
                        echo $row[0];
                        echo "</em>";
                        if($row[0] == 0) {
                            echo "<p>";
                            echo "Divertiti a scrivere la tua prima recensione!";
                            echo "</p>";
                        }
                    ?>
                </p>
            </div>

            <div class="second-c">
                <form method="post" id="form-edit" name="form-edit" action="insertArticle.php">
                    <input type="text" id="titolo" name="titolo" placeholder="Inserire titolo...">
                    <textarea id="contenuto" placeholder="Scrivi la tua recensione..." maxlength="10000" name="contenuto"></textarea>

                    <input type="submit" value="Salva">
                    <span class="error"></span>
                </form>  
            </div>
        </section>
    </body>
</html>