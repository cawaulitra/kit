<?php
	$err = [];
	$data = [];

	if(isset($_POST['login'])) 		$data[0]  = 		($_POST['login']);
	if(isset($_POST['email'])) 		$data[1]  = 		($_POST['email']);
	if(isset($_POST['password_r'])) $data[2]  = 	($_POST['password_r']);
	if(isset($_POST['password_c'])) $data[3]  = 	($_POST['password_c']);						
									
	if (empty($data[0]) && $data[0] = ' ') 
		$err[] = "Пустой логин.";
	elseif (stristr($data[0], ' ')) 
		$err[] = "В логине присутствует пробел.";
				
	if (empty($data[1]) && $data[1] = ' ')
		$err[] = "Пустой E-mail.";
	elseif (stristr($data[1], ' ')) 
		$err[] = "В E-mail присутствует пробел.";
	elseif (is_numeric(strripos($data[1], '@')) != true)
		$err[] = "Неверная запись E-mail, отсутствует @.";
				
	if (empty($data[2]) && $data[2] = ' ') 
		$err[] = "Пустой пароль.";
				
	if (empty($data[3]) && $data[3] = ' ') 
		$err[] = "Пустое подтверждение пароля.";
			
	if ($data[2] != $data[3])
		$err[] = "Пароли не совпадают.";
				
		
	if (empty($err)) { 
		$data[2] = md5($data[2]);
		
		$conn = mysqli_connect('localhost', 'cawaulitra', '3343', 'forum');
		
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
 
		$sql = "INSERT INTO `users` (`login`, `email`, `password`) VALUES ('$data[0]', '$data[1]', '$data[2]')";
		if (mysqli_query($conn, $sql)) {
			echo "Регистрация успешна!";
		}
		else {
			echo "Регистрация не удалась. Причина: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
			
	else {													
		echo "Регистрация не удалась. Причина:</br>"; 	
		foreach ($err as $value) echo "$value</br>"; 	
	}			
			


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