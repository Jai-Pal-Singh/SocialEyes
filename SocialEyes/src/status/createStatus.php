<?php
session_start ();
$id = "null";
include_once '../login/databaseConn.php';
$con = databaseConn ();

include 'upload.php';

$sql = "insert into jaipal.status (uid,content,picid,time) values (" . $_SESSION ['user'] ['id'] . ",'" . $_POST ['statusText'] . "'," . $id . ",now());";

$ret = pg_query ( $con, $sql );
if (! $ret) {
	echo pg_last_error ( $con );
} else {
	echo "Records created successfully\n";
}

header ( 'Location: ../../web/home.php' );
exit ( 0 );