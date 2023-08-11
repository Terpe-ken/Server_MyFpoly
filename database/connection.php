<?php
$databaseHost = 'localhost';
$databaseName = 'id21127739_wp_a9aadda699a46d0ff29487f79da01b85';
$databaseUsername = 'id21127739_wp_a9aadda699a46d0ff29487f79da01b85';
$databasePassword = 'Datne03@@';

try {
	$dbConn = new PDO("mysql:host={$databaseHost};dbname={$databaseName}", 
						$databaseUsername, $databasePassword);
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo $e->getMessage();
}