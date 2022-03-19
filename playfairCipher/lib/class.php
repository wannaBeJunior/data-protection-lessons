<?php

class playFairCipher
{

	public array $alphabet = ['A','B','C','D','E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	public array $matrix = [[],[],[],[],[]];
	public function encrypt(string $message, string $keyWord)
	{
		//j=i
		$keyWord = str_replace('j', 'i', $keyWord);
		$this->fillMatrix($keyWord);
		$arMsg = str_split($message, 1);
		for($i = 0; $i < count($arMsg); $i += 2)
		{
			$this->analyzeBigrams($arMsg[$i], $arMsg[$i+1]);
		}
		echo '<pre>';
		var_dump($this->matrix);
		echo '</pre>';
	}

	public function fillMatrix(string $keyWord) : void
	{
		$arKeyWord = str_split($keyWord, 1);
		$arUsageSymbols = [];
		foreach ($arKeyWord as $symbol)
		{
			$symbol = strtoupper($symbol);
			foreach ($this->matrix as $key => $matrixString)
			{
				if(count($matrixString) >= 5)
				{
					continue;
				}
				for ($i = 0; $i < 5; $i++)
				{
					if(!$this->matrix[$key][$i] && !in_array($symbol, $arUsageSymbols))
					{
						$this->matrix[$key][$i] = $symbol;
						$arUsageSymbols[] = $symbol;
						break;
					}
				}
				break;
			}
		}
		unset($symbol);
		foreach ($this->alphabet as $symbol)
		{
			foreach ($this->matrix as $key => $matrixString)
			{
				if(count($matrixString) >= 5)
				{
					continue;
				}
				for ($i = 0; $i < 5; $i++)
				{
					if(!$this->matrix[$key][$i] && !in_array($symbol, $arUsageSymbols))
					{
						$this->matrix[$key][$i] = $symbol;
						break;
					}
				}
				break;
			}
		}
	}

	public function analyzeBigrams(string $symbol1, string $symbol2)
	{
		foreach ($this->matrix as $key => $matrixString)
		{
			if(in_array($symbol1, $matrixString) && in_array($symbol2, $matrixString))
			{
				$this->secondRule($matrixString);
				break;
			}
			if($keySymbol = array_search($symbol1, $matrixString) || $keySymbol = array_search($symbol2, $matrixString))
			{
				//var_dump($symbol1, $symbol2);
				//echo '1-' . $this->matrix[$key][$keySymbol-1];
				$needle = $this->matrix[$key][$keySymbol-1];
				foreach ($this->matrix as $key2 => $group)
				{
					if($group[$keySymbol-1] == $symbol1 || $group[$keySymbol-1] == $symbol2)
					{
						//echo '2-' . $this->matrix[$key2][$keySymbol-1] . '</br>';
						break;
					}
				}
				break;
			}
		}

	}

	public function secondRule(array $matrixString)
	{
		//в одной строке
		echo '2';
	}

	public function thirdRule(array $matrixString)
	{
		//в одном столбце
		echo '3';
	}
}