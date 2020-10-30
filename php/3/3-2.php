<?php 

	/*
		Используя изученные материалы, реализуйте 2 функции нахождения суммы элементов главной 
		и побочной диагонали квадратной матрицы. Каждая функция имеет 1 аргумент (простой двумерный 
		массив представляющий собой квадратную матрицу) и возвращает одно число (сумма элементов).
	*/

	$matrix = array(
		0 => array(1,3,6),
		1 => array(9,4,6),
		2 => array(9,6,8)
		);
		end ($matrix);

	function prima($matrix) {
		$sum = 0;
		$max = key($matrix);
		for ($i = 0; $i <= $max; ++$i) {
			$sum += $matrix[$i][$i];
		}
		return $sum;
	}

	function seconda($matrix) {
		$sum = 0;
		$max = key($matrix);
		for ($i = 0; $i <= $max; ++$i) {
			$sum += $matrix[$i][2 - $i];
		}
		return $sum;
	}
		
	$result = prima($matrix);
	echo "Сумма главной диагонали: $result<br/>";
	$result = seconda($matrix);
	echo "Сумма побочной диагонали: $result<br/>";

?>