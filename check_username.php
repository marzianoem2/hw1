<?php
    $array_json = array();

    # connessione al database hw1
    $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    # ciò che ha inserito l'utente
    $user = mysqli_real_escape_string($connection, $_GET["q"]);
    
    $query = "SELECT username FROM Utenti WHERE username = '" . $user . "'";
    $results = mysqli_query($connection, $query) or die(mysqli_error());

    if(mysqli_num_rows($results) > 0) {
        # lo username è già in uso
        $array_json["check"] = false; # check=false -> controllo non superato
    }
    else {
        # lo username non è già in uso  
        $array_json["check"] = true; # check=true -> controllo superato
    }

    echo json_encode($array_json);

    mysqli_close($connection);
?>