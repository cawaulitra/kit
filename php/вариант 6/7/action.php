<?php

	/*
		Практическая работа №7
		Вариант 6:
		Реализовать обработку данных формы, при этом обязательные поля под номерами: 1, 2, 3, 4, 6, 14. (0, 1, 2, 3, 5 в массиве!)
		При этом если возраст человека меньше 20 лет, то он не может быть в 81 группе,
		если же 18 и больше, то не может быть в 82 группе.
		Также если суммарный размер дополнительных файлов не может превышать 40mb.
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
	$data = [];	// массив для считывания данных
	$err = [];	// массив для ошибок
	
	
	// isset - проверка на принятие данных
	// $_POST - супермассив данных, принимает данные из html-формы
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

	$avatarType = $_FILES["avatar"]["type"];					// записывает в переменную тип картинки, которую мы отправляем в качестве аватарки в форме
	@$avatarCheck = getimagesize($_FILES["avatar"]["tmp_name"]);// проверяет аватарку: если функция не срабатывает - значит, аватарка не является картинкой
	$fileNames = $_FILES["file"]["name"];						// записывает в переменную имена принятых файлов
	$fileNames = implode(', ', $fileNames);						// соединяет все имена принятых файлов в одну строку


	// проверка на обязательные поля
	// сначала фамилия, имя и отчество

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

	//дата рождения и группа должны быть заполнены
	if (empty($data[3])) 
		$err[] = "Пустая дата.";
	
	if (empty($data[5]))
		$err[] = "Пустая группа.";

	$date = new DateTime($data[3]);	// честно украденная
	$today = new DateTime();		// функция возраста со
	$age = $today->diff($date);		// Stack Overflow
	//echo $age->y;
	
	
	if (($data[5] == "81" and $age->y > 20) or					// основная проверка, отличается между вариантами
		($data[5] == "82" and $age->y <= 20) and $age->y >=18)	// если ты старше 20 лет - ты не можешь быть в 81 группе (1 курс)
		$err[] = "Возраст не совпадает с группой.";				// если ты младше 20 лет - ты не можешь быть в 82 группе (2 курс)


	if (empty($_FILES["file"]))
		$err[] = "Отсутствуют файлы.";
	if (array_sum($_FILES["file"]["size"]) > 41943040) //array_sum суммирует все числа в массиве, затем происходит проверка на выход из ограничения в 40 мегабайт
		$err[] = "Общий размер файлов превышает 40 мегабайт.";


	if (empty($err)) { // если массив с ошибками пустой - запускается вывод данных
	
		$avatar_tmp_name = $_FILES["avatar"]["tmp_name"];				// вся эта процедура необходима для
		$avatarName = $_FILES["avatar"]["name"];						// загрузки аватара на сервер, и затем
		move_uploaded_file($avatar_tmp_name, "avatar/$avatarName"); 	// его перемещения в нужную папку

		foreach ($_FILES ["file"]["error"] as $key => $error) {
			$files_tmp_name = $_FILES["file"]["tmp_name"][$key];		// тоже самое и здесь, но к тому же
			$filesName = $_FILES["file"]["name"][$key];					// если файлов несколько - производится их
			move_uploaded_file($files_tmp_name, "files/$filesName");	// нумерация в помощью foreach, а затем перекидывание в нужное место
		}
		
		
		if (empty($data[3])) $data[3] = "---"; // если не задавать необязательные поля - они преобразуются в прочерки
		
		if (empty($data[4])) $data[4] = "---";
		else {
			if ($data[4] == "M") $data[4] = "Мужской"; //преобразование M и W в Мужской и Женский соответственно
			if ($data[4] == "W") $data[4] = "Женский";
		}
		
		if (empty($data[5])) $data[5] = "---";
		if (empty($data[6])) $data[6] = "---";
		if (empty($data[7])) $data[7] = "---";
		if (empty($data[8])) $data[8] = "---";
		if (empty($data[9])) $data[9] = "---";
		
		if (empty($data[10])) $active = "---";
		else $active = implode(',', $data[10]); // data[10] содержит в себе массив увлечений, мы превращаем его
		$data[10] = $active;					// в строку для упрощения вывода с помощью функции implode(разделитель, массив)
												// в нашем случае разделитель является запятой, массив - $data[10], в котором
												// содержатся увлечения
		if (empty($data[11])) $data[11] = "---";
		
		echo "ФИО: $data[0] $data[1] $data[2]</br>";	// выводим полученную информацию
		echo "Дата рождения: $data[3]</br>";			// </br> используется для новой строки
		echo "Пол: $data[4]</br>";
		echo "Группа: $data[5]</br>";
		echo "Страна: $data[6]</br>";
		echo "Адрес: $data[7]</br>";
		echo "Телефон: $data[8]</br>";
		echo "E-mail: $data[9]</br>";
		echo "Увлечения: $data[10]</br>";
		echo "Дополнительно: $data[11]</br>";
	}
	
	else {													// если при вводе информации произошли ошибки - мы их выводим 
		echo "Запись данных не удалась. Причина:</br>"; 	// с помощью функции foreach, которая перебирает каждый элемент
		foreach ($err as $value) echo "$value</br>"; 		// массива (каждую ошибку в нашем случае) и выводит её на экран
	}
	
?>