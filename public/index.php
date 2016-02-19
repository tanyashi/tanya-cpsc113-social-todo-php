<?php

    ini_set("log_errors", 1);
    ini_set("error_log", "/home/ubuntu/workspace/errorlog.log");
    error_log("index loaded");

    // configuration
    require("../includes/config.php"); 
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        error_log("get");
        // if already logged in, redirect to home
        if (!empty($_SESSION["id"]))
        {
            $query = "SELECT name FROM users WHERE id = '".$_SESSION["id"]."'";
            $name = mysqli_query($connection, $query);
            $name = mysqli_fetch_assoc($name);
            $name = $name["name"];
            $name = explode(' ',trim($name))[0];
            
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
    
            $errors = "";
            render("homepage.php", ["name" => $name, "rows" => $rows, "errors" => $errors]);
        }
    
        // else render homepage
        $errors = "";
        render("homepage.php", ["errors" => $errors]);
    }
    
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        error_log("POST");
        // if user logged in, verify and log in
        if (isset($_POST["log-in-submit"]))
        {
            // query database for user
            $query = "SELECT * FROM users WHERE email = '".$_POST["email"]."'";
            $rows = mysqli_query($connection, $query);
            $rows = mysqli_fetch_assoc($rows);
            if (!$rows) {
                $errors = "Invalid email address";
                render("homepage.php", ["errors" => $errors]);
            }
    
            // if we found user, check password
            if (count($rows) != 0)
            {
                // compare hash of user's input against hash that's in database
                if (password_verify($_POST["password"], $rows["password"]))
                {
                    // remember that user's now logged in by storing user's ID in session
                    $_SESSION["id"] = $rows["id"];
                    
                    // redirect to user home
                    redirect("index.php");
                }
                
            }
    
            // else apologize
            $errors = "Invalid password";
            render("homepage.php", ["errors" => $errors]);
        }
        
        // if new user signed up, add to database and log them in
        if (isset($_POST["sign-up-submit"]))
        {
            error_log("register");
            
            // validate entries
            if (strlen($_POST["fl_name"]) == 0) {
                $errors = "Name is required.";
                render("homepage.php", ["errors" => $errors]);
            }
            if (strlen($_POST["fl_name"]) > 50) {
                $errors = "Name is too long.";
                render("homepage.php", ["errors" => $errors]);
            }
            if (strlen($_POST["email"]) == 0) {
                $errors = "Email is required.";
                render("homepage.php", ["errors" => $errors]);
            }
            if (strlen($_POST["email"]) > 50) {
                $errors = "Email is too long.";
                render("homepage.php", ["errors" => $errors]);
            }
            if (strlen($_POST["password"]) == 0) {
                $errors = "Password is required.";
                render("homepage.php", ["errors" => $errors]);
            }
            if (strlen($_POST["password"]) > 50) {
                $errors = "Password is too long.";
                render("homepage.php", ["errors" => $errors]);
            }
            if ($_POST["password"] != $_POST["password_confirmation"]) {
                $errors = "Password does not match confirmation.";
                render("homepage.php", ["errors" => $errors]);
            }
            
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
            
            error_log("register valid");
            // redirect to user homepage
            redirect("index.php");
        }
        
        // if user created task, add to database
        if (isset($_POST["create-task-submit"]))
        {
            // validate entries
            if (strlen($_POST["title"]) == 0 || strlen($_POST["title"]) > 500) {
                redirect("index.php");
            }
            if (strlen($_POST["description"]) >= 5000) {
                redirect("index.php");
            }
            
            $query = "INSERT INTO `tasks` (`owner`, `title`, `description`, `collaborator1`, `collaborator2`, `collaborator3`) VALUES('".$_SESSION["id"]."', '".$_POST["title"]."', '".$_POST["description"]."', '".$_POST["collaborator1"]."', '".$_POST["collaborator2"]."', '".$_POST["collaborator3"]."')";
            $result = mysqli_query($connection, $query);
            // refresh the page
            redirect("index.php");
        }
        
        // if user toggled task, change complete status
        if (isset($_POST["toggle-task"]))
        {
            $query = "SELECT is_complete FROM tasks WHERE id = '".$_POST["toggle-task"]."'";
            $status = mysqli_query($connection, $query);
            $status = mysqli_fetch_assoc($status);
            $status = $status["is_complete"];
            
            if ($status == 0) {
                $query = "UPDATE tasks SET is_complete = 1 WHERE id = '".$_POST["toggle-task"]."'";
                $result = mysqli_query($connection, $query);
            } else {
                $query = "UPDATE tasks SET is_complete = 0 WHERE id = '".$_POST["toggle-task"]."'";
                $result = mysqli_query($connection, $query);
            }
            
            // refresh the page
            redirect("index.php");
        }
        
        // if user deleted task, delete task
        if (isset($_POST["delete-task"]))
        {
            $query = "DELETE FROM tasks WHERE id = '".$_POST["delete-task"]."'";
            $result = mysqli_query($connection, $query);
            
            // refresh the page
            redirect("index.php");
        }
    }
?>