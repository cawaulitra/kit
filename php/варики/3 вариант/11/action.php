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
			return true;
		}
		
		
		
		function Check() {
				if (empty($this->data[0]) && $this->data[0] = ' ') 
					$this->err[] = "Пустая фамилия.";
				elseif (stristr($this->data[0], ' ')) 
					$this->err[] = "В фамилии присутствует пробел.";
					
				if (empty($this->data[1]) && $this->data[1] = ' ') 
					$this->err[] = "Пустое имя.";
				elseif (stristr($this->data[1], ' '))
					$this->err[] = "В имени присутствует пробел.";
					
				if (empty($this->data[2]) && $this->data[2] = ' ') 
					$this->err[] = "Пустое отчество.";
				elseif (stristr($this->data[2], ' ')) 
					$this->err[] = "В отчестве присутствует пробел.";

				if ($this->data[6] == "--Не выбрано--")
					$this->err[] = "Не выбрана страна.";
				
				if (empty($this->data[8]) && $this->data[8] = ' ')
					$this->err[] = "Пустой телефон.";
				elseif (stristr($this->data[8], ' '))
					$this->err[] = "В телефоне присутствует пробел.";
	
				if ($this->data[6] == "Грузия" && stristr($this->data[8], '+9') === FALSE ||
					$this->data[6] == "Россия" && stristr($this->data[8], '+7') === FALSE ||
					$this->data[6] == "Украина" && stristr($this->data[8], '+3') === FALSE) 
					$this->err[] = "Код телефона и страна не совпадают.";
				return true;
		}
		
		
		
		function Display() {
			if (empty($this->err)) {	
				if (empty($this->data[3])) $this->data[3] = "---";
					
				if (empty($this->data[4])) $this->data[4] = "---";
				else {
					if ($this->data[4] == "M") $this->data[4] = "Мужской";
					if ($this->data[4] == "W") $this->data[4] = "Женский";
				}
					
				if (empty($this->data[5])) $this->data[5] = "---";
				if (empty($this->data[7])) $this->data[7] = "---";
				if (empty($this->data[9])) $this->data[9] = "---";
				if (empty($this->data[11])) $this->data[11] = "---";
					
				if (empty($this->data[10])) $this->active = "---";
				else $this->active = implode(', ', $this->data[10]);
					
					
					
				echo "ФИО: " . $this->data[0] . " " . $this->data[1] . " " . $this->data[2] . "</br>";
				echo "Дата рождения: " . $this->data[3] . "</br>";
				echo "Пол: " . $this->data[4] . "</br>";	
				echo "Группа: " . $this->data[5] . "</br>";
				echo "Страна: " . $this->data[6] . "</br>";
				echo "Адрес: " . $this->data[7] . "</br>";
				echo "Телефон: " . $this->data[8] . "</br>";
				echo "E-mail: " . $this->data[9] . "</br>";
				echo "Увлечения: " . $this->active . "</br>";
				echo "Дополнительно: " . $this->data[11] . "<br/>";
			}
			else {
				echo "Произошла ошибка. Причина: </br>";
				foreach ($this->err as $value) echo "$value</br>";
			}
			return true;
		}
		
		
		
		function Writing() {
			if (empty($this->err)) {
				//запись данных
				$fp = fopen ('data/profiles.json', 'a+');
				fwrite ($fp, "START");
				fwrite ($fp, PHP_EOL);
				
				file_put_contents ('data/profiles.json', print_r ("ФИО: ". $this->data[0] . " " . $this->data[1] . " " . $this->data[2], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Дата рождения: " . $this->data[3], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Пол: " . $this->data[4], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Группа: " . $this->data[5], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Страна: " . $this->data[6], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Адрес: " . $this->data[7], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Телефон: " . $this->data[8], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("E-mail: " . $this->data[9], true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Увлечения: " . $this->active, true), FILE_APPEND);
				fwrite ($fp, PHP_EOL);
				file_put_contents ('data/profiles.json', print_r ("Дополнительно: " . $this->data[11], true), FILE_APPEND);
				
				fwrite ($fp, PHP_EOL);
				fwrite ($fp, "END");
				fwrite ($fp, PHP_EOL);
				fclose ($fp);
				echo "Данные записаны!";
				}
				else {
					echo "Запись данных не удалась.";
				}
			return true;
			}
		}
	
	$form = new Form();
	if (!empty($_POST)) {
		$form->Check();
		$form->Display();
		$form->Writing();
	}
?>