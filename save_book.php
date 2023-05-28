<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione non esistente
        header("Location: login.php");
        exit;
    }

    # flag per le varie query, usate poi da js per far spuntare i corretti messaggi di errore
    $insertLibro_done = false;
    $insertLibriSalvati_done = false;
    $already_there = false;

    $data = array(); 

    # connessione al db
    $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    $id_libro = mysqli_real_escape_string($connection, $_POST["id"]);
    $title = mysqli_real_escape_string($connection, $_POST["title"]);
    $author = mysqli_real_escape_string($connection, $_POST["author"]);

    $query = "SELECT * FROM Libri WHERE id_libro = '" . $id_libro . "'";
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if(mysqli_num_rows($res) > 0) {
        # se ci sono delle righe, vuol dire che esiste già il libro selezionato nel db, quindi non c'è bisogno di reinserirlo
        $insertLibro_done = true;
    }
    else {
        # è necesario inserire il libro perchè nella tabella non esiste già 
        $query = "INSERT INTO Libri (id_libro, titolo, autore) VALUES('" . $id_libro . "', '" . $title . "', '" . $author . "')";
        $res = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if($res == true) {
            $insertLibro_done = true;
        }
    }

    $query = "SELECT * FROM LibriSalvati WHERE id_libro = '" . $id_libro . "' AND id_utente = '" . $_SESSION["id_utente"] . "'";
    $res = mysqli_query($connection, $query) or die(mysqli_error($connection));

    if(mysqli_num_rows($res) > 0) {
        # se ci sono delle righe, vuol dire che l'utente ha già salvato il libro, quindi non deve poterlo risalvare
        $already_there = true;
        $insertLibriSalvati_done = true;
    }
    else {
        # è neccessario salvare il libro per l'utente
        $query = "INSERT INTO LibriSalvati (id_utente, id_libro) VALUES('" . $_SESSION["id_utente"] . "', '" . $id_libro . "')";
        $res = mysqli_query($connection, $query) or die(mysqli_error($connection));
            
        if($res == true) {
            $insertLibriSalvati_done = true;
        }
    }
    
    $data["check_libro"] = $insertLibro_done; 
    $data["check_libriSalvati"] = $insertLibriSalvati_done;
    $data["check_aggiunto"] = $already_there;
    $data["id_libro"] = $id_libro;

    echo json_encode($data);

    mysqli_close($connection);
?>