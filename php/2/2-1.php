<?php 
	$age = rand (1,60);
	if ($age < 17) {
		print ("Слишком молод");
	}
	elseif ($age > 35) {
		print ("Не повезло");
	}
	else {
		print ("Счастливчик!");
	}
	print "<br/> $age";
?> 