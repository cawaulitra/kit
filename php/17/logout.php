<?php
	session_start();
	echo "Вы успешно вышли из аккаунта.";
	unset($_SESSION['login']);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title></title>
	</head>
	<body>
		<div>
			<form action="index.php" method="post">
				<ul>
					<li>
						<input type="submit" name="sub" value="На главную">
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>