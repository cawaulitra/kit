<?php

	/*
		Практическая работа №6
		Вариант 3:
		Реализовать обработку данных формы, при этом обязательные поля под номерами: 1, 2, 3, 7, 9. (0, 1, 2, 6, 8 в массиве!)
		При этом страна и код телефона должны совпадать (например, РФ начинается на +7).
		Если условия не соблюдены - выводить сообщение об ошибке.
		Если все верно - выводить данные о пользователе в читабельном виде.
	*/
		
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



	if (empty($err)) {
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