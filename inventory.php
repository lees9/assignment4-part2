<!DOCTYPE html>
<html>
<head>
<?php
    
    //connect to the database
    $mysqli = mysqli_connect("oniddb.cws.oregonstate.edu", "lees9-db", "JCwfOBRQArmk8Cqy", "lees9-db");
    if (mysqli_connect_errno($mysqli)) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else{
      echo "Connected to Video Inventory<br><br>";
    }

/*    function printTable($var){
          $res = $var->query("SELECT * FROM Inventory");
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
          echo "</td><td>";
          echo "<input type='submit' value='remove'>";
          echo "</td></tr>";
        }
        echo "</table><br><br>";
    }

    printTable($mysqli);*/





    //to make the dropdown select box
    $dropres = $mysqli->query("SELECT DISTINCT category FROM Inventory");
    echo "<form action='' method='GET' name='form_filter'>";
    echo "<select name='value'>";
    echo "<option value='all'>All Movies</option>";
    while ($row = mysqli_fetch_array($dropres)) {
        echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='filter'>";
    echo "</form>";
    echo "<br><br>";

    $query = $mysqli->query("SELECT * FROM Inventory");

    //to filter the table with the dropdown select box
    if (isset($_GET['value'])){
      if ($_GET['value'] != "all"){
          $categoryName = $_GET['value'];
          $query = $mysqli->query("SELECT * FROM Inventory WHERE category='$categoryName'");
      }
    }


    function printTable($var){
    //to print out the filtered box
    echo '<table border=2">';
    echo"<tr><td><strong>ID</strong></td><td><strong>Name</strong></td><td><strong>Category</strong></td><td><strong>Length</strong></td><td><strong>Rented</strong></td></tr>";
    while ($row = mysqli_fetch_array($var)){
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
      echo "</td><td>";
      echo "<input type='submit' value='remove'>";
      echo "</td></tr>";
    }
    echo "</table><br><br>";
  }

  printTable($query);





    mysqli_close($mysqli);

?>

</head>
<body>


    <form action="" method="POST">
      Name: <input type="text" name="title"><br><br>
      Category: <input type="text" name="category"><br><br>
      Length: <input type="number" name="length"><br><br>
      <input type="submit" name="submit" value="Add Movie">
    </form><br><br>
  </body>
  </html>