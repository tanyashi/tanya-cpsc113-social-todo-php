<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $errors = "";
        render("edit_form.php", ["errors" => $errors]);
    }
     
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // verify old password
        $query = "SELECT * FROM users WHERE id = '".$_SESSION["id"]."'";
        $rows = mysqli_query($connection, $query);
        $rows = mysqli_fetch_assoc($rows);
        if (password_verify($_POST["oldpw"], $rows["password"]))
        {
            $query = "UPDATE users SET password = '".password_hash($_POST['newpw'], PASSWORD_DEFAULT)."' WHERE id = '".$_SESSION["id"]."'";
            $result = mysqli_query($connection, $query);
            
            // redirect to user home
            redirect("index.php");
        }
        // else display error
        $errors = "Current password is incorrect.";
        render("edit_form.php", ["errors" => $errors]);
    }

?>
