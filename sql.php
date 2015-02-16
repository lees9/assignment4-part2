<!--  Name: Sang Hoon Lee
    Class: CS290 W15
    Assignment: 4 part 2
    Filename: sql.php
    Description: Contains the functions that utilizes queries to the SQL database.
    			 Incude quieries for getting the distinct categories, filtering
    			 by categories, adding movies, and removing movies.
    Date: 02/15/15
-->
<?php

class Sql {
	
	var $conn;

	function Sql() {
		//connect to the database
		$this->conn = mysqli_connect("oniddb.cws.oregonstate.edu", "lees9-db", "JCwfOBRQArmk8Cqy", "lees9-db");
		if (mysqli_connect_errno($this->conn)) {
			echo "Failed to connect to server<br><br>";
		} else{
			echo "Video Inventory Library<br><br>";
		}
	}

	//get categories from inventory for dropdown box
	function getCategories() {
		$dropres = $this->conn->query("SELECT DISTINCT category FROM Inventory");
		$categories = array();
		while ($row = mysqli_fetch_array($dropres)) {
			$categories[] = $row['category'];	
		}

		return $categories;
	}

	//take filter category and query for those rows
	function getFilteredRecords($filter) {
		$query = "SELECT * FROM Inventory WHERE 1=1";
		if ($filter !== 'all') {
			$query .= " and category='$filter'";
		}
		return $this->conn->query($query);
	}

	//function to add new movies
	function newRecord($title, $category, $length) {
		$query = "INSERT INTO Inventory (name, category, length) VALUES ('$title', '$category', '$length')";
		$this->conn->query($query);
	}

	//function to remove movies
	function removeOne($id) {
		$query = "DELETE FROM Inventory where id=$id";
		$this->conn->query($query);
	}

	//function to remove all movies
	function removeAll() {
		$query = "DELETE FROM Inventory";
		$this->conn->query($query);
	}

	//function to check out a movie or return
	function checkInOrOut($op, $id) {
		$newState = $op === 'checkin' ? 'false' : 'true';
		$query = "UPDATE Inventory SET rented=$newState WHERE id=$id";
		$this->conn->query($query);
	}
};

?>
