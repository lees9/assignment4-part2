<!--  Name: Sang Hoon Lee
    Class: CS290 W15
    Assignment: 4 part 2
    Filename: render.php
    Description: Contains the rendering of the inventory page.
    Date: 02/15/15
-->
<!DOCTYPE html>
<html>
<head>
</head>
<body>

  <!--make the drop down box-->
  <form action='inventory.php' method='POST' name='form_filter'>
  	<input type="hidden" name="operation" value="filter">
    <select name='value'>
      <option value='all'>All Movies</option>
      <?php foreach ($categories as &$c) {
        echo "<option value='" . $c . "'>" . $c . "</option>";
        } ?>
    </select>
    <input type='submit' value='filter'>
  </form>
<br><br>

    <!-- make the text input forms-->
    <form action="inventory.php" method="POST">
	   <input type="hidden" name="operation" value="insert">
      Name: <input type="text" name="title"><br><br />
      Category: <input type="text" name="category"><br><br />
      Length: <input type="number" name="length"><br><br />
      <input type="submit" name="submit">
    </form><br><br>

<?php
    
    //function for remove buttons
    function buildRomoveButton($id) {
	   $subStr = 'Remove';
	   $opValue = 'remove';
	   if (!$id)  {
		    $subStr = 'Remove All';
		    $opValue = 'remove_all';
	   }

     //make the buttons
echo <<<END
<form action='inventory.php' method='POST' name='addrem'>
<input type="hidden" name="operation" value="$opValue"> 
<input type="hidden" name="id" value="$id">
<input type='submit' value='$subStr'>
</form>
END;
}
    //function for check out or return buttons
    function buildCheckoutButton($row) {
    $id = $row['id'];
    $op = 'checkout';
    $value = 'Check out';
    $st = 'Available';

    if ($row['rented'] === '1') {
      $op = 'checkin';
      $st = 'Checked out';
      $value = 'Return';
  }

  //make the buttons
echo <<<END
$st
<form action='inventory.php' method='POST' name='addrem'>
<input type="hidden" name="operation" value="$op"> 
<input type="hidden" name="id" value="$id">
<input type='submit' value='$value'>
</form>
END;
}
    
    //function to print the table
    function printTable($var){
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
	    buildCheckoutButton($row);
      echo "</td><td>";
	    buildRomoveButton($row['id']);
      echo "</td></tr>";
    }

    echo "<tr><td>";
	  buildRomoveButton(null);
    echo "</td></tr>";
    echo "</table><br><br>";
  }

	printTable($filteredRecords);  //call print tables

?>

  </body>
</html>
