<script>
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
                    }
                }
            },
            name: {
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
            confirmation: {
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
</script>

<panel class="why heightvh">
    <div class="content">
        <headline>Create an Account</headline>
        </br>
        <form action="register.php" method="post" id="registration">
            <fieldset>
                <div class="form-group">
                    <input autocomplete="off" autofocus class="form-control" name="name" placeholder="Name" type="text"/>
                </div>
                <div class="form-group">
                    <input autocomplete="off" autofocus class="form-control" name="email" placeholder="Email" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" placeholder="Password" type="password"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="confirmation" placeholder="Password (again)" type="password"/>
                </div>
                </br>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">Register</button>
                </div>
            </fieldset>
        </form>
        <div>
            or <a href="login.php">log in</a>
        </div>
    </div>
</panel>
