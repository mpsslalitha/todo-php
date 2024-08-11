<?php
require 'db_conn.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main-section">
        <div class="add-section">
            <form action="app/add.php" method="POST" autocomplete="off">

                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                    <input type="text"
                        name="title"
                        style="border-color: #ff6666;"
                        placeholder="This field is required" />
                    <br />
                    <button type="submit" class="btn">Add Todo</button>
                <?php } else { ?>
                    <input type="text"
                        name="title"
                        placeholder="Enter Todo" />
                    <br />
                    <button type="submit" class="btn">Add Todo</button>
                <?php } ?>
            </form>
        </div>
        <?php

        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        ?>
        <div class="show-todo-section">
            <?php while ($todo = $todos->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <form method="POST" action="app/check.php" class="checkbox-form">
                        <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                        <input type="checkbox" class="todo-checkbox"
                            name="checked"
                            <?php if ($todo['checked']) echo 'checked'; ?>
                            onchange="this.form.submit()">
                    </form>
                    <div class="todo-content">
                        <h2 class="<?php if ($todo['checked']) echo 'checked'; ?>">
                            <?php echo $todo["title"]; ?>
                        </h2>
                        <?php if (!$todo['checked']) { ?>
                            <small>Created <?php echo $todo["date_time"]; ?></small>
                        <?php } ?>
                    </div>
                    <form method="POST" action="app/remove.php" class="remove-todo-form">
                        <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                        <button type="submit" class="remove-todo">X</button>
                    </form>
                </div>

            <?php } ?>

        </div>

    </div>
</body>

</html>