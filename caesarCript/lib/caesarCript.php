<?php

class caesarCript
{
	public array $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	const MOST_USAGE_SYMBOL = 'E';
	public function encrypt(string $message, int $shift) : string
	{
		$result = '';
		$symbols = str_split($message);
		foreach($symbols as $symbol)
		{
			if(preg_match('/([-.?!)(,:;\/\\ 0-9_])/', $symbol, $matches))
			{
				$result .= $matches[1];
				continue;
			}
			$searchSymbol = strtoupper($symbol);
			$alphabetIndex = array_search($searchSymbol, $this->alphabet);
			$symbolsShift = $alphabetIndex + $shift;
			if($symbolsShift > 26)
			{
				$symbolsShift = abs(count($this->alphabet) - ($symbolsShift));
			}
			$result .= ctype_upper($symbol)?$this->alphabet[$symbolsShift]:strtolower($this->alphabet[$symbolsShift]);
		}
		return $result;
	}

	public function decrypt(string $msg) : string
	{
		$result = '';
		$mostUsageInAlphabetSymbolKey = array_search(self::MOST_USAGE_SYMBOL, $this->alphabet);
		$symbols = str_split($msg);
		$symbolsCount = [];
		foreach($symbols as $symbol)
		{
			$symbol = strtoupper($symbol);
			if(preg_match('/([-.?!)(,:;\/\\ 0-9_])/', $symbol)) continue;
			$symbolsCount[$symbol]++;
		}
		unset($symbol);
		$mostUsageInMsgSymbol = array_keys($this->alphabet, array_keys($symbolsCount, max($symbolsCount))[0])[0];
		$shift = $mostUsageInMsgSymbol - $mostUsageInAlphabetSymbolKey;
		foreach($symbols as $symbol)
		{
			$symbol = strtoupper($symbol);
			if(preg_match('/([-.?!)(,:;\/\\ 0-9_])/', $symbol, $matches))
			{
				$result .= $matches[1];
				continue;
			}
			$result .= $this->alphabet[array_search($symbol, $this->alphabet) - $shift];
		}
		return $result;
	}
}