<?php

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render homepage
        $query = "SELECT name FROM users WHERE id = '".$_SESSION["id"]."'";
        $name = mysqli_query($connection, $query);
        $name = mysqli_fetch_assoc($name);
        $name = $name["name"];
        
        $query = "SELECT email FROM users WHERE id = '".$_SESSION["id"]."'";
        $email = mysqli_query($connection, $query);
        $email = mysqli_fetch_assoc($email);
        $email = $email["email"];
        
        $query = "SELECT * FROM tasks WHERE owner = '".$_SESSION["id"]."' OR
        collaborator1 = '".$email."' OR
        collaborator2 = '".$email."' OR
        collaborator3 = '".$email."'";
        $result = mysqli_query($connection, $query);
        $rows = resultToArray($result);
        
        //dump($rows);
        
        render("home_user.php", ["name" => $name, "rows" => $rows]);
    }
    
        // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // if user created task, add to database
        if (isset($_POST["create-task-submit"]))
        {
            $query = "INSERT INTO tasks (owner, title, description, collaborator1, collaborator2, collaborator3)
            VALUES('".$_SESSION["id"]."', '".$_POST["title"]."', '".$_POST["description"]."', 
            '".$_POST["collaborator1"]."', '".$_POST["collaborator2"]."', '".$_POST["collaborator3"]."')";
            $result = mysqli_query($connection, $query);
            
            // refresh the page
            redirect("home.php");
        }
        
        // if user toggled task, change complete status
        if (isset($_POST["toggle-task"]))
        {
            
        }
        
        // if user deleted task, delete task
        if (isset($_POST["delete-task"]))
        {
            
        }
    }
?>