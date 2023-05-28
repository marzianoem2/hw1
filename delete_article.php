<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # la sessione non esiste
        header("Location: login.php");
        exit;
    }

    $array_json = array();

    # connessione al db
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    $q = mysqli_real_escape_string($conn, $_GET["q"]);

    $query = "DELETE FROM Articoli WHERE id_articolo = '" . $q . "' AND autore = '" . $_SESSION["id_utente"] . "'";
    $results = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($results == true) {
        $array_json["delete"] = true; # il campo è settato a true se la cancellazione è avvenuta con successo
    }
    else {
        $array_json["delete"] = false; # cancellazione fallita
    }

    $array_json["article"] = $q;

    echo json_encode($array_json);

    mysqli_close($conn);
?>