<?php

//----------------------------------------------------------------------------------DATABASE SM
$servername = "localhost";
$database = ""; //ISIKAN NAMA DATABASE
$username = ""; //ISIKAN USERNAME DATABASE
$password = ""; //ISIKAN PASSWORD DATABASE

try {
	$conn = new PDO(
		"mysql:host=$servername; 
		dbname=$database;",
		$username,
		$password
	);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
?>
	<script>
		document.location.href = "_error/error503.php"
	</script>
<?php
}
