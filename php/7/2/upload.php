<?php

	/*
		Задание 1: Реализовать у себя на сервере форму загрузки файла.
		Также в файле upload.php продемонстрировать на экран содержимое
		массива $_FILES, а также всех промежуточных переменных, чтобы
		увидеть, что где хранится и в каком виде.
	*/
		
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
	// Проверяем, является ли файл изображением
	if (isset($_POST["submit"])) {
		@$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]); //@ убирает Notice.
		if ($check !== false) {
			echo "Файл является изображением - " . $check["mime"] . ".</br></br>";
			$uploadOk = 1;
		}
		else {
			echo "Файл не является изображением.</br></br>";
			$uploadOk = 0;
		}
	}
	var_dump ($_FILES);							//вывод всего массива
	echo "</br>Папка: $target_dir";				//папка
	echo "</br>Путь до файла: $target_file";	//путь до файла
	echo "</br>Разрешить загрузку: $uploadOk";	//индикатор загрузки?
	echo "</br>Тип файла: $imageFileType";		//тип изображения
?>