<?php

class playFairCipher
{

	public array $alphabet = ['A','B','C','D','E','F','G','H','I','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	public array $matrix = [[],[],[],[],[]];
	public string $result = '';
	public function encrypt(string $message, string $keyWord)
	{
		echo '<pre>';
		//j=i
		$keyWord = str_replace('j', 'i', $keyWord);
		$this->fillMatrix($keyWord);
		$arMsg = str_split($message, 1);
		for($i = 0; $i < count($arMsg); $i += 2)
		{
			$this->analyzeBigrams($arMsg[$i], $arMsg[$i+1]);
		}
		var_dump($this->result);
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
				$this->secondRule($matrixString, $symbol1, $symbol2);
				return;
			}
		}
		unset($key);
		global $symbol1Key,$symbol2Key;
		array_walk_recursive($this->matrix, function ($item, $key) use ($symbol1, $symbol2){
			if($item == $symbol1)
			{
				$GLOBALS['symbol1Key'] = $key;
			}
			if($item == $symbol2)
			{
				$GLOBALS['symbol2Key'] = $key;
			}
		});
		if($GLOBALS['symbol1Key'] == $GLOBALS['symbol2Key'])
		{
			$this->thirdRule($symbol1, $symbol2);
			return;
		}
		$this->firstRule();
	}

	public function secondRule(array $matrixString, string $symbol1, string $symbol2)
	{
		//в одной строке
		$key1 = array_search($symbol1, $matrixString);
		if($key1 == 4)
		{
			$key1 = 0;
		}else
		{
			$key1++;
		}
		$this->result .= $matrixString[$key1];
		$key2 = array_search($symbol2, $matrixString);
		if($key2 == 4)
		{
			$key2 = 0;
		}else
		{
			$key2++;
		}
		$this->result .= $matrixString[$key2];
	}

	public function thirdRule(string $symbol1, string $symbol2)
	{
		//в одном столбце
		var_dump($symbol1, $symbol2);
		foreach ($this->matrix as $key => $matrixString)
		{
			if(in_array($symbol1, $matrixString))
			{
				$this->result .= $this->matrix[$key+1][$GLOBALS['symbol1Key']];
				continue;
			}
			if(in_array($symbol2, $matrixString))
			{
				$this->result .= $this->matrix[$key+1][$GLOBALS['symbol1Key']];
			}
		}
	}

	public function firstRule()
	{

	}
}