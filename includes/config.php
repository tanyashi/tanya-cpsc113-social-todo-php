<?php

    /**
     * config.php
     *
     * CPSC 113
     * Social To-Do 2
     *
     * Configures app.
     */

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("helpers.php");
    
    // connect to the database
    $host = "127.0.0.1";
    $user = "tanyashi";                     
    $pass = "";                                  
    $db = "socialtodo";                                  
    $port = 3306;                                
    
    $connection = mysqli_connect($host, $user, $pass, $db, $port)or die(mysql_error());
    
    // enable sessions
    session_start();

?>
