<?php

class caesarCript
{
	public array $alphabet = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
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
}