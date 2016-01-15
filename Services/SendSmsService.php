<?php

namespace DotSmart\SmsBundle\Services;

use DotSmart\SmsBundle\Factory\SenderFactory;
use DotSmart\SmsBundle\Factory\DataPersister;

/**
* Send sms service class
*/
class SendSmsService
{
	private $sender;
	private $persister;

	public function __construct(SenderFactory $senderFactory, DataPersister $datePersister)
	{
		$this->sender = $senderFactory;
		$this->persister = $datePersister;
	}

	public function send(array $data = array())
	{
		if (!is_array($data) || !count($data))
			return false;

		$result = $this->sender->handleSubmittedData($data);

		if ($result['etat'] == 1) {
			$result['user_id'] 		= $data['user_id'];
			$result['message'] 		= $data['message'];
			$result['designation'] 	= '';
			
			if (isset($data['designation']))
				$result['designation'] = $data['designation'];
			
			// persist to db
			$getId = $this->persister->add($result);
			
			if ($getId) {
				return $result;
			}
		}
	}
}
