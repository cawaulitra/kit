<?php

	/*
		Задание 2: Реализовать у себя на сервере форму загрузки множественных
		файлов. Добавить ограничения.
	*/
	$uploadOk = 1;
	foreach ($_FILES ["pictures"]["size"] as $key => $size) { //проверка на размер
		if ($size > 500000) {
			echo "Файл под номером $key слишком большой.</br>";
			$uploadOk = 0;
		}
	}
	
	foreach ($_FILES ["pictures"]["type"] as $key => $type) { //проверка на расширение
		if ($type != "image/jpg" && $type != "image/png" && $type != "image/gif" && $type != "image/jpeg") {
			echo "Файл под номером $key не имеет формат jpeg, jpg, gif или png.</br>";
			$uploadOk = 0;
		}
	}
	
	if ($uploadOk == 0) { //при любом нарушении ограничения файлы не будут скачаны
		echo "Ваш(и) файл(ы) не был(и) загружен(ы).</br>";
	}
	else {
		foreach ($_FILES ["pictures"]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["pictures"]["tmp_name"][$key];
				$name = $_FILES["pictures"]["name"][$key];
				move_uploaded_file($tmp_name, "C:/xampp/htdocs/php/7/2/img/$name");
			}
		}
		echo "Ваши файлы успешно загружены!</br>";
	}
	//var_dump ($_FILES);
?>