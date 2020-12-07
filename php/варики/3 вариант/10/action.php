<?php

	/*
		Практическая работа №10
		Создать скрипт авторизации пользователя на сайте
		при помощи сессии.
		
		1) Создать форму авторизации (логин и пароль);
		2) Реализовать алгоритм авторизации, сопоставляя данные с теми,
		которые установлены внутри файла скрипта;
		3) Пароль хранить в переменной, предварительно зашифровав значение
		при помощи функции md5().
	*/
		
	$err = []; //массив с ошибками
	$data = []; //массив с данными
	
	if(isset($_POST['login'])) 		$data[0] = ($_POST['login']);
	if(isset($_POST['password'])) 	$data[1] = ($_POST['password']);

	if (empty($data[0]) && $data[0] = ' ') 
		$err[] = "Ошибка: Пустой логин.";
	elseif (stristr($data[0], ' ')) 
		$err[] = "Ошибка: В логине присутствует пробел.";
		
	if (empty($data[1]) && $data[1] = ' ') 
		$err[] = "Ошибка: Пустой пароль.";
		
	if (empty($err)) {
		$pass = md5($data[1]);
		$fp = fopen ('data/profiles.json', 'r');
		$yes = 0;
		echo "Попытка входа...</br>Логин: $data[0]</br>";
		while (!feof($fp)) {
			$a = fgets ($fp);
			if (strpos($a, $data[0]) !== false) {
				$a = fgets ($fp);
				if (strpos ($a, $pass) !== false) {
					echo "Успешный вход.</br>";
					$yes = 1;
				}
			}
		}
		if ($yes != 1) echo "Неправильный логин или пароль.";
		else {
			session_start();
			$_SESSION["user"] = "$data[0]";
		}
		fclose($fp);
	}
	
	else {
		echo "Произошла ошибка. Причина: </br>";
		foreach ($err as $value) echo "$value</br>";
	}
?>