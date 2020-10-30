<?php 
	$form = [
		"Name"		=> "Alex",
		"Address"	=> "Pushkina, dom Kolotushkina",
		"Phone"		=> "8 800 555 35 35",
		"Mail"		=> "alex@gmail.com",
	];
	foreach ($form as $key => $value) {
		print "$key: $value <br/>";
	}
?> 