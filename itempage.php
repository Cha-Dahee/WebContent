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
 
 
<script>
function Popup(){
	var width = 350;
	var height = 200;
	var top = (screen.availHeight - height) / 2;
    var left = (screen.availWidth - width) / 2;

    var features;
    features= 'height='+height+',width='+width+',top='+top+',left='+left;
	window.open('additemToCartResult.html','찜 확인창',features);
	
}
</script>

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
        FROM  book_list
        WHERE 저자='저자1'";

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
echo "<table>";
while ( $row = mysql_fetch_assoc ( $result ) ) {
	echo "<tr><td>{$row['제목']}</td><td>{$row['ISBN']}</td><td>{$row['저자']}</td><td>{$row['출판사']}</td><td>{$row['원가']}</td><td>{$row['희망가격']}</td></tr>";
	echo '<form action="InsertCart.php" method="POST" onsubmit="Popup()">';
	echo '<input type="text" name="ISBN" value='; echo "{$row['ISBN']}>";
	echo '<input type="text" name="book_title" value='; echo "{$row['제목']}>"; 
	echo '<input type="text" name="book_author" value='; echo "{$row['저자']}>";
	echo '<input type="text" name="book_price" value='; echo "{$row['원가']}>";
	echo '<input type="text" name="hope_price" value='; echo "{$row['희망가격']}>";
	echo '<input type="text" name="book_publisher" value='; echo "{$row['출판사']}>";
	echo '<input type="submit" value="장바구니로">';
	echo '</form>';
}
echo "</table>";
mysql_free_result ( $result );
?>

</body>
</html>

