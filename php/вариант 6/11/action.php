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
	class Form { //начало класса
		public $data = [];	// массив для считывания данных
		public $err = [];	// массив для ошибок
		// public - переменная доступна везде
		
		// isset - проверка на принятие данных
		// $_POST - супермассив данных, принимает данные из html-формы
		function __construct() { // особая функция __construct, которая инициализируется при вызове класса
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
		// проверка на обязательные поля
		// сначала фамилия, имя и отчество

		function Check() { //проверка
			$data = $this->data; 	// для обращения к data, находящуюся внутри класса, необходимо использовать конструкцию this
									// благодаря $data = $this->data мы можем использовать привычную $data[] + сокращает количество кода
									// ибо при вызове $data подразумевается $this->data
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
		}
		
		function Display() {
			if (empty($err)) { // если массив с ошибками пустой - запускается вывод данных
				$data = $this->data;
			
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
		else {													
			echo "Запись данных не удалась. Причина:</br>"; 	
			foreach ($err as $value) echo "$value</br>"; 	
		}			
	}
			
			//запись данных в файл
		function Write() {	
			$data = $this->data;
			
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
			else $active = implode(',', $data[10]);
			$data[10] = $active;

			if (empty($data[11])) $data[11] = "---";
			$fp = fopen ('data/profiles.txt', 'a+'); // открываем текстовый файл и присваиваем его переменной
			foreach ($data as $key => $values) {
				fwrite ($fp, "$data[$key] "); 	// с помощью foreach мы берём весь массив с данными и записываем его в строку
			}									// внимание на "$data[$key] ", пробел сделан специально для разделения данных
			fwrite ($fp, PHP_EOL);	// специальный символ начала новой строки для последующей записи
			fclose ($fp);			// закрытие файла
			echo "Данные записаны!";
			}
		}
	
	$form = new Form();
	if (!empty($_POST)) {
		$form->Check();
		$form->Display();
		$form->Write();
	}
?>