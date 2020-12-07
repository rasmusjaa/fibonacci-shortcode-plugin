<?php

trait Fibonacci_Array {

	public function fibonacci_array($n) {
		$num1 = 0;
		$num2 = 1;
		$array = [];
		$counter = 0;
	
		while ($counter < $n)
		{
			array_push($array, $num1);
			$temp = $num1 + $num2;
			$num1 = $num2;
			$num2 = $temp;
			$counter++;
		}
		return $array;
	}

}