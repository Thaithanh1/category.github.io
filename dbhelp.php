<?php
require_once ('connect.php');

function execute($sql){
	//save data into table
	//open connection to database
	$conn = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	pg_query($conn, $sql);
	//close connection
	pg_close($conn);
}
function executeResult($sql){
	//save data into table
	//open connection to database
	$conn = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = pg_query($conn, $sql);
	$data = [];
	if ($result != null){
		while ($row = pg_fetch_array($result, 1)){
			$data[] = $row;
		}
	}

	//close connection
	pg_close($conn);
	return $data;
}
function executeSingleResult($sql){
	//save data into table
	//open connection to database
	$conn = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete

	$result = pg_query($conn, $sql);
	$row = null;
	if ($result != null){
		$row = pg_fetch_array($result, 1);
	}
	//close connection
	pg_close($conn);
	return $row;
}
