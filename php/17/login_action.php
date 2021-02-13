<?php
	$conn = mysqli_connect('localhost', 'cawaulitra', '3343', 'forum');
	if(isset($_POST['login']))
	{ //mysqli_real_escape_string экранирует символы
		$query = mysqli_query($conn,"SELECT `id`, `password` FROM `users` WHERE login='".mysqli_real_escape_string($conn,$_POST['login'])."' LIMIT 1");
		$data = mysqli_fetch_assoc($query);

		if($data['password'] === md5(($_POST['password'])))
		{
			session_start();
			$_SESSION['login'] = $_POST['login'];
			header("Location: main.php"); exit();
		}
		else
		{
			echo "Ошибка: Неправильный логин или пароль.";
		}
	}
?>