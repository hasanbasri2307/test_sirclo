<?php

function generateBintang($number){
	for($i=$number; $i>=0;$i--){

		$counter = 0;
		for($j=0;$j<=$i;$j++){
			if($i-2>=0){
				if($counter < 2){
					echo $i-2;
				}else{
					echo $i;
				}
			}
			
			$counter++;
		}

		echo "<br>";
	}
}

generateBintang(6);