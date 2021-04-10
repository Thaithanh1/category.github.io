<?php
require_once ('config.php');

function execute($sql){
	//save data into table
	//open connection to database
	$con = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	pg_query($con, $sql);
	//close connection
	pg_close($con);
}
function executeResult($sql){
	//save data into table
	//open connection to database
	$con = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = pg_query($con, $sql);
	$data = [];
	if ($result != null){
		while ($row = pg_fetch_array($result, 1)){
			$data[] = $row;
		}
	}

	//close connection
	pg_close($con);
	return $data;
}
function executeSingleResult($sql){
	//save data into table
	//open connection to database
	$con = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete

	$result = pg_query($con, $sql);
	$row = null;
	if ($result != null){
		$row = pg_fetch_array($result, 1);
	}
	//close connection
	pg_close($con);
	return $row;
}