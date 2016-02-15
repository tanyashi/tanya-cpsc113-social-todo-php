<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title>Social To Do: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Social To Do</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>
        
        <!-- Form Validation -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.1/css/formValidation.min.css">
        <script src="//code.jquery.com/jquery-2.1.3.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.1/js/formValidation.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.1/js/framework/bootstrap.min.js"></script>

        <link rel="shortcut icon" href="/img/favicon.ico">
    
    </head>

    <body>

        <div class="navbar navbar-default">
            <div class="container">
                <div class="navbar-default">
                    <logo>Social To Do App</logo>
                </div>
            </div>
        </div>
        
        <div id="middle">

