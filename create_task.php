<?php session_start(); ?>
<?php include "header.php"; ?>
<?php include "database.php"; // database file 
if (isset($_POST['add_task'])) { // button to save an information
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $sql = "INSERT INTO `tasks`(`title`, `description`, `priority`, `due_date`) VALUES ('$title','$description','$priority','$due_date')";
    $result = mysqli_query( $conn, $sql );

    if($result){
      header("Location: view_tasks.php");
      $_SESSION['status'] = "Task added sucessfully!";
      $_SESSION['status_code'] = "success";
      exit();
    }
} ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add new task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

  <style>
      .desc_field {
          height: 200px;
      }
  </style>
</head>
<body>
  <section class="h-100" style="background-color: #eee;">
      <div class="container p-5">
          <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-lg-12 col-xl-11 d-flex justify-content-center align-items-center">
                  <div class="card text-black col-6" style="border-radius: 25px;">
                      <div class="card-body">
                          <div class="row justify-content-center">
                              <div class="col-lg-8">

                                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Add new task</p>

                                  <form class="mx-1 mx-md-4" action="" method="POST" autocomplete="off">

                                      <div class="d-flex flex-row align-items-center mb-4">
                                          <div class="form-outline flex-fill mb-0">
                                              <label class="form-label" for="form3Example4cd"><b>Title</b></label>
                                              <input type="text" id="form3Example4cd" class="form-control" name="title" required>
                                          </div>
                                      </div>

                                      <div class="d-flex flex-row mb-4">
                                          <div class="form-outline flex-fill mb-0">
                                              <label class="form-label" for="form3Example4cd"><b>Description</b></label>
                                              <textarea class="desc_field form-control" name="description" required></textarea>
                                          </div>
                                      </div>

                                      <div class="form-outline flex-fill mb-4">
                                          <label class="form-label" for="form3Example4cd"><b>Priority</b></label>
                                          <select class="form-select" name="priority">
                                              <?php
                                              $options = array('Low', 'Medium', 'High'); // Example array of options
                                              foreach ($options as $option) {
                                                  echo "<option value='" . $option . "'>" . $option . "</option>";
                                              }
                                              ?>
                                          </select>
                                      </div>


                                      <div class="d-flex flex-row align-items-center mb-4">
                                          <div class="form-outline flex-fill mb-4">
                                              <label class="form-label" for="form3Example4cd"><b>Due Date</b></label>
                                              <div class="row">
                                                  <div class="form-group">
                                                      <input id="startDate" class="form-control" type="date" name="due_date" required/>
                                                      <span class="input-group-addon">
                                                      <span class="glyphicon glyphicon-calendar"></span>
                                                      </span>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                          <button name="add_task" class="btn btn-primary">Add task</button>
                                      </div>
                                  </form>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

<!-- Separate Popper and Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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