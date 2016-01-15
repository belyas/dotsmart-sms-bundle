<?php

namespace DotSmart\SmsBundle\Tests\Checker;

use DotSmart\SmsBundle\Checker\NumberChecker;

/**
* test checker
*/
class NumberCheckerTest extends \PHPUnit_Framework_TestCase
{
	public function testSmsNumber()
	{	
		$myNum 	   = '212630892776';
		$checker   = new NumberChecker();
		$getNumber = $checker->checkSmsNumbers($myNum);

		$this->assertEquals($myNum, $getNumber);
	}

	public function testSmsNumbers()
	{	
		$myNums    = array('212630892776', '33928000000', '33000123456');
		$checker   = new NumberChecker();
		$getNumber = $checker->checkSmsNumbers($myNums);

		$this->assertCount(3, explode(",", $getNumber));
		$this->assertContains('212630892776', $getNumber);
	}
}