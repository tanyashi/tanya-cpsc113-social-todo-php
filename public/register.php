<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $query = mysqli_query($connection, "SELECT 1 FROM users WHERE email = '".$_POST["email"]."'");
        // validate submission
        if (mysqli_fetch_assoc($query))
        {
            apologize("Email already taken.");
        }
        
        // add user to database
        $query = "INSERT IGNORE INTO users (name, email, password) VALUES('".$_POST['name']."', '".$_POST['email']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
        $result = mysqli_query($connection, $query);
        //$result = mysqli_fetch_assoc($result);
        
        //$result = mysqli::query("INSERT IGNORE INTO users (name, email, hash) VALUES(?, ?, ?)", $_POST["name"], $_POST["email"], password_hash($_POST["password"], PASSWORD_DEFAULT));
       
        $rows = mysqli_query($connection, "SELECT LAST_INSERT_ID() AS id");
        $rows = mysqli_fetch_assoc($rows);
        $id = $rows[0]["id"];
        
        // log user in
        $_SESSION["id"] = $id;
        
        // redirect to home.php
        redirect("home.php");
    }
?>