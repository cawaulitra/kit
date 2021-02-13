<?php
	session_start();
	echo "Добрый день, ";
	echo $_SESSION['login'];
	echo ". Сайт ещё делается :(";
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Форум</title>
	</head>
	<body>
		<div>
			<form action="logout.php" method="post">
				<ul>
					<li>
						<input type="submit" name="sub" value="Выйти">
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>