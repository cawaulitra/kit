<?php

	/*
		Практическая работа №9
		Используя материал практической работы №8 (файл со списком
		пользователей) реализовать поиск пользователя в файле.
		
		Для этого требуется использовать форму для ввода ФИО и
		кнопку поиск. После ввода ФИО и по нажатию на кнопку "поиск"
		в исходном файле ищется строка с соответствующим пользователем
		и на экран выводится номер этой строки. Если пользователя с
		введённым ФИО нет в файле - выводить соответствующее сообщение.
		Если результатов несколько - выводить номера списком.
	*/
		
	$err = []; //массив с ошибками
	$data = []; //массив с данными
	
	if(isset($_POST['secondName'])) $data[0]  = ($_POST['secondName']);
	if(isset($_POST['firstName'])) 	$data[1]  = ($_POST['firstName']);
	if(isset($_POST['thirdName'])) 	$data[2]  = ($_POST['thirdName']);


	if (stristr($data[0], ' ')) 
		trim($data[0]);
	if (empty($data[0]) && $data[0] = ' ') 
		$err[] = "Ошибка: Пустая фамилия.";
		
	if (stristr($data[1], ' ')) 
		trim($data[1]);
	if (empty($data[1]) && $data[1] = ' ') 
		$err[] = "Ошибка: Пустое имя.";
		
	if (stristr($data[2], ' ')) 
		trim($data[2]);
	if (empty($data[2]) && $data[2] = ' ') 
		$err[] = "Ошибка: Пустое отчество.";
		
	if (empty($err)) {
		$fio = implode ($data, ' ');
		echo "Параметры поиска: $fio</br>Начинаем поиск.</br>";
		
		$fp = fopen ('data/profiles.txt', 'r');
		$n = 1;
		$yes = 0;
		while(!feof($fp)) {
			$a = fgets ($fp);
			if (strpos($a, $fio) !== false) {
				echo "Совпадение на строке $n</br>";
				$yes = 1;
			}
			$n++;
		}
		if ($yes != 1) echo "Ничего не найдено.";
		fclose ($fp);
	}
	
	else foreach ($err as $value) echo "$value</br>";
?>