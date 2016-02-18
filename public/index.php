<?php

    // configuration
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // if already logged in, redirect to home
        if (!empty($_SESSION["id"]))
        {
            $errors = "";
            redirect("home.php", ["errors" => $errors]);
        }
    
        // else render homepage
        $errors = "";
        render("homepage.php", ["errors" => $errors]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (isset($_POST["log-in-submit"]))
        {
            // query database for user
            $query = "SELECT * FROM users WHERE email = '".$_POST["email"]."'";
            $rows = mysqli_query($connection, $query);
            $rows = mysqli_fetch_assoc($rows);
    
            // if we found user, check password
            if (count($rows) != 0)
            {
                // compare hash of user's input against hash that's in database
                if (password_verify($_POST["password"], $rows["password"]))
                {
                    // remember that user's now logged in by storing user's ID in session
                    $_SESSION["id"] = $rows["id"];
                    
                    // redirect to user home
                    redirect("home.php");
                }
            }
    
            // else apologize
            $errors = "Invalid email address";
            render("homepage.php", ["errors" => $errors]);
        }
        if (isset($_POST["sign-up-submit"]))
        {
            $query = mysqli_query($connection, "SELECT 1 FROM users WHERE email = '".$_POST["email"]."'");

            // validate submission
            if (mysqli_fetch_assoc($query))
            {
                $errors = "Account with this email already exists!";
                render("homepage.php", ["errors" => $errors]);
            }
            
            // add user to database
            $query = "INSERT IGNORE INTO users (name, email, password) VALUES('".$_POST['fl_name']."', '".$_POST['email']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
            $result = mysqli_query($connection, $query);
            
            $rows = mysqli_query($connection, "SELECT LAST_INSERT_ID() AS id");
            $rows = mysqli_fetch_assoc($rows);
            $id = $rows["id"];
            
            // log user in
            $_SESSION["id"] = $id;
            
            // redirect to home.php
            redirect("home.php");
        }
    }
?>