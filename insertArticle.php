<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione non esistente
        header("Location: login.php");
        exit;
    }

    #connessione al db
    $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    if(isset($_POST["titolo"]) && isset($_POST["contenuto"])) {
        # ciò che ha inserito l'utente
        $titolo = mysqli_real_escape_string($connection, $_POST["titolo"]);
        $contenuto = mysqli_real_escape_string($connection, $_POST["contenuto"]);

        $query = "INSERT INTO Articoli(titolo, contenuto, autore) VALUES ('" . $titolo . "', '" . $contenuto . "', '" . $_SESSION["id_utente"] . "')";
        $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if($results == true) {
            # caricamento andato a buon fine, si può tornare alla pagina iniziale dell'utente
            header("Location: home_utente.php");
        }
    }

    mysqli_close($connection);
?>