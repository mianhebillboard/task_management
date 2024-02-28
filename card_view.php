<?php session_start();

?>
<?php include "header.php"; ?>
<?php 

include "database.php";

$sql = "SELECT * FROM tasks ORDER BY due_date ASC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <style>

        .card {
            max-width: 300px!important;
        }
        .card-body {
            min-height: 200px!important;
        }

        .high-prio {
            background-color: #881500!important;
        }

        .medium-prio {
            background-color: #b47a00!important;
        }

        .low-prio {
            background-color: green!important;
        }

        .legend {
            height: 50px!important;
            width: 50px!important;
        }

        .bi-trash-fill{
            color: #900C3F;
        }
        .bi-pencil-fill {
            color: white;
        }
    </style>
</head>
<body>
<div class="container py-4">
<h2 class="pt-2 text-center"> Tasks </h2>
    <div class="container pt-2 px-0 d-flex justify-content-start">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                View
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="view_tasks.php">Table</a></li>
                <li><a class="dropdown-item">Card</a></li>
            </ul>
        </div>
    </div>
    <div class="col-12 d-flex justify-content-center flex-column">
        <div class="row text-center">
            <h5>Legend:</h5>   
        </div>
        <div class="row pt-3 pb-5">
            <div class="col-4 d-flex justify-content-center align-items-center pb-2">
                <div class="row me-3">
                    <div class="legend low-prio rounded-circle">

                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        Low priority
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center align-items-center pb-2">
                <div class="row me-3">
                    <div class="legend medium-prio rounded-circle">

                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        Medium priority
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-center align-items-center pb-2">
                <div class="row me-3">
                    <div class="legend high-prio rounded-circle">

                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        High priority
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
        <?php 
        $new_due_date = $row['due_date'];
        $year = date('Y', strtotime($new_due_date));
        $month = date('m', strtotime($new_due_date));
        $new_month = date('F', strtotime($new_due_date));
        $day = date('d', strtotime($new_due_date));
        ?>
        <div class="col-md-3">
            <div class="card mb-4">
                <?php
                if ($row['priority'] == "Low" ){ ?>
                    <div class="card-header low-prio text-light d-flex justify-content-between">
                <?php
                }
                else if ($row['priority'] == "Medium" ){ ?>
                    <div class="card-header medium-prio text-light d-flex justify-content-between">
                <?php
                }
                else { ?>
                    <div class="card-header high-prio text-light d-flex justify-content-between">
                <?php
                }
                ?>
                        <div>
                            <?php
                            echo (
                                $new_month . " " . $day . ", " . $year
                            ); 
                            ?>
                        </div>
                        <div>
                            <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                                <i class="bi-pencil-fill"></i>
                            </a>
                        </div>
                    </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                </div>
                <div class="card-footer text-body-secondary">
                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="text-decoration-none">
                        <i class="bi-trash-fill"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo "<div class='col-md-12 text-danger'><p>No task yet.</p></div>";
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="create_task.php"><i class="bi bi-plus"></i> Add New Task</a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>
</html>

<?php include "footer.php"; ?>