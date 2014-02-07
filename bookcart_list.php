<html>
<head>
<meta http-equiv='Content-Type' content='text/html' ; charset='utf-8'>
<style>
table {
	border: 1px solid gray;
	border-collapse: collapse;
}

td {
	border: 1px solid gray;
	padding: 5px;
}
</style>
</head>
<body>
<h1>찜목록</h1>
<?php
$conn = mysql_connect ( "localhost", "root", "apmsetup" );
mysql_query ( 'SET NAMES utf8' );
if (! $conn) {
	echo "Unable to connect to DB: " . mysql_error ();
	exit ();
}

if (! mysql_select_db ( "book" )) {
	echo "Unable to select mydbname: " . mysql_error ();
	exit ();
}

$sql = "SELECT *
        FROM  bookcart";

$result = mysql_query ( $sql );

if (! $result) {
	echo "Could not successfully run query ($sql) from DB: " . mysql_error ();
	exit ();
}

if (mysql_num_rows ( $result ) == 0) {
	echo "No rows found, nothing to print so am exiting";
	exit ();
}

// While a row of data exists, put that row in $row as an associative array
// Note: If you're expecting just one row, no need to use a loop
// Note: If you put extract($row); inside the following loop, you'll
// then create $userid, $fullname, and $userstatus
echo "<table width='100%'>";
echo "<tr><td>ISBN</td><td>제목</td><td>저자</td><td>원가</td><td>판매가</td><td>출판사</td></tr>";
while ( $row = mysql_fetch_assoc ( $result ) ) {
	echo "<tr><td>{$row['ISBN']}</td><td>{$row['book_title']}</td><td>{$row['book_author']}</td><td>{$row['book_price']}</td><td>{$row['hope_price']}</td><td>{$row['book_publisher']}</td></tr>";
}
echo "</table>";
mysql_free_result ( $result );
?>
</body>
</html>
