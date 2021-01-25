<?php

	/*
		Практическая работа №7
		Вариант 5:
		Реализовать обработку данных формы, при этом обязательные поля под номерами: 1, 2, 3, 9, 10, 11. (0, 1, 2, 8, 9 в массиве!)
		При этом пункты 9 и 10 должны быть корректного формата.
		При этом 11 пункт может быть только изображением jpg не превышающий разрешение изображения 1000x900.
		Если условия не соблюдены - выводить сообщение об ошибке.
		Если все верно - выводить данные о пользователе в читабельном виде.
	*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Профиль</title>
	</head>
	<body>
		<div>
			<p class="php">Ваш профиль:
			<ul><li>
			<?php
	$err = [];
	$data = [];
	
	if(isset($_POST['secondName'])) $data[0]  = ($_POST['secondName']);
	if(isset($_POST['firstName'])) 	$data[1]  = ($_POST['firstName']);
	if(isset($_POST['thirdName'])) 	$data[2]  = ($_POST['thirdName']);
	if(isset($_POST['date'])) 		$data[3]  = ($_POST['date']);
	if(isset($_POST['gender'])) 	$data[4]  = ($_POST['gender']);
	if(isset($_POST['group'])) 		$data[5]  = ($_POST['group']);
	if(isset($_POST['country'])) 	$data[6]  = ($_POST['country']);
	if(isset($_POST['adress'])) 	$data[7]  = ($_POST['adress']);
	if(isset($_POST['phone'])) 		$data[8]  = ($_POST['phone']);
	if(isset($_POST['email'])) 		$data[9]  = ($_POST['email']);
	if(isset($_POST['active'])) 	$data[10] = ($_POST['active']);
	if(isset($_POST['textbox'])) 	$data[11] = ($_POST['textbox']);


	$avatarType = $_FILES["avatar"]["type"];
	@$avatarCheck = getimagesize($_FILES["avatar"]["tmp_name"]);
	$fileNames = $_FILES["file"]["name"];
	$fileNames = implode(', ', $fileNames);


	if (empty($data[0]) && $data[0] = ' ') 
		$err[] = "Пустая фамилия.";
	elseif (stristr($data[0], ' ')) 
		$err[] = "В фамилии присутствует пробел.";
		
	if (empty($data[1]) && $data[1] = ' ') 
		$err[] = "Пустое имя.";
	elseif (stristr($data[1], ' '))
		$err[] = "В имени присутствует пробел.";
		
	if (empty($data[2]) && $data[2] = ' ') 
		$err[] = "Пустое отчество.";
	elseif (stristr($data[2], ' ')) 
		$err[] = "В отчестве присутствует пробел.";

	if (empty($data[8]) && $data[8] = ' ')
		$err[] = "Пустой номер телефона.";
	elseif (stristr($data[8], ' ')) 
		$err[] = "В номере телефона присутствует пробел.";
	elseif (strlen($data[8]) != 12 ||  (substr($data[8], 0, 2) != "+8" and
										substr($data[8], 0, 2) != "+7"))
		$err[] = "Неверная запись номера телефона. Должен содержать 12 символов, начало с +7, +8";
	
	if (empty($data[9]) && $data[9] = ' ')
		$err[] = "Пустой E-mail.";
	elseif (stristr($data[9], ' ')) 
		$err[] = "В E-mail присутствует пробел.";
	elseif (is_numeric(strripos($data[9], '@')) != true || (substr($data[9], - 4, 4) != ".com" and 
															substr($data[9], - 3, 3) != ".ru" and 
															substr($data[9], - 3, 3) != ".ua"))
		$err[] = "Неверная запись E-mail. Должнен содержать @, разрешенные почты - .com, .ru, .ua";

	if (empty($_FILES["avatar"])) 
		$err[] = "Пустая аватарка.";
	elseif ($_FILES["avatar"]["error"] == 4) 
		$err[] = "Аватар не был загружен.";
	else { 
		if ($avatarCheck['mime'] != "image/jpeg")
			$err[] = "Аватар должен иметь формат jpg.";
		if ($avatarCheck == false)
			$err[] = "Аватар не является изображением.";	
		if ($avatarCheck[0] > 1000 or $avatarCheck[1] > 900)
			$err[] = "Аватар превышает разрешение 1000x900.";
	}



	if (empty($err)) {
		
		
		$avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
		$avatarName = $_FILES["avatar"]["name"];
		move_uploaded_file($avatar_tmp_name, "avatar/$avatarName");

		foreach ($_FILES ["file"]["error"] as $key => $error) {
			$files_tmp_name = $_FILES["file"]["tmp_name"][$key];
			$filesName = $_FILES["file"]["name"][$key];
			move_uploaded_file($files_tmp_name, "files/$filesName");
		}
		
		
		if (empty($data[3])) $data[3] = "---";
		
		if (empty($data[4])) $data[4] = "---";
		else {
			if ($data[4] == "M") $data[4] = "Мужской";
			if ($data[4] == "W") $data[4] = "Женский";
		}
		
		if (empty($data[5])) $data[5] = "---";
		if (empty($data[6])) $data[6] = "---";
		if (empty($data[7])) $data[7] = "---";
		
		if (empty($data[10])) $active = "---";
		else $active = implode(', ', $data[10]);
		
		if (empty($data[11])) $data[11] = "---";
		
		echo "ФИО: $data[0] $data[1] $data[2]</br>";
		echo "Дата рождения: $data[3]</br>";
		echo "Пол: $data[4]</br>";
		echo "Группа: $data[5]</br>";
		echo "Страна: $data[6]</br>";
		echo "Адрес: $data[7]</br>";
		echo "Телефон: $data[8]</br>";
		echo "E-mail: $data[9]</br>";
		echo "Увлечения: $active</br>";
		echo "Дополнительно: $data[11]</br>";
	}
	
	else {
		echo "Запись данных не удалась. Причина:</br>";
		foreach ($err as $value) echo "$value</br>";
	}
			?>
			</li></ul>
		</div>
	</body>
</html>