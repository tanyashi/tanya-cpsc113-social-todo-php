<body>
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
        <form class="form-horizontal" method="post" action="home.php" name="create-tasks">
            <label for="title">Task title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <label for="description">Description</label> 
            <div class="col-sm-10">
                <textarea class="form-control" rows="4" name="description"></textarea>
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
            <button class="create-task-submit btn-custom bluebg" type="submit" name="create-task-submit">Submit</button>
        </form>
    </div>
</div>
</body>