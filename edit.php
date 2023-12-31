<?php
include 'db.php';
// select data yang akan diedit
$q_select = "SELECT * FROM task WHERE task_id = '".$_GET['id']."'";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_object($run_q_select);

//update data
if (isset($_POST['edit'])) {
    $q_update = "UPDATE task SET task_lable = '".$_POST['task']."' WHERE task_id = '".$_GET['id']."'";
    $run_q_update = mysqli_query($conn, $q_update);
    header('Refresh:0; url=todo.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="style.css">
    <!-- ini untuk boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <!-- ini untuk header -->
    <div class="container">
        <div class="header">
            <div class="title">
                <i class='bx bx-sun'></i>
                <span>To Do List</span>
            </div>
            <div class="description">
                <?= date("l, d M Y") ?>
            </div>
        </div>

        <!-- ini untuk content -->
        <div class="content">
            <div class="card">
                <form action="" method="post">
                    <input name="task" type="text" class="input-control" placeholder="Edit" value="<?= $d->task_lable?>">
                    <div class="text-right">
                        <button type="submit" name="edit" class="add">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>