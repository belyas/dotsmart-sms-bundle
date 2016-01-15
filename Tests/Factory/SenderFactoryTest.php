<?php

namespace DotSmart\SmsBundle\Tests\Factory;

use DotSmart\SmsBundle\Formatter\SmsFormatter;
use DotSmart\SmsBundle\Checker\NumberChecker;
use DotSmart\SmsBundle\Factory\SenderFactory;
use DotSmart\SmsBundle\Factory\SenderFactoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
* send the sms to sms platforme
*/
class SenderFactoryTest extends KernelTestCase
{
	/**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;
    private $container;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->container = static::$kernel->getContainer();
        // $this->em 		 = $this->container->get('doctrine')->getManager();
    }

	public function testPrepareDataSoap()
	{	
		$senderFactory = new SenderFactory($this->container);
		$senderFactory->options = $this->getFakeData();
		$preparedData = $senderFactory->prepareData(true);
		
		$this->assertCount(10, $preparedData);
		$this->assertArrayHasKey('reference', $preparedData);
		$this->assertArrayHasKey('key', $preparedData);
	}

	public function testPrepareDataCurl()
	{	
		$senderFactory = new SenderFactory($this->container);
		$senderFactory->options = $this->getFakeData(); 
		$preparedData = $senderFactory->prepareData();

		$this->assertContains('&', $preparedData);
		$this->assertContains('=', $preparedData);
	}

	public function testEndPointSoap()
	{
		$senderFactory = new SenderFactory($this->container);
		$this->assertContains('soap.php?wsdl', $senderFactory->getEndPointSoap());
	}

	public function getFakeData()
	{
		return array(
			'gsm' 		=> '212630892776',
			'senderid' 	=> 'YASSINE',
			'message' 	=> 'Hello world',
			'myid' 		=> 1234,
			'date' 		=> '2016-01-14',
			'time' 		=> '12:12:12',
			'life' 		=> null,
			'designation'=> 'This is a designation'
		);
	}

	/**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        // $this->em->close();
    }
}