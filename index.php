<!DOCTYPE html>
<html>
<head>
	<title>Final Project</title>
</head>
<body>
	<form method="POST">
		<input type="text" name="todo" id="todo">
		<button type="submit" name="submit">Add Task</button>
	</form>

<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'todo_list';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check Connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$todo = htmlspecialchars($_POST['todo']);

	// escape user inputs for security
	$todo = $conn->real_escape_string($_REQUEST['todo']);

	// creating a table for the todos	
	$sql = "CREATE TABLE todos (
		id INT(6) AUTO_INCREMENT,
		todo_name varchar(255) NOT NULL,
		PRIMARY KEY(id)
	)";
	if ($conn->query($sql)) {
		echo "Successfully created table todos";
	} else {
		echo "Error: " . $conn->error;
	}
	
	// inserting user input from form into database
	$sql = "INSERT INTO todos (todo_name) VALUES
	('$todo')";
	if ($conn->query($sql)) {
    		echo "Records inserted successfully!";
	} else {
    		echo "ERROR: Could not able to execute $sql. " . $conn->error;
}

	$sql = "SELECT * FROM todos;";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		echo " <br> This is your todo list: <br>";
		foreach ($result as $todo) {
			echo "ID: " . $todo['id'] . "<br>";
			echo "Todo: " . $todo['todo_name'] . "<br>";
		}
	} else {
		echo "There are 0 results";
	}

	$conn->close();

?>

</body>
</html>