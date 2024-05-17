<?php
    //handles  user's login
    session_start();
    session_unset();
    session_destroy();
    header('Location: index.php'); // get back to the index file
?>
