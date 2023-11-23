<?php
include 'db.php';

//Proses insert data
if (isset($_POST['add'])) {
    $q_insert = "INSERT INTO task (task_lable, task_status) VALUE (
        '".mysqli_real_escape_string($conn, $_POST['task'])."',
        'open'
    )";

    $run_q_insert = mysqli_query($conn, $q_insert);

    if (!$run_q_insert) {
        echo 'error' . mysqli_error($conn);
    } else {
        header('Refresh:0; url=todo.php');
    }
}

// Show data 
$q_select = "SELECT * FROM task ORDER BY task_id DESC";
$run_q_select = mysqli_query($conn, $q_select);

// Delete data
if(isset($_GET['delete'])) {
    $q_delete = "DELETE FROM task WHERE task_id = '".$_GET['delete']."'";
    $run_q_delete = mysqli_query($conn, $q_delete);
    header('Refresh:0; url=todo.php');
}

// update status data (open/close)
if (isset($_GET['done'])) {
    $status = 'close';
    if($_GET['status'] == 'open') {
        $status = 'close';
    } else {
        $status = 'open';
    }

    $q_update = "UPDATE task SET task_status = '".$status."' WHERE task_id = '".$_GET['done']."'";
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
    <!-- <div class="embel"> -->
        <!-- <div><img src="image/kiri atas.png" alt="" class="image"></div> -->
        <div class="icon">
        <img src="image/icon.png" alt="">
        </div>
        <div class="aduh">
            <h3 class="make">Make your <span>Note</span></h3></div>
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
                    <input name="task" type="text" class="input-control" placeholder="Task Name">
                    <!-- <input name="task" type="text" placeholder="Description" class="input-cont"> -->
                    <div class="text-right">
                        <button type="submit" name="add" class="add">Add</button>
                    </div>
                </form>
            </div>

            <!-- ini untuk tugas -->
            <?php
            if(mysqli_num_rows($run_q_select) > 0) {
                while($r = mysqli_fetch_array($run_q_select)){
            ?>
            <div class="card">
                <div class="task-item <?= $r['task_status'] == 'close' ? 'done':''?>">
                    <div>
                        <input type="checkbox" onclick="window.location.href = '?done=<?= $r['task_id']?>&status=<?= $r['task_status']?>'" <?= $r['task_status'] == 'close' ? 'checked':''?>>
                        <span><?= $r['task_lable']?></span>

                    </div>
                    <div>
                        <a href="edit.php?id=<?= $r['task_id']?>" class="edit-task" title="edit"><i class='bx bx-edit'></i></a>
                        <a href="?delete=<?= $r['task_id']?>" class="delete-task" title="Remove" onclick="return confirm('Are you sure?')"><i class='bx bx-trash'></i></a>
                    </div>
                </div>

            </div>
            
        <?php } } else {  ?>
            <div>Belum Ada Data</div>
        <?php } ?>
        </div>
        <div class="back"><a href="index.php"><button >Back</button></a></div>
        
    </div>
        <!-- <div><img src="image/Mask group.png" alt="" class="imag"></div> -->
    </div>
    <!-- header selesai -->

    
    
</body>

</html>