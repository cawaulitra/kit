<?php 
	/*
		Практическая работа №12
		Используя изученный материал по теме наследования реализовать
		2 класса:
		1) Для работы с одномерным массивом (массив является полем класса
		и осуществляется проверка что он именно одномерный) с методами:
			1: Нахождение суммы элементов массива;
			2: Нахождение минимального элемента массива (если массив строк,
			то с минимальной длинной) (is_number..., strlen можно использовать)
			(если массив смешанный - сравниваются числа и длина строки)
			3: Нахождение максимального элемента массива (если массив строк,
			то с максимальной длинной) (is_number..., strlen можно использовать)
			(если массив смешанный - сравниваются числа и длина строки)
		2) Для работы с двумерным массивом (матрица)(массив является полем 
		класса и осуществляется проверка что он именно одномерный) с методами:
			1: Нахождение суммы элементов массива;
			2: Нахождение минимального элемента массива (если массив строк,
			то с минимальной длинной)
			3: Нахождение максимального элемента массива (если массив строк,
			то с максимальной длинной)
			4: Нахождение суммы минимальных значений, каждой строки матрицы
			5: Нахождение суммы максимальных значений, каждой строки матрицы
			
			p.s
			поля = свойства
			методы = функции
	*/
	
	
	class OneDim { //одномерный массив
	
		public $onedim = array(90, 29, 18, 42, 1, 8, 94, 11, 6, 48, 9);
		public $sum = 0;
		public $min = PHP_INT_MAX;
		public $max = -PHP_INT_MAX;
		
		function SumArr() {
			$sum = $this->sum;
			foreach ($this->onedim as $elem)
				if (is_int($elem)) {
					$sum += $elem;
				}
				elseif (is_string($elem)) {
					$sum += strlen($elem);
				}
			return $sum;
		}
		
		
		function MinArr() {
			$min = $this->min;
			foreach ($this->onedim as $elem) {
				if (is_int($elem)) {
					if (is_int($min))
						if ($min > $elem) $min = $elem;
					if (is_string($min))
						if (strlen($min) > $elem) $min = $elem;
				}
				if (is_string($elem)) {
					if (is_int($min))
						if ($min > strlen($elem)) $min = $elem;
					if (is_string($min))
						if (strlen($min) > strlen($elem)) $min = $elem;
				}
			}
			return $min;
		}
		
		
		
		function MaxArr() {
			$max = $this->max;
			foreach ($this->onedim as $elem) {
				if (is_int($elem)) {
					if (is_int($max))
						if ($max < $elem) $max = $elem;
					if (is_string($max))
						if (strlen($max) < $elem) $max = $elem;
				}
				if (is_string($elem)) {
					if (is_int($max))
						if ($max < strlen($elem)) $max = $elem;
					if (is_string($max))
						if (strlen($max) < strlen($elem)) $max = $elem;
				}
			}
			return $max;
		}
	}





	class TwoDim extends OneDim { //двумерный массив
		public $twodim = array(
		0 => array(2,3),
		1 => array(2,3),
		2 => array(2,3),
		3 => array(2,3),
		4 => array(2,3)
		);
		
		function SumArr() {
			$sum = $this->sum;
			foreach ($this->twodim as $elem) {
				if (is_array($elem)) {
					$a = new OneDim();
					$a->onedim = $elem;
					$sum += $a->SumArr();
				}
				if (is_int($elem)) 
					$sum += $elem;
				if (is_string($elem)) 
					$sum += strlen($elem);
			}
			return $sum;
		}
		
		
		function MinArr() {
			$min = $this->min;
			foreach ($this->twodim as $elem) {
				if (is_array($elem)) {
					$a = new OneDim();
					$a->onedim = $elem;
					$elem = $a->MinArr();
					if (is_int($min))
						if ($min > $elem) $min = $elem;
					if (is_string($min))
						if (strlen($min) > $elem) $min = $elem;
				}
				if (is_int($elem)) {
					if (is_int($min))
						if ($min > $elem) $min = $elem;
					if (is_string($min))
						if (strlen($min) > $elem) $min = $elem;
				}
				if (is_string($elem)) {
					if (is_int($min))
						if ($min > strlen($elem)) $min = $elem;
					if (is_string($min))
						if (strlen($min) > strlen($elem)) $min = $elem;
				}
			}
			return $min;
		}

		
		function MaxArr() {
			$max = $this->max;
			foreach ($this->twodim as $elem) {
				if (is_array($elem)) {
					$a = new OneDim();
					$a->onedim = $elem;
					$elem = $a->MaxArr();
					if (is_int($max))
						if ($max < $elem) $max = $elem;
					if (is_string($max))
						if (strlen($max) < $elem) $max = $elem;
				}
				if (is_int($elem)) {
					if (is_int($max))
						if ($max < $elem) $max = $elem;
					if (is_string($max))
						if (strlen($max) < $elem) $max = $elem;
				}
				if (is_string($elem)) {
					if (is_int($max))
						if ($max < strlen($elem)) $max = $elem;
					if (is_string($max))
						if (strlen($max) < strlen($elem)) $max = $elem;
				}
			}
			return $max;
		}
		
		function MinSum() { //только для чисел
			$sum = $this->sum;
			$min = $this->min;
			foreach ($this->twodim as $elem) {
				if (is_array($elem)) {
					$a = new OneDim();
					$a->onedim = $elem;
					$elem = $a->MinArr();
					if ($min >= $elem) {
						$min = $elem;
					}
				@$sum += $min;
				$min = PHP_INT_MAX;
				}
			}
			return $sum;
		}
		
		
		
		function MaxSum() { //только для чисел
			$sum = $this->sum;
			$max = $this->max;
			foreach ($this->twodim as $elem) {
				if (is_array($elem)) {
					$a = new OneDim();
					$a->onedim = $elem;
					$elem = $a->MaxArr();
					if ($max <= $elem) {
						$max = $elem;
					}
				@$sum += $max;
				$max = -PHP_INT_MAX;
				}
			}
			return $sum;
		}
	}
	
	
	
	$a = new OneDim;
	echo "</br>OneDim run: </br>";
	echo "Sum: " . $a->SumArr() . "</br>";
	echo "Min: " . $a->MinArr() . "</br>";
	echo "Max: " . $a->MaxArr() . "</br>";
	
	$a = new TwoDim;
	echo "</br>TwoDim run: </br>";
	echo "Sum: " . $a->SumArr() . "</br>";
	echo "Min: " . $a->MinArr() . "</br>";
	echo "Max: " . $a->MaxArr() . "</br>";
	echo "MinSum: " . $a->MinSum() . "</br>";
	echo "MaxSum: " . $a->MaxSum() . "</br>";
	
?> 