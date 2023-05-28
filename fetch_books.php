<?php
    session_start();
    if(!isset($_SESSION["username"]) || !isset($_SESSION["id_utente"])) {
        # sessione non esistente
        header("Location: login.php");
        exit;
    }

    # API Google Books
    $endpoint = "https://www.googleapis.com/books/v1/volumes?";
    $key_api = "AIzaSyAhtJy6wsCH-w3RClZU1_QMSpw6ACuE21Q";
    $n_max = 10; # numero massimo di risultati da visualizzare
    $header = array("Content-Type: application/x-www-form-urlencoded");
    
    if(isset($_GET["q"])) {
        $curl = curl_init();
        $par = array("q" => $_GET["q"], "key" => $key_api, "maxResults" => $n_max);
        $par = http_build_query($par);
    
        curl_setopt($curl, CURLOPT_URL, $endpoint . $par);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $res = curl_exec($curl);
        curl_close($curl);

        echo $res;
    }
?>