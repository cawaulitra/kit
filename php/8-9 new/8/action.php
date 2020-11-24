<?php

	/*
		Практическая работа №8
		Используя материал практической работы №6 (без загрузки файлов
		реализовать запись данных пользователей в файл. При каждом
		отправлении данных формы в файл добавляется новый пользователь
		(каждый новый пользователь это новая строка в файле). В файле
		хранится ТОЛЬКО информация без html-тегов.
	*/
		
	$err = []; //массив с ошибками
	$data = []; //массив с данными
	
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
		$err[] = "Ошибка: Пустая фамилия.";
	elseif (stristr($data[0], ' ')) 
		$err[] = "Ошибка: В фамилии присутствует пробел.";
		
	if (empty($data[1]) && $data[1] = ' ') 
		$err[] = "Ошибка: Пустое имя.";
	elseif (stristr($data[1], ' '))
		$err[] = "Ошибка: В имени присутствует пробел.";
		
	if (empty($data[2]) && $data[2] = ' ') 
		$err[] = "Ошибка: Пустое отчество.";
	elseif (stristr($data[2], ' ')) 
		$err[] = "Ошибка: В отчестве присутствует пробел.";
		
	if (empty($data[9])) 
		$err[] = "Ошибка: Пустой E-mail.";
	elseif (stristr($data[9], ' '))
		$err[] = "Ошибка: В E-mail присутствует пробел.";
		
	elseif ((mb_substr($data[9], strlen($data[9]) - 3, 3)) != '.ru') 
		$err[] = "Ошибка: E-mail не из русского диапазона.";
	
	if (empty($err)) {
		echo "ФИО: $data[0] $data[1] $data[2]<br/>";
		echo "Дата рождения: $data[3]<br/>";
		echo "Пол: ";	if (empty($data[4])) echo "-----</br>";
						else {
							if ($data[4] == "M") echo "Мужской</br>";
							if ($data[4] == "W") echo "Женский</br>";
						}
		echo "Группа: $data[5]<br/>";
		echo "Страна: $data[6]<br/>";
		echo "Адрес: $data[7]<br/>";
		echo "Телефон: $data[8]<br/>";
		echo "E-mail: $data[9]<br/>";
		echo "Увлечения: "; if (empty($data[10])) echo "Ничем не увлекаешься, м-да.</br>";
		else {
			$active = implode(', ', $data[10]);
			echo $active . '.<br/>';
		}
		echo "Дополнительно: $data[11]<br/>";
		
		//запись данных
		$fp = fopen ('data/profiles.json', 'a+');
		file_put_contents ('data/profiles.json', print_r ("$data[0] $data[1] $data[2]", true), FILE_APPEND);
		fwrite ($fp, PHP_EOL); //переход на новую строку
		file_put_contents ('data/profiles.json', print_r ($data, true), FILE_APPEND);
		fwrite ($fp, "END");
		fwrite ($fp, PHP_EOL); //
		fclose ($fp);
		echo "Данные записаны!";
	}
	
	else foreach ($err as $value) echo "$value</br>";
?>