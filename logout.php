<?php
    session_start();

    //end session
    session_destroy();

    //go to home page
    header("Location: index.html");
 
?>