<?php

	/*
		Вариант 1:
		Реализовать обработку данных формы, при этом обязательные поля под
		номерами: 1, 2, 3, 10, 11.
		
		При этом если 10 пункт не из диапазона адресов '.ru' и 11 пункт не
		изображение формата jpg или png выводить ошибку.
		
		Если условия не соблюдены - выводить сообщение об ошибке.
		
		Если все верно - выводить данные о пользователе в отформатированном
		виде (сверстанная страничка пользователя).
	*/
		
	$fio[0]		= ($_POST['secondName']); 	// !
	$fio[1]		= ($_POST['firstName']); 	// !
	$fio[2]		= ($_POST['thirdName']);	// !
	$date		= ($_POST['date']);
	$gender		= (@$_POST['gender']); //@ убирает warning, если не выделен пол.
	$group		= ($_POST['group']);
	$country	= ($_POST['country']);
	$adress		= ($_POST['adress']);
	$phone		= ($_POST['phone']);
	$email		= ($_POST['email']);
	$active		= (@$_POST['active']); //@
	$textbox	= ($_POST['textbox']);

	$avatarType = $_FILES["avatar"]["type"];
	$avatarCheck = getimagesize($_FILES["avatar"]["tmp_name"]);
	$fileNames = $_FILES["file"]["name"];
	$fileNames = implode(', ', $fileNames);

	if (empty($fio[0])) 
		echo "Ошибка: Пустая фамилия.";
	elseif (stristr($fio[0], ' ')) 
		echo "Ошибка: В фамилии присутствует пробел.";
	elseif (empty($fio[1])) 
		echo "Ошибка: Пустое имя.";
	elseif (stristr($fio[1], ' ')) 
		echo "Ошибка: В имени присутствует пробел.";
	elseif (empty($fio[2])) 
		echo "Ошибка: Пустое отчество.";
	elseif (stristr($fio[2], ' ')) 
		echo "Ошибка: В отчестве присутствует пробел.";
		
	elseif (empty($email)) 
		echo "Ошибка: Пустой E-mail.";
	elseif ((mb_substr($email, strlen($email) - 3, 3)) != '.ru') 
		echo "Ошибка: E-mail не из русского диапазона.";
	
	elseif (empty($_FILES["avatar"])) 
		echo "Ошибка: Пустая аватарка.";
	elseif ($avatarType != "image/jpg" && $avatarType != "image/png" && $avatarType != "image/jpeg")
		echo "Ошибка: Аватар должен иметь формат png или jpg.";
	elseif ($avatarCheck == false)
		echo "Ошибка: Аватар не является изображением.";

	else {
		$avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
		$avatarName = $_FILES["avatar"]["name"];
		move_uploaded_file($avatar_tmp_name, "C:/xampp/htdocs/php/7/main/avatar/$avatarName");
		
		echo "ФИО: $fio[0] $fio[1] $fio[2]<br/>";
		echo "Дата рождения: $date<br/>";
		echo "Пол: "; if ($gender == "M") echo "Мужской";
					  if ($gender == "W") echo "Женский";
		echo "<br/>Группа: $group<br/>";
		echo "Страна: $country<br/>";
		echo "Адрес: $adress<br/>";
		echo "Телефон: $phone<br/>";
		echo "E-mail: $email<br/>";
		echo "Аватарка: ";
		print '<img src="avatar/' . $avatarName . '" height=150 width=228/></br>';
		echo "Увлечения: "; if (empty($active)) echo "Ничем не увлекаешься, м-да.</br>";
		else {
			$active = implode(', ', $active);
			echo $active . '.';		
		}
		echo "Дополнительно: $textbox</br>";
		echo "Ваши файлы: $fileNames</br>";
	}
?>