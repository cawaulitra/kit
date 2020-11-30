<?php

	/*
		Практическая работа №11
		Реализовать практическую работу №8 при помощи класса. При
		отправке данных формы будет создаваться объект класса,
		заполняться его свойства, выполняться методы проверки 
		(по вариантам) после чего должен будет выполняться метод
		записи в файл данных.
		
		Примечание: Все поля формы должны быть описаны в классе.
		Каждая проверка должна быть описана методом. Сохранение
		информации в файл так же должен быть оформлен как отдельный
		метод класса.
	*/
	
	class Form {
		
		private $data = [];
		private $err = [];


		
		function __construct() {
			if(isset($_POST['secondName'])) $this->data[0]  = ($_POST['secondName']);
			if(isset($_POST['firstName'])) 	$this->data[1]  = ($_POST['firstName']);
			if(isset($_POST['thirdName'])) 	$this->data[2]  = ($_POST['thirdName']);
			if(isset($_POST['date'])) 		$this->data[3]  = ($_POST['date']);
			if(isset($_POST['gender'])) 	$this->data[4]  = ($_POST['gender']);
			if(isset($_POST['group'])) 		$this->data[5]  = ($_POST['group']);
			if(isset($_POST['country'])) 	$this->data[6]  = ($_POST['country']);
			if(isset($_POST['adress'])) 	$this->data[7]  = ($_POST['adress']);
			if(isset($_POST['phone'])) 		$this->data[8]  = ($_POST['phone']);
			if(isset($_POST['email'])) 		$this->data[9]  = ($_POST['email']);
			if(isset($_POST['active'])) 	$this->data[10] = ($_POST['active']);
			if(isset($_POST['textbox'])) 	$this->data[11] = ($_POST['textbox']);
		}
		
		
		
		function Check() {
			if (empty($this->data[0]) && $this->data[0] = ' ') 
				$this->err[] = "Ошибка: Пустая фамилия.";
			elseif (stristr($this->data[0], ' ')) 
				$this->err[] = "Ошибка: В фамилии присутствует пробел.";
		
			if (empty($this->data[1]) && $this->data[1] = ' ') 
				$this->err[] = "Ошибка: Пустое имя.";
			elseif (stristr($this->data[1], ' '))
				$this->err[] = "Ошибка: В имени присутствует пробел.";
		
			if (empty($this->data[2]) && $this->data[2] = ' ') 
				$this->err[] = "Ошибка: Пустое отчество.";
			elseif (stristr($this->data[2], ' ')) 
				$this->err[] = "Ошибка: В отчестве присутствует пробел.";
		
			if (empty($this->data[9])) 
				$this->err[] = "Ошибка: Пустой E-mail.";
			elseif (stristr($this->data[9], ' '))
				$this->err[] = "Ошибка: В E-mail присутствует пробел.";
			elseif ((mb_substr($this->data[9], strlen($this->data[9]) - 3, 3)) != '.ru') 
				$this->err[] = "Ошибка: E-mail не из русского диапазона.";
		}
		
		
		
		function Write() {
			if (empty($this->err)) {
				
				echo "ФИО: " . $this->data[0] . " " . $this->data[1] . " " . $this->data[2] . "</br>";
				echo "Дата рождения: " . $this->data[3] . "</br>";
				echo "Пол: ";	
					if (empty($this->data[4])) echo "-----</br>";
					else {
						if ($this->data[4] == "M") echo "Мужской</br>";
						if ($this->data[4] == "W") echo "Женский</br>";
						}
				echo "Группа: " . $this->data[5] . "</br>";
				echo "Страна: " . $this->data[6] . "</br>";
				echo "Адрес: " . $this->data[7] . "</br>";
				echo "Телефон: " . $this->data[8] . "</br>";
				echo "E-mail: " . $this->data[9] . "</br>";
				echo "Увлечения: "; 
					if (empty($this->data[10])) echo "-----</br>";
					else {
						$active = implode(', ', $this->data[10]);
						echo $active . '.<br/>';
					}
				echo "Дополнительно: " . $this->data[11] . "<br/>";
			}
			else foreach ($this->err as $value) echo "$value</br>";
		}
		
		
		
		function Writing() {
			if (empty($this->err)) {
				//запись данных
				$fp = fopen ('data/profiles.json', 'a+');
				file_put_contents ('data/profiles.json', print_r 
				($this->data[0] . " " . $this->data[1] . " " .  $this->data[2], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL); //переход на новую строку
				file_put_contents ('data/profiles.json', print_r ($this->data, true), FILE_APPEND);
				fwrite ($fp, "END");
				fwrite ($fp, PHP_EOL); //
				fclose ($fp);
				echo "Данные записаны!";
				}
			else echo "Запись данных не удалась.";
			}
		}
	
	
	
	$form = new Form();
	if (!empty($_POST)) {
		$form->Check();
		$form->Write();
		$form->Writing();
	}
?>