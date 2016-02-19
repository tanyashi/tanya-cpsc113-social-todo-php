<?php if ($errors): ?> 
    <div class="validation-error">
        <?php echo $errors ?>
    </div>
<?php endif; ?>

<panel class="why heightvh">
    <div class="content">
        <headline>Edit Password</headline>
        </br>
        <form action="editpw.php" method="post">
            <fieldset>
                    <input class="form-control" name="oldpw" placeholder="Current Password" type="password"/>
                </div>
                <div class="form-group">
                    <input class="form-control" name="newpw" placeholder="New Password" type="password"/>
                </div>
                </br>
                <div class="form-group">
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
            </fieldset>
        </form>
        <div>
            or <a href="index.php">return home</a>
        </div>
    </div>
</panel>