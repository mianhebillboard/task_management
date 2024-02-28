<?php session_start(); 

include "database.php"; // database file
if (isset($_POST['submit'])) { // button to save an information
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];
    $id = $_GET['id'];
    $sql = "UPDATE tasks SET title='$title', description='$description', priority='$priority', due_date='$due_date' WHERE id=$id";
    $result = $conn->query($sql);

    if($result){
      header("Location: view_tasks.php");
      $_SESSION['status'] = "Task updated sucessfully!";
      $_SESSION['status_code'] = "success";
      exit();
    }
}

?>

<?php include "header.php"; ?>

<?php
if ( isset( $_GET[ 'id' ] ) ) {
    $id = $_GET[ 'id' ];

    $sql = "SELECT * FROM `tasks` WHERE `id`='$id'";
    $result = $conn->query( $sql );

    if ( $result->num_rows > 0 ) {

        while ( $row = $result->fetch_assoc() ) {
            $title = $row[ 'title' ];
            $description = $row[ 'description' ];
            $priority = $row[ 'priority' ];
            $due_date  = $row[ 'due_date' ];
        }
        ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
      datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <!-- CDN JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
    </script>
    <!-- Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <!-- datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap- 
      datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512- 
      GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFai
      oypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CSS -->
    <style>
    .desc_field {
      height: 200px;
      border-radius: var(--bs-border-radius);
      border: var(--bs-border-width) solid var(--bs-border-color);
    }
    
    </style>
  </head>
  <body>

  <form action="" method="POST">
    <section class="h-100" style="background-color: #eee;">
      <div class="container p-5">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11 d-flex justify-content-center align-items-center">
              <div class="card text-black col-6" style="border-radius: 25px;">
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-lg-8">

                      <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit task</p>

                      <form class="mx-1 mx-md-4" action="process.php" method="POST" autocomplete="off">

                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4cd"><b>Title</b></label>
                            <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                          </div>
                        </div>

                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-0">
                          <label class="form-label" for="form3Example4cd"><b>Description</b></label>
                            <textarea class="desc_field form-control" name = "description"><?php echo $description; ?></textarea>
                          </div>
                        </div>

                        <div class="form-outline flex-fill mb-4">
                          <label class="form-label" for="form3Example4cd"><b>Priority</b></label>
                            <select class="form-select" name="priority">
                              <?php
                              $options = array('Low','Medium','High'); // Example array of options
                              foreach ($options as $option) {
                                  if ($priority==$option){
                                    echo "<option value='" . $option . "' SELECTED>" . $option . "</option>";
                                  }
                                  else {
                                    echo "<option value='" . $option . "'>" . $option . "</option>";
                                  }
                                }
                              ?>
                            </select>
                        </div>
                        
                        
                        <div class="d-flex flex-row align-items-center mb-4">
                          <div class="form-outline flex-fill mb-4">
                            <label class="form-label" for="form3Example4cd"><b>Due Date</b></label>
                              <div class="row">
                                <div class="form-group">
                                    <input id="datepicker" class="form-control" type="date" name="due_date" value="<?php echo $due_date; ?>"/>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                          <a href="view_tasks.php"><input type="submit" name="submit" value="Update task" class="btn btn-primary"></a>
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
  </form>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script>

    $(document).ready(function(){
      // Initialize datepicker with desired format
      $('#datepicker').datepicker({
        format: 'yyyy-mm-dd', // Set the format to yyyy-mm-dd
        autoclose: true
      });
    });

</script>

</body>
</html>
<?php

} else {

    header( 'Location: view_tasks.php' );

}

}

?>

<?php include "footer.php"; ?>