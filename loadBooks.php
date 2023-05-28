<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione non esistente
        header("Location: login.php");
        exit;
    }

    $array_json = array();
    $data = array(); # contiene le varie righe risultanti dalla query

    # connessione al db
    $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

    $query = "SELECT L.titolo, L.id_libro FROM Libri L join LibriSalvati LS on L.id_libro=LS.id_libro WHERE LS.id_utente='" . $_SESSION["id_utente"] . "'";
    $results = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($results) == 0) {
        $array_json["empty"] = true; # il campo è settato a true se l'utente non ha ancora salvato nessun libro
    }
    else {
        $array_json["empty"] = false; # ci sono libri salvati
        while($row = mysqli_fetch_assoc($results)) {
            $data[] = $row;
        }

        $array_json["results"] = $data;
    }

    echo json_encode($array_json);

    mysqli_close($conn);
?>