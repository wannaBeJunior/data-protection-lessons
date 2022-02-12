<?php
function isPrime(int $n) : string
{
	for($x=2; $x <= sqrt($n); $x++) {
		if($n % $x == 0) {
			return 'Не простое';
		}
	}
	return 'Простое';
}

function EulerFunction(int $n) : int
{
	$result = $n;
	if ($n == 1)
	{
		return 1;
	}
	if(isPrime($n) == 'Простое')
	{
		return $n-1;
	}
	for ($i=2; $i*$i<=$n; $i++)
	{
		if ($n % $i == 0) {
			while ($n % $i == 0)
			{
				$n /= $i;
			}
			$result -= $result / $i;
		}
	}
	if ($n > 1)
	{
		$result -= $result / $n;
	}
	return $result;
}

function abmx(int $a, int $b, int $m)
{
	for($i = 0; $i < 10000; $i++)
	{
		if((($a * $i) - $b) % $m == 0)
		{
			return $i;
		}
	}
	return 'Рещения нет';
}

function chineseTheorem(string $nums, string $rems)
{
	$arNums = explode(',', $nums);
	$arRems = explode(',', $rems);
	if(count($arNums) != count($arRems))
	{
		return 'Количество чисел m должно быть равно количеству r';
	}
	$arParams = [];
	$m0 = 1;
	foreach($arRems as $key => $m)
	{
		$m0 *= $m;
		$arParams['a'][] = $arNums[$key];
		$arParams['m'][] = $arRems[$key];
	}
	unset($key);
	for($i = 0; $i < count($arRems); $i++)
	{
		$arParams['n'][] = $m0 / $arParams['m'][$i];
	}
	foreach($arParams['n'] as $key => $n)
	{
		$arParams['y'][$key] = 0;
		$resFound = 0;
		while ($resFound == 0)
		{
			$arParams['y'][$key]++;
			if ((($arParams['n'][$key] * $arParams['y'][$key] - $arParams['a'][$key]) % $arParams['m'][$key]) == 0)
			{
				$resFound = 1;
			}
			if ($arParams['y'][$key] == 1000)
			{
				break;
			}
		}
	}
	$result = 0;
	foreach($arParams['n'] as $key => $n)
	{
		$result += $n * $arParams['y'][$key];
	}
	return $result % $m0;
}

function Lejandr(int $a, int $p)
{
	$lej = 0;
	if ($a % $p == 0) $lej = 0;
	else
	{
		for ($x = 1; $x < 1000; $x++)
		{
			if ($x * $x - $a % $p == 0) $lej = 1;
		}
		if ($lej != 1) $lej = -1;
	}
	return $lej;
}

function doLejandr(int $a, int $b)
{
	$jacob = 1;
	$dividers = [];
	$div_count = 0;
	if ($b % 2 == 1)
	{
		while ($b > 1)
		{
			for ($i = 3; $i < 100; $i++)
			{
				$isprime = false;
				for ($m = 2; $m < $i; $m++)
				{
					if ($m % $i == 0)
					{
						$isprime = false;
						break;
					}
					else
					{
						$isprime = true;
					}
				}
				if ($isprime)
				{
					if ($b % $i == 0)
					{
						$dividers[$div_count] = $i;
						$div_count++;
						$b = $b / $i;
						$i = 3;
					}
				}
			}
		}
		for ($i = 0; $i < $div_count; $i++)
		{
			$jacob = $jacob * Lejandr($a, $dividers[$i]);
			return $jacob;
		}
	}
	else
	{
		return "Число b должно быть нечетным";
	}
}

function cf($input_numerator, $input_denominator)
{
	$remainder = $input_denominator;
	$numerator = $input_numerator;
	$fraction = [];

	while ($remainder != 0) {
		$fraction[] = (int)($numerator / $remainder);
		$denominator = $remainder;
		$remainder = $numerator % $remainder;
		$numerator = $denominator;
	}

	return "[" . implode(', ', $fraction) . "]";
}

