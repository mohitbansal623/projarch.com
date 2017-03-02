<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="sass/stylesheets/homepage.css">
</head>
<body>
<div class='list'>
</body>
</html>
<?php
  session_start();
  $uid = $_SESSION["uid"];
  $wid = $_GET['wid'];
  $dev = $_GET['dev'];
  // echo $dev . $wid . $_SESSION['uid'];
  require 'logoutdisplay.php';
  require 'database_connection.php';
  echo "<table class='table'> <tr><th>Task Name</th><th>Estimate Time</th><th>Description</th><th>Filter</th><th>Update</th></tr>";

    if (($_SESSION['uid'] == 1 & $dev != 1) || ($_SESSION['role'] == "Manager" & $dev != 1)) {
      echo "dewfwfeqv";
    $dev = "";
    $dev = $_GET['dev'];
    // List of tasks for the manager
    if (!empty($wid)) {
      $sql = "SELECT t.task_id, task_name, estimate_time, description, spent_time FROM task_create AS t JOIN developer AS d ON t.task_id = d.task_id WHERE t.workspace_id = " . $wid;
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $task_id = $row['task_id'];
          echo "<tr><td>" . $row['task_name'] . "</td><td>" . $row['estimate_time'] . "</td><td>" . $row['description']. "</td><td><a class ='list' href=/action/filter/". $task_id . "> Filter</a></td></tr>" ;
          echo "<br>"; 
      }
    }
      echo "</table>";
    }
  }

  // List of tasks for the developer
  else {
    echo "dwdw";
    $sql = "SELECT t.task_id, task_name, estimate_time, description, spent_time FROM task_create AS t JOIN developer AS d ON t.task_id = d.task_id WHERE d.user_id = " . $uid . " AND t.workspace_id= " . $wid;

  	$result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
         $task_id = $row['task_id'];
        echo "<tr><td>" . $row['task_name'] . "</td><td>" . $row['estimate_time'] . "</td><td>" . $row['description']. "</td><td><a class ='list' href=/action/filter/". $task_id . "> Filter by Date</a></td><td><a class='list' href=/action/timelog/" . $uid . "/". $task_id . ">Update</a></td></tr>" ;
        echo "<br>"; 
     }
   }  
  } 	
?>  