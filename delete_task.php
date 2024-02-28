<?php session_start();

include "database.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $sql = "DELETE FROM `tasks` WHERE `id`='$id'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        header('Location: view_tasks.php');
    }
      else{
          echo "Error:" . $sql . "<br>" . $conn->error;
    }
} 