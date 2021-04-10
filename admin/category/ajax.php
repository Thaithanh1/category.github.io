<?php
require_once ('../../db2/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'delete':
				if (isset($_POST['name'])) {
					$id = $_POST['name'];
					$sql = 'delete from category where cat_name = '.$id;
					execute($sql);
				}
				break;
		}
	}
}