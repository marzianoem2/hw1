<?php
   $array_json = array();
   $data = array(); // conterrà la riga

   # connessione al db
   $conn = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

   if(isset($_GET["q"])) {
        $q = mysqli_real_escape_string($conn, $_GET["q"]);

        $query = "SELECT titolo, contenuto, username FROM Utenti JOIN Articoli ON Articoli.autore=Utenti.id_utente WHERE titolo LIKE '%" . $q . "%' LIMIT 1";
        $results = mysqli_query($conn, $query) or die(mysqli_error($conn));

        if(mysqli_num_rows($results) == 0) {
            $array_json["empty"] = true; # il campo è settato a true se non ci sono risulatati
        }
        else {
            $array_json["empty"] = false; # ci sono risultati
            while($row = mysqli_fetch_assoc($results)) {
                $data[] = $row;
            }

            $array_json["results"] = $data;
        }

        echo json_encode($array_json);
   }
   
    mysqli_close($conn);
?>