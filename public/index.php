<?php

    // configuration
    require("../includes/config.php"); 
    
    // if already logged in, render user homepage
    if (!empty($_SESSION["id"]))
    {
        render("home_user.php");
    }

    // else render homepage
    render("homepage.php");
    
?>