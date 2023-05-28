<?php
    session_start();
    if(isset($_SESSION["username"]) && isset($_SESSION["id_utente"])) {
        # sessione già esistente, non c'è bisogno di ripetere il login
        header("Location: home_utente.php");
        exit;
    }

    if(isset($_POST["username"]) && isset($_POST["password"])) {
        # connessione al database hw1
        $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

        # credenziali inserite dall'utente
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $pwd = mysqli_real_escape_string($connection, $_POST["password"]);

        $query = "SELECT * FROM Utenti WHERE username = '" . $username . "'";
        $results = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if(mysqli_num_rows($results) == 0) {
            $not_there = true; # non ci sono utenti con questo username
        }
        else {
            # è presente almeno una riga
            $row = mysqli_fetch_assoc($results);

            if (password_verify($_POST["password"], $row["password_u"])) { # confronta la password data con un hash dato
                # se le due coincidono, l'utente può essere loggato 
                $_SESSION["username"] = $row["username"];
                $_SESSION["id_utente"] = $row["id_utente"];

                mysqli_close($connection); 

                header("Location: home_utente.php");
                exit;
            }
            else {
                # credenziali errate
                $wrong_cred = true;
            }
        }
        
        #chiusura connessione 
        mysqli_close($connection); 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BookLife - Log in</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style_log.css">
        <link rel="icon" href="logo.png" type="image/icon type">

        <script src="login.js" defer="true"></script>

        <!-- font per headings -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap" rel="stylesheet">

        <!-- font body -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=PT+Serif&display=swap" rel="stylesheet">

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>

    <body>
        <nav>
            <a href="homepage.html">HOME</a> 
            <a href="signup.php">Sign up</a>  
        </nav>

        <section id="section-log-in">
            <div class="col-1">
                <img src="a-book-2341848_1920.png">
            </div>

            <div class="col-2">
                <form class="log-sign" id="form-log-in" name="form-log-in" method="post">
                    <label>
                        Username 
                        <input type="text" placeholder="Inseririsci nome utente..." name="username">
                    </label>

                    <label class="pwd-lab">
                        Password 
                        <input type="password" placeholder="Inserisci password..." name="password">
                        <span class="toggle-eye material-icons">visibility</span>
                    </label>
                    
                    <input type="submit" value="Accedi">
                </form>

                <span class="errors">
                    <?php
                        if($not_there == true) {
                            # non c'è un utente con quello username
                            echo "Compilare correttamente i campi";
                        }

                        if($wrong_cred == true) {
                            # credenziali errate
                            echo "Username e/o password errate";
                        }
                    ?>
                </span>

                <p class="log">
                    Non hai un account?
                    <a href="signup.php">Registrati</a>
                </p>
            </div>
        </section>
    </body>
</html>