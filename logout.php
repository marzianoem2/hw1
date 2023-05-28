<?php 
    session_start();
    session_destroy(); # distruzione sessione

    header("Location: homepage.html");
    exit;
?>