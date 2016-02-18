<body>
<?php if (empty($_SESSION["id"])): ?> 
    <panel>
        <div class="welcome blue">WELCOME.</div>
        <?php if ($errors): ?> 
            <div style="color:red" class="validation-error">
                <?php echo $errors ?>
            </div>
        <?php endif; ?>
    </panel>
    
    <panel>
        <div class="content">
            <headline>Log In</headline>
            </br>
            <span id="login-error" class="validation-error"></span>
            <form action="index.php" method="post" id="login" class="login">
                <fieldset>
                    <div class="form-group">
                        <input autocomplete="off" autofocus class="form-control" name="email" placeholder="Email" type="text"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" placeholder="Password" type="password"/>
                    </div>
                    </br>
                    <div class="form-group">
                        <button class="btn btn-default log-in-submit" type="submit" name="log-in-submit">Log In</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </panel>
    
    <panel>
        <div class="content">
            <headline>Create an Account</headline>
            </br>
            <form action="index.php" method="post" id="registration" class="register">
                <fieldset>
                    <div class="form-group">
                        <input autocomplete="off" autofocus class="form-control" name="fl_name" placeholder="Name" type="text"/>
                    </div>
                    <div class="form-group">
                        <input autocomplete="off" autofocus class="form-control" name="email" placeholder="Email" type="text"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password" placeholder="Password" type="password"/>
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="password_confirmation" placeholder="Password (again)" type="password"/>
                    </div>
                    </br>
                    <div class="form-group">
                        <button class="btn btn-default sign-up-submit" type="submit" name="sign-up-submit">Register</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </panel>

<?php else : ?>  
    <?php if ($errors): ?> 
        <div style="color:red" class="validation-error">
            <?php echo $errors ?>
        </div>
    <?php endif; ?>
    
    <div class="container">
        <div class="row text-center">
            <h3>Welcome, <?php echo $name ?></h3>
        </div>
        <div class="row">
            <h4>Your Tasks</h4>
            <?php if (sizeof($rows) > 0): ?>
                <ul>
                <form action="home.php" method="post" name="update-tasks">
                    <?php foreach ($rows as $row): ?> 
                        <?php if ($row["is_complete"] == 1): ?>
                            <li class="tasks-list-item complete-task">
                            <div>
                                <span class="task-title"><s><?php echo $row["title"] ?></s></span><br>
                                <span class="task-description gray"><s><?php echo $row["description"] ?></s></span><br>
                                <button class="toggle-task btn-custom bluebg" type="submit" name="toggle-task" value="<?php echo $row["id"]; ?>">Mark incomplete</button>
                            </div>
                        <?php else : ?>
                            <li class="tasks-list-item">
                            <div>
                                <span class="task-title"><?php echo $row["title"] ?></span><br>
                                <span class="task-description gray"><?php echo $row["description"] ?></span><br>
                                <button class="toggle-task btn-custom bluebg" type="submit" name="toggle-task" value="<?php echo $row["id"]; ?>">Mark complete</button>
                            </div>
                        <?php endif; ?>
                        <?php if ($row["owner"] == $_SESSION["id"]): ?>
                            <button class="delete-task btn-custom" type="submit" name="delete-task" value="<?php echo $row["id"]; ?>">Delete</button>
                        <?php endif; ?>
                        </li>
                    <?php endforeach ?>
                </form>
                </ul>
            <?php else : ?>
                <h5>No tasks to show!</h5>
            <?php endif; ?>
        </div>
    </div>
    
    <hr>
    
    <div class="container">
        <div class="row">
            <h4>Add a new task</h4>
            <form action="home.php" method="POST" class="create-task" id="create-task">
                <label for="title">Task title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <label for="description">Description</label> 
                <div class="col-sm-10">
                    <textarea class="form-control" rows="2" name="description"></textarea>
                </div>
                <label for="collaborator1">Collaborators</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="collaborator1" name="collaborator1">
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="collaborator2" name="collaborator2">
                </div>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="collaborator3" name="collaborator3">
                </div>
                <div class="col-sm-10">
                    <button class="create-task-submit btn-custom bluebg" type="submit" name="create-task-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
</body>

<script>
    $(document).ready(function() {
        $('#login').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'You must provide your email.'
                        }
                    }
                },
                password: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'You must provide your password.'
                        }
                    }
                }
            }
        });
    });
    $(document).ready(function() {
        $('#registration').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    err: 'tooltip',
                    validators: {
                        emailAddress: {
                            message: 'Please specify a valid email address'
                        },
                        notEmpty: {
                            message: 'Email is required'
                        }
                    }
                },
                fl_name: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'Name is required'
                        }
                    }
                },
                password: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'Password is required'
                        }
                    }
                },
                password_confirmation: {
                    err: 'tooltip',
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'Confirmation does not match password.'
                        }
                    }
                }
            }
        });
    });
    $(document).ready(function() {
        $('#create-task').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                title: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'Title is required'
                        }
                    }
                },
                description: {
                    err: 'tooltip',
                    validators: {
                        notEmpty: {
                            message: 'Description is required'
                        }
                    }
                }
            }
        });
    });
</script>