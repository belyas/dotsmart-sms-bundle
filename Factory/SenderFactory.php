<?php

namespace DotSmart\SmsBundle\Factory;

use DotSmart\SmsBundle\Formatter\SmsFormatter;
use DotSmart\SmsBundle\Checker\NumberChecker;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* send the sms to sms platforme
*/
class SenderFactory implements SenderFactoryInterface
{
	protected $numbers = array();
	protected $options = array();
	protected $container;

	public function __construct(ContainerInterface $container) {
		$this->container = $container;
	}

	public function handleSubmittedData(array $data = array())
	{
		if (!isset($data['message']) || empty($data['message'])) {
			return;
		}

		if (!isset($data['numbers']) || empty($data['numbers'])) {
			return;
		}

		$designation = '';
		$sender 	 = '';
		$myid 		 = '';
		$date 		 = '';
		$time 		 = '';
		$life  		 = '';

		if (isset($data['designation']) && !empty($data['designation'])) {
			$designation = trim($data['designation']);
		}
		
		if (isset($data['sender']) && !empty($data['sender'])) {
			$sender = trim($data['sender']);
		}
		
		if (isset($data['myid']) && !empty($data['myid'])) {
			$myid = trim($data['myid']);
		}
		
		if (isset($data['date']) && !empty($data['date'])) {
			if (false !== strpos($data['date'], '-')) {
				$date = trim($data['date']);
			}
		}
		
		if (isset($data['time']) && !empty($data['time'])) {
			if (false !== strpos($data['time'], ':')) {
				$time = trim($data['time']);
			}
		}
		
		if (isset($data['life']) && !empty($data['life'])) {
			if (false !== strpos($data['life'], ':')) {
				$life = trim($data['life']);
			}
		}

		$result = $this->send($data['message'], $data['numbers'], $sender, $myid, $date, $time, $life, $designation);

		return $result;
	}

	protected function send($message, $numbers,  $sender = '', $myId = '', $date = '', $time = '', $life = '', $designation = 'Ma desination')
	{
		$numberChecker = new NumberChecker();
		$checkNumbers  = $numberChecker->checkSmsNumbers($numbers);

		if (!$checkNumbers) {
			echo sprintf('Please verify your number(s) : %s', $numbers);
			exit();
		}

		$smsFormat 	   = $this->container->getParameter('dot_smart_sms.format');
		$this->options = array(
			'gsm' 		=> $checkNumbers,
			'senderid' 	=> $sender,
			'message' 	=> $message,
			'myid' 		=> $myId,
			'date' 		=> $date,
			'time' 		=> $time,
			'life' 		=> $life,
			'designation'  => $designation
		);

		$result   	  = $this->sendSmsSoap();
		$smsFormatter = new SmsFormatter($result, $smsFormat);

		return $smsFormatter->result;
	}

	private function sendSms()
	{
		$data = $this->prepareData();

		$api  = curl_init();
		
		curl_setopt($api, CURLOPT_URL, $this->getEndPoint());
		curl_setopt($api, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($api, CURLOPT_POST, 1);
		curl_setopt($api, CURLOPT_POSTFIELDS, $data);

		$content = curl_exec($api);

		if (curl_errno($api)) {
			echo "Error curl_exec : ". curl_error($api);
	    	exit;
	    }

		curl_close($api);

		return $content;
	}

	private function sendSmsSoap()
	{
		ini_set('soap.wsdl_cache_enabled', 0);

		$data 	 = $this->prepareData(true);
		$soapUrl = $this->getEndPointSoap();
		$service = new \SoapClient($soapUrl);
		$session = $service->loginSms($data['reference'], $data['key'], "fr");
		$result  = $service->sendSms($session, $data['designation'], $data['senderid'], $data['gsm'], $data['message'] , $data['date'], $data['life'], $data['myid']);

		return $result;
	}

	private function prepareData($soap = false)
	{
		$this->options['reference'] = $this->container->getParameter('dot_smart_sms.reference');	
		$this->options['key'] 	    = $this->container->getParameter('dot_smart_sms.key');	

		if (!isset($this->options['senderid']) || empty($this->options['senderid'])) {
			$this->options['senderid'] = $this->container->getParameter('dot_smart_sms.senderid');
		}

		if (strlen($this->options['message']) > 160) {
			$this->options['message'] = substr(trim($this->options['message']), 0, 160);
		}

		if (!isset($this->options['date']) || empty($this->options['date'])) {
			$this->options['date'] = $this->container->getParameter('dot_smart_sms.date');
		}

		if (!isset($this->options['time']) || empty($this->options['time(oid)'])) {
			$this->options['time'] = $this->container->getParameter('dot_smart_sms.time');
		}

		if (!isset($this->options['life']) || empty($this->options['life'])) {
			$this->options['life'] = $this->container->getParameter('dot_smart_sms.life');
		}

		if (!isset($this->options['myid']) || empty($this->options['myid'])) {
			$this->options['myid'] = $this->container->getParameter('dot_smart_sms.myid');
		}

		if (false === $soap) {
			$fields = '';
			foreach($this->options as $key => $option) {
				$fields .= $key.'='.$option.'&';
			}

			return rtrim($fields, '&');
		}
		else {
			list($y, $m, $d) = explode("-", $this->options['date']);
			$this->options['date'] = $y .'/'. $m .'/'. $d .' '. $this->options['time'];

			return $this->options;
		}
	}

	private function getEndPointSoap()
	{
		return 'http://sms.soap.dot-smart.com/soap.php?wsdl';
	}

	private function getEndPoint()
	{
		return 'http://sms.soap.dot-smart.com/api.php';
	}
}