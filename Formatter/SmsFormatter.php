<?php

namespace DotSmart\SmsBundle\Formatter;

/**
* format the return result of sms platforme
*/
class SmsFormatter
{
	protected $format;
	public $result;
	protected $availableFormats = array('json', 'xml', 'array');

	/**
	 * construct the formatter class
	 */
	public function __construct($result, $format = 'json')
	{
		if (!in_array($format, $this->availableFormats)) {
			return;
		}

		$this->format = (string) strtolower($format);

		$this->getFormatResult($result);
	}

	private function getFormatResult($result)
	{
		switch ($this->format) {
			case 'json':
				return $this->jsonFormat($result);
				break;
			case 'xml':
				return $this->xmlFormat($result);
				break;
			case 'array':
				return $this->arrayFormat($result);
				break;
			default:
				return $this->arrayFormat($result);
				break;
		}
	}

	/**
	 * encode json format and return the result
	 */
	public function jsonFormat($result)
	{
		if (is_array($result))
			$this->result = $result;
		else
			$this->result = json_decode($result);
	}

	public function xmlFormat($result) {
		$this->result = $result;
	}

	public function arrayFormat($result) {	
		$this->result = $result;
	}
}