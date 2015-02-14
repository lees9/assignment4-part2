<!DOCTYPE html>
<html>
<head>
<?php

$mysqli = mysqli_connect("oniddb.cws.oregonstate.edu", "lees9-db", "JCwfOBRQArmk8Cqy", "lees9-db");
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else{
 	echo "Connected to lees9-db<br><br>";
}

$res = $mysqli->query("SELECT id, name, category, length, rented FROM Inventory");
$res->data_seek(0);
echo '<table border=2">';
echo"<tr><td>ID</td><td>Name</td><td>Category</td><td>Length</td><td>Rented</td></tr>";
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

$res->data_seek(0);
echo "<form method='GET'>";
echo "<select name='dropdown'>"; 
echo "<option value='all'>All Movies</option>";
while ($row = mysqli_fetch_array($res)) {
    echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
}
echo "</select>";
echo "<input type='submit'>";
echo "<br><br>";
echo "</form>";

?>

</head>

	<body>
<!-- 		<form action="" method="GET">
 			<select name="dropdown">
				<option value="">All Movies</option>
				<option value="categories">categories</option>
			</select>
			<input type="submit" name="filter" value="">
		</form><br><br> -->

		<form action="" method="GET">
			Name: <input type="text" name="title"><br><br>
			Category: <input type="text" name="category"><br><br>
			Length: <input type="number" name="length"><br><br>
			<input type="submit" name="add" value="Add Movie">
		</form><br><br>



	</body>
</html>

