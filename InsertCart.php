<html>
<head>
<meta http-equiv='Content-Type' content='text/html' ; charset='utf-8'>
</head>
<body>
		<?php
		$isbn = $_POST ['ISBN'];
		$book_title = $_POST ['book_title'];
		$book_author = $_POST ['book_author'];
		$book_price = $_POST ['book_price'];
		$hope_price = $_POST ['hope_price'];
		$book_publisher = $_POST ['book_publisher'];
		$id = 'root';
		$pw = 'apmsetup';
		
		if (! $isbn || ! $book_title || ! $book_author || ! $book_price || ! $hope_price || ! $book_publisher) {
			echo 'You have not entered all the required details.<br/>' . 'Please go back and try again.';
			exit ();
		}
		
		echo "test<br>";
		
		if (! get_magic_quotes_gpc ()) {
			$isbn = addslashes ( $isbn );
			$book_title = addslashes ( $book_title );
			$book_author = addslashes ( $book_author );
			$book_price = doubleval ( $book_price );
			$hope_price = doubleval ( $hope_price );
			$book_publisher = addslashes ( $book_publisher );
		}
		
		$db = mysqli_connect ( 'localhost', $id, $pw, 'book' );
		mysqli_query ( $db, "set names utf8" );
		
		if (mysqli_connect_errno ()) {
			echo 'Error: Could not connect to database. Please try again later.';
			exit ();
		}
		
		$query = "insert into bookcart values ('" . $isbn . "', '" . $book_title . "', '" . $book_author . "', '" . $book_price . "', '" . $hope_price . "', '" . $book_publisher . "')";
		
		$result = mysqli_query ( $db, $query ) or die ( 'Error connecting to MySQL server.' );
		
		if ($result) {
			echo sucess;
		}
		mysqli_close ( $db );
		
		echo ("
		<script>
		history.go(-1)
		</script>
		");
		?>
</body>
</html>