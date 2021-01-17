<?php

	/*
		Практическая работа №7
		Вариант 3:
		Реализовать обработку данных формы, при этом обязательные поля под
		номерами: 1, 2, 3, 7, 9, 11
		
		При этом страна и код телефона должны совпадать (Например: РФ начинается на +7)
		и фото должно не превышать 2 Мб.
		
		Если условия не соблюдены - выводить сообщение об ошибке.
		
		Если все верно - выводить данные о пользователе в отформатированном
		виде (сверстанная страничка пользователя).
	*/
		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="styless.css">
		<title>Профиль</title>
	</head>
	<body>
		<div class="a">
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

	if ($data[6] == "--Не выбрано--")
		$err[] = "Не выбрана страна.";
	
	if (empty($data[8]) && $data[8] = ' ')
		$err[] = "Пустой телефон.";
	elseif (stristr($data[8], ' '))
		$err[] = "В телефоне присутствует пробел.";
	
	if ($data[6] == "Грузия" && stristr($data[8], '+9') === FALSE ||
		$data[6] == "Россия" && stristr($data[8], '+7') === FALSE ||
		$data[6] == "Украина" && stristr($data[8], '+3') === FALSE) 
		$err[] = "Код телефона и страна не совпадают.";

	if (empty($_FILES["avatar"])) 
		$err[] = "Пустая аватарка.";
	elseif ($_FILES["avatar"]["error"] == 4) 
		$err[] = "Аватар не был загружен.";
	else { 
		if ($avatarType != "image/jpg" && $avatarType != "image/png" && $avatarType != "image/jpeg")
			$err[] = "Аватар должен иметь формат png или jpg.";
		if ($avatarCheck == false)
			$err[] = "Аватар не является изображением.";	
		if (filesize($_FILES["avatar"]["tmp_name"]) >= 2000000)
			$err[] = "Аватар превышает размер 2Мб.";
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
		
		if (empty($data[4])) $data[4] = "---";
		else {
			if ($data[4] == "M") $data[4] = "Мужской";
			if ($data[4] == "W") $data[4] = "Женский";
		}
		
		if (empty($data[10])) $active = "---";
		else $active = implode(', ', $data[10]);
		
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