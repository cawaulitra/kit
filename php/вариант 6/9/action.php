<?php

	/*
		Практическая работа №9
		Используя материал практической работы №8 (файл со списком
		пользователей) реализовать поиск пользователя в файле.
		
		Для этого требуется использовать форму для ввода ФИО и
		кнопку поиск. После ввода ФИО и по нажатию на кнопку "поиск"
		в исходном файле ищется строка с соответствующим пользователем
		и на экран выводятся данные о пользователе в читаемом виде.
		Если пользователя с введенным ФИО нет в файле - выводить
		соответствующее сообщение. Если результатов несколько - 
		выводить несколько пользователей друг за другом.
	*/
		
	$err = [];
	$search = [];
	$data = [];
	
	if(isset($_POST['secondName'])) $search[0]  = ($_POST['secondName']);
	if(isset($_POST['firstName'])) 	$search[1]  = ($_POST['firstName']);
	if(isset($_POST['thirdName'])) 	$search[2]  = ($_POST['thirdName']);


	if (stristr($search[0], ' ')) //если в введенном слове есть пробелы - функция trim уберет их
		trim($search[0]);
	if (empty($search[0]) && $search[0] = ' ') 
		$err[] = "Пустая фамилия.";
		
	if (stristr($search[1], ' ')) 
		trim($search[1]);
	if (empty($search[1]) && $search[1] = ' ') 
		$err[] = "Пустое имя.";
		
	if (stristr($search[2], ' ')) 
		trim($search[2]);
	if (empty($search[2]) && $search[2] = ' ') 
		$err[] = "Пустое отчество.";
		
	if (empty($err)) {
		$fio = implode ($search, ' '); 
		echo "Параметры поиска: $fio</br>Начинаем поиск.</br>";
		
		$fp = fopen ('data/profiles.txt', 'r');
		$yes = 0;
		while(!feof($fp)) {
			$data = fgets ($fp);
			if (stristr($data, $fio)) { // ищет совпадение введенного ФИО и то, что у тебя есть в файле profiles.txt 
				echo "</br></br>Найдено совпадение! Вывод профиля:</br></br>";	// перед использованием поиска в этой работе
				$data = explode(' ', $data);									// необходимо сделать профили в прошлой работе
				echo "ФИО: $data[0] $data[1] $data[2]</br>";					// и перекинуть файл profiles.txt в эту работу
				echo "Дата рождения: $data[3]</br>";
				echo "Пол: $data[4]</br>";
				echo "Группа: $data[5]</br>";
				echo "Страна: $data[6]</br>";
				echo "Адрес: $data[7]</br>";
				echo "Телефон: $data[8]</br>";
				echo "E-mail: $data[9]</br>";
				echo "Увлечения: $data[10]</br>";
				echo "Дополнительно: $data[11]</br>";
				$yes = 1; //индикатор нахождения хотя бы одного профиля
			}
		}
		if ($yes != 1) echo "Ничего не найдено.";
		fclose ($fp);
	}
	
	else {
		echo "Не удалось начать поиск. Причина:</br>";
		foreach ($err as $value) echo "$value</br>";
	}
	
?>