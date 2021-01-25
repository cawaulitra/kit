<?php

	/*
		Практическая работа №8
		Используя материал практической работы №6 (без загрузки файлов)
		реализовать запись данных пользователей в файл. При каждом
		отправлении данных формы в файл добавляется новый пользователь
		(каждый новый пользователь это новая строка в файле). В файле
		хранится ТОЛЬКО информация без html-тегов.
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

	if (empty($err)) {
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
		else $active = implode(',', $data[10]);
		$data[10] = $active;
		
		if (empty($data[11])) $data[11] = "---";
		
		echo "ФИО: $data[0] $data[1] $data[2]</br>";
		echo "Дата рождения: $data[3]</br>";
		echo "Пол: $data[4]</br>";
		echo "Группа: $data[5]</br>";
		echo "Страна: $data[6]</br>";
		echo "Адрес: $data[7]</br>";
		echo "Телефон: $data[8]</br>";
		echo "E-mail: $data[9]</br>";
		echo "Увлечения: $data[10]</br>";
		echo "Дополнительно: $data[11]</br>";
		
		//запись
		
		$fp = fopen ('data/profiles.txt', 'a+');
		foreach ($data as $key => $values) {
			fwrite ($fp, "$data[$key] ");
		}
		fwrite ($fp, PHP_EOL);
		fclose ($fp);
		echo "Данные записаны!";
	}
	
	else {
		echo "Запись данных не удалась. Причина:</br>";
		foreach ($err as $value) echo "$value</br>";
	}
	
?>