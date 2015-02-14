<?php

function connect(){
    $mysqli = mysqli_connect("oniddb.cws.oregonstate.edu", "lees9-db", "JCwfOBRQArmk8Cqy", "lees9-db");
    if (mysqli_connect_errno($mysqli)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else{
      echo "Connected to lees9-db<br><br>";
    }
}

function closesql(){
  mysqli_close($mysqli);
}


function table(){
    $res = $mysqli->query("SELECT * FROM Inventory");
    echo '<table border=2">';
  echo"<tr><td><strong>ID</strong></td><td><strong>Name</strong></td><td><strong>Category</strong></td><td><strong>Length</strong></td><td><strong>Rented</strong></td></tr>";
  while($row = mysqli_fetch_array($res)){   
    echo "<tr><td>"; 
    echo $row['id'];
    echo "</td><td>";   
    echo $row['name'];
    echo "</td><td>";    
    echo $row['category'];
    echo "</td><td>";
    echo $row['length'];
    echo "</td><td>";
    if (is_null($row['rented'])){
      echo "Available";
    }
    else{
      echo "Checked out";
    }
    echo "</td></tr>";
  }
  echo "</table><br><br>";

}

function dropmenu(){
  $dropres = $mysqli->query("SELECT DISTINCT category FROM Inventory");
  echo "<form name='filter_form' method='POST' action='inventory.php'>";
  echo "<option value='all'>All Movies</option>";
  while ($row = mysqli_fetch_array($dropres)) {
      echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
  }
  echo "<input type='submit' name='filter' value='filter'>";
  echo "</form>";
  echo "<br><br>";

}

  
  if (isset($_POST['filter'])){

    $filter_term = $_POST['value'];

    $res .= "Where category = '{$filter_term}'";
  }


?>
