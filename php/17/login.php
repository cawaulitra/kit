<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Форма</title>
	</head>
	<body>
		<div>
			<p>Авторизация
			<form action="login_action.php" method="post" enctype="multipart/form-data">
				<ul>
					<li>
						<input class="txt" type="text" name="login" id="login" placeholder="Логин*" value="">
					</li>
					<li>
						<input class="txt" type="password" name="password" id="password" placeholder="Пароль*" value="">
					</li>
					<li>
						<input type="submit" name="sub" value="Отправить">
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>