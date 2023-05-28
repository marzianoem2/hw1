<?php 
    session_start();
    if(isset($_SESSION["username"])) {
        # sessione già esistente
        header("Location: home_utente.php");
        exit;
    }

    if(isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        $errors_mess = array(); # arrai contenente i messaggi di errore

        # connessione al database hw1
        $connection = mysqli_connect("localhost", "root", "", "hw1") or die(mysqli_connect_error());

        # credenziali inserite dall'utente
        $nome = mysqli_real_escape_string($connection, $_POST["nome"]);
        $cognome = mysqli_real_escape_string($connection, $_POST["cognome"]);
        $email = mysqli_real_escape_string($connection, strtolower($_POST["email"]));
        $username = mysqli_real_escape_string($connection, $_POST["username"]);
        $pwd = mysqli_real_escape_string($connection, $_POST["password"]);

        # CONTROLLO EMAIL
        $check_email = "/^[a-zA-Z0-9.!#$%&'+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        
        if(!preg_match($check_email, $_POST["email"])) {
            # l'email non è corretta
            $errors_mess[] = "Email non valida";
        }
        else {
            # email corretta
            $query = "SELECT email FROM Utenti WHERE email = '" . $email . "'";
            $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
            if(mysqli_num_rows($results) > 0) {
                # c'è già un utente registrato con la stessa email
                $errors_mess[] = "Email già in uso";
            }
        }

        # CONTROLLO USERNAME
        $check_username = "/^[a-z]\w{2,23}[^_]$/i";
        /* 
            lo username deve iniziare con una lettera, 
            deve avere una lunghezza fra 4 e 25, 
            può avere lettere, numeri e underscore,
            non può terminare con un underscore
        */
        
        if(!preg_match($check_username, $_POST["username"])) {
            # username non corretto
            $errors_mess[] = "Username non valido";
        }
        else {
            # username corretto
            $query = "SELECT username FROM Utenti WHERE username = '" . $username . "'";
            $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
            if(mysqli_num_rows($results) > 0) {
                # c'è già un utente registrato con lo stesso username
                $errors_mess[] = "Username già in uso";
            }
        }

        # CONTROLLO PASSWORD 
        $check_pwd = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        /* 
            la password deve avere lunghezza minina di 8 caratteri,
            deve avere almeno una lettera maiuscola,
            deve avere almeno una lettera minuscola,
            deve avere almeno una cifra numerica,
            deve avere almeno un carattere speciale
        */

        if(!preg_match($check_pwd, $_POST["password"])) {
            # password non corretta
            $errors_mess[] = "Password non valida. Inserire almeno 8 caratteri, un numero, una maiuscola, una minuscola e un carattere speciale";
        }

        # se i controlli sono stati passati si può inserire il nuovo utente nel database
        if(count($errors_mess) == 0) {
            $pwd = password_hash($pwd, PASSWORD_BCRYPT);

            $query = "INSERT INTO Utenti (nome, cognome, email, username, password_u) VALUES ('" . $nome . "', '" . $cognome . "', '" . $email . "', '" . $username . "', '" . $pwd . "')";
            $results = mysqli_query($connection, $query) or die(mysqli_error($connection));
            
            # salvataggio variabili di sessione
            $_SESSION["username"] = $username;
            $_SESSION["id_utente"] = mysqli_insert_id($connection);

            mysqli_close($connection);

            header("Location: home_utente.php");
            exit;
        }
        
        #chiusura connessione 
        mysqli_close($connection); 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>BookLife - Sign up</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="style_log.css">
        <link rel="icon" href="logo.png" type="image/icon type">

        <script src="signup.js" defer="true"></script>

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
            <a href="login.php">Log in</a>  
        </nav>

        <section id="section-log-in">
            <div class="col-1">
                <img src="a-book-2341848_1920.png">
            </div>

            <div class="col-2">
                <form class="log-sign" id="form-sign-up" name="form-sign-up" method="post">
                    <label>
                        Nome 
                        <input type="text" placeholder="Inserisci nome..." name="nome">
                    </label>

                    <label>
                        Cognome 
                        <input type="text" placeholder="Inserisci cognome..." name="cognome">
                    </label>

                    <label>
                        Email 
                        <input type="text" placeholder="Inserisci email..." name="email">
                    </label>
                    <span class="hidden" id="email-error"></span>

                    <label>
                        Username 
                        <input type="text" placeholder="Inserisci nome utente..." name="username">
                    </label>
                    <span class="hidden" id="username-error"></span>

                    <label class="pwd-lab">
                        Password 
                        <input type="password" placeholder="Inserisci password..." name="password">
                        <span class="toggle-eye material-icons">visibility</span>
                    </label>
                    <span class="hidden" id="password-error"></span>
                    
                    <input type="submit" value="Registrati">
                </form>

                <span class="hidden" id="generic">Compila correttamente</span>
                
                <?php
                    # stampa degli errori se è stato settato il vettore di messaggi di errore e se c'è del contenuto
                    if(isset($errors_mess)) {
                        if(count($errors_mess) > 0) {
                            echo "<div id='errors-php'>";
                            foreach($errors_mess as $e) {
                                echo "<p>";
                                echo $e;
                                echo "</p>";
                            }
                            echo "</div>";
                        }
                    }
                ?>

                <p class="log">
                    Hai già un account?
                    <a href="login.php">Accedi</a>
                </p>
            </div>
        </section>
    </body>
</html>