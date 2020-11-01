<?php

	/*
		Вариант 1:
		Реализовать обработку данных формы, при этом обязательные
		поля под номерами: 1, 2, 3, 10. При этом если пункт 10 не
		из диапазона адресов '.ru', выводить ошибку. Если условия
		не соблюдены выводится сообщение об ошибке. Если всё верно,
		выводить данные о пользователе в читабельном виде.
	*/
	
	$fio[0]		= ($_POST['secondName']);
	$fio[1]		= ($_POST['firstName']);
	$fio[2]		= ($_POST['thirdName']);
	$date		= ($_POST['date']);
	$gender		= ($_POST['gender']);
	$group		= ($_POST['group']);
	$country	= ($_POST['country']);
	$adress		= ($_POST['adress']);
	$phone		= ($_POST['phone']);
	$email		= ($_POST['email']);
	$active		= (@$_POST['active']); //Если человек ничем не увлекается - из .html будет возвращаться ничего, результируя ошибку. Знак @ прячет ошибку.
	$textbox	= ($_POST['textbox']);
	
	if (empty($fio[0])) echo "Ошибка: Пустая фамилия";
	elseif (stristr($fio[0], ' ')) echo "Ошибка: Пустая фамилия";
	if (empty($fio[1])) echo "Ошибка: Пустое имя";
	elseif (stristr($fio[1], ' ')) echo "Ошибка: Пустаое имя";
	if (empty($fio[2])) echo "Ошибка: Пустое отчество";
	elseif (stristr($fio[2], ' ')) echo "Ошибка: Пустое отчество";
	
	elseif ((mb_substr($email, strlen($email) - 3, 3)) != '.ru') echo "Ошибка: E-mail не из русского диапазона.";
	
	else {
		echo "ФИО: $fio[0] $fio[1] $fio[2]<br/>";
		echo "Дата рождения: $date<br/>";
		echo "Пол: "; if ($gender == "M") echo "Мужской";
					  if ($gender == "W") echo "Женский";
		echo "<br/>Группа: $group<br/>";
		echo "Страна: $country<br/>";
		echo "Адрес: $adress<br/>";
		echo "Телефон: $phone<br/>";
		echo "E-mail: $email<br/>";
		echo "Увлечения: "; if (empty($active)) echo "Ничем не увлекаешься, м-да.";
		else {
			$active = implode(', ', $active);
			echo $active . '.';		
		}
		echo "</br>Дополнительно: $textbox";
	}
?>