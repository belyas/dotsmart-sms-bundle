<?php

namespace DotSmart\SmsBundle\Checker;

/**
* Validate received numbers
*/
class NumberChecker
{
	/**
	 * checks if number is valid number
	 *
	 * @param array $numbers table if numbers
	 *
	 * @return string
	 */
	public function checkSmsNumbers($numbers)
	{
		if (!is_array($numbers)) {
			$numbers = array($numbers);
		}

		$setNumbers = '';

		foreach ($numbers as $key => $number) {
			if (false !== strpos($number, '+'))
				$number = substr($number, 1);

			if (substr($number, 0, 2) == '00')
				$number = substr($number, 2);

			if (strlen($number) < 11) {
				return false;
			}

			$setNumbers .= $number. ',';
		}

		return rtrim($setNumbers, ',');
	}
}