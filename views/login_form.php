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
                    },
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
</script>

<panel class="why heightvh">
    <div class="content">
        <headline>Log In</headline>
        </br>
        <form action="login.php" method="post" id="login">
            <fieldset>
                <div class="form-group">
                    <input autocomplete="off" autofocus class="form-control" name="email" placeholder="Email" type="text"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="password" placeholder="Password" type="password"/>
                </div>
                </br>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">Log In</button>
                </div>
            </fieldset>
        </form>
        <div>
            or <a href="register.php">register</a> for an account
        </div>
    </div>
</panel>