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

    //to make the dropdown select box
    $dropres = $mysqli->query("SELECT DISTINCT category FROM Inventory");
    echo "<form action='' method='POST' name='form_filter'>";
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
    if (isset($_POST['value'])){
      if ($_POST['value'] != "all"){
          $categoryName = $_POST['value'];
          $query = $mysqli->query("SELECT * FROM Inventory WHERE category='$categoryName'");
      }
    }


    //to add to the table
    if (isset($_POST['title']) && isset($_POST['category']) && isset($_POST['length'])){
      $title = $_POST['title'];
      $category = $_POST['category'];
      $length = $_POST['length'];
      echo $title;
      echo $category;
      echo $length;
      $mov_add = $mysqli->query("INSERT INTO Inventory(name, category, length) VALUES ($title, $category, $length)");
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
      echo "<form action='' method='GET' name='addrem'><input type='submit' value='remove'></form>";
      echo "</td></tr>";
    }
    echo "<tr><td><form action='' method='GET' name='deleteall'><input type='submit' value='Remove all'></form></td></tr>";
    echo "</table><br><br>";
  }

  printTable($query);




    mysqli_close($mysqli);

?>

</head>
<body>


    <form action="" method="POST" name='additions'>
      Name: <input type="text" name="title"><br><br>
      Category: <input type="text" name="category"><br><br>
      Length: <input type="number" name="length"><br><br>
      <input type="submit" name="submit">
    </form><br><br>
  </body>
  </html>