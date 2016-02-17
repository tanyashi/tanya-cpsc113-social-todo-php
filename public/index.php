<?php

    // configuration
    require("../includes/config.php"); 
    
    // if already logged in, redirect to home
    if (!empty($_SESSION["id"]))
    {
        redirect("home.php");
    }

    // else render homepage
    render("homepage.php");
    
?>