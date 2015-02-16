<!--  Name: Sang Hoon Lee
    Class: CS290 W15
    Assignment: 4 part 2
    Filename: inventory.php
    Description: Contains the functions and method to filter by category,
    			 add movies, and remove movies.
    Date: 02/15/15
-->
<?php
	include_once('sql.php');

	//function to filter by category name
	function getFilter() {
		if (isset($_POST['value'])){
			if ($_POST['value'] != "all"){
				$categoryName = $_POST['value'];
				return $categoryName;
			}
		}
		return 'all';
	}


	//function to return post operation
	function getOperation() {
		if (isset($_POST['operation'])){
			return $_POST['operation'];
		}
		return "index";
	}

	$sql = new Sql();
	$categories = $sql->getCategories();	//get the distinct categories


	//from post operations for adding movie, removing movie, check in and out
	$op = getOperation();
	if ($op === 'insert') {
		$title = $_POST['title'];
		$category = $_POST['category'];
		$length = $_POST['length'];
		$sql->newRecord($title, $category, $length);	
	} else if ($op === 'remove') {
		$id = $_POST['id'];
		$sql->removeOne($id);	
	} else if ($op === 'remove_all') {
		$sql->removeAll();
	} else if ($op === 'checkout' || $op === 'checkin') {
		$id = $_POST['id'];	
		$sql->checkInOrOut($op, $id);
	}

	//get filter category
	$filter = getFilter();

	//call function to get filtered records and set to $filteredRecords to be printed
	$filteredRecords = $sql->getFilteredRecords($filter);

	include 'render.php';

?>

