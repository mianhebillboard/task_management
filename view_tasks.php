<?php session_start();?>

<?php include "header.php"; ?>

<?php 

include "database.php";

$sql = "SELECT * FROM tasks";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <!-- Bootstrap -->
    <link href="CSS/main.min.css" rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <style>
        .bi-trash-fill{
            color: #900C3F;
        }
        .bi-pencil-fill {
            color: black;
        }

        .table td {
            white-space: nowrap;
            word-wrap: break-word;
            word-break: break-all;
        }

        #title_field {
            width: 200px;
        }

        #desc_field {
            width: 500px;
        }

    </style>
</head>
<body>
<center>
    <div class="main_container vh-100">
    <h2 class="pt-5"> Tasks </h2>
        <div class="container pt-3 d-flex justify-content-start">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    View
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item">Table</a></li>
                    <li><a class="dropdown-item" href="card_view.php">Card</a></li>
                </ul>
            </div>
        </div>
        <div class="container p-4">
                <?php
                if ($result->num_rows > 0) {
                ?>
                <table class="table table-striped" border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Priority</th>
                            <th>Due date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                <tbody>
                <?php
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <?php echo $row['id']; ?>
                    </td>
                    <td id="title_field">
                        <?php echo $row['title']; ?>
                    </td>
                    <td id="desc_field">
                        <?php echo $row['description']; ?>
                    </td>
                    <td>
                        <?php echo $row['priority']; ?>
                    </td>
                    <td>
                        <?php echo $row['due_date']; ?>
                    </td>
                    <td>
                        <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                            <i class="bi-pencil-fill"></i>
                        </a>&nbsp;
                        <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                            <i class="bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>                       
                <?php
                }
                }
                else {
                    echo "<div class='col-md-12 text-danger'><p>No task yet.</p></div>";
                }
                ?>                
            </tbody>
            </table>
            <br>
            <a class="btn btn-primary" href="create_task.php"><i class="bi bi-plus"></i> Add New Task</a>
        </div>
    </div>
    
</center>

<script src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity = 'sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin = 'anonymous'></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '' )
{
    ?>
        <script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",
                icon: "<?php echo $_SESSION['status_code']; ?>",
            });
        </script> 
        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
}
?>

</body>
</html>

<?php include "footer.php"; ?>