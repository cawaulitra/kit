<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Форма</title>
	</head>
	<body>
		<div>
			<p>Регистрация
			<form action="register_action.php" method="post" enctype="multipart/form-data">
				<ul>
					<li>
						<input class="txt" type="text" name="login" id="login" placeholder="Логин*" value="">
					</li>
					<li>
						<input class="txt" type="text" name="email" id="email" placeholder="E-mail*" value="">
					</li>
					<li>
						<input class="txt" type="password" name="password_r" id="password_r" placeholder="Пароль*" value="">
					</li>
					<li>
						<input class="txt" type="password" name="password_c" id="password_c" placeholder="Повторите пароль*" value="">
					</li>
					<li>
						<input type="submit" name="sub" value="Отправить">
					</li>
				</ul>
			</form>
		</div>
	</body>
</html>