<?php

namespace DotSmart\SmsBundle\Factory;

use DotSmart\SmsBundle\Entity\DotSmartSms;
use Doctrine\ORM\EntityManager;

/**
* Persist sms data
*/
class DataPersister
{
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * Persist sms data to database
	 */
	public function add(array $data = array())
	{
		$extraParams = $this->handleCompaganeData($data);
		$state 		= $data['etat'];
		$code 		= $data['code'];
		$info 		= $data['info'];
		$idCampagne = $data['idCampagneSms'];
		$cost 		= $data['couterSms'];
		$price 		= $data['priceSms'];
		$balance 	= $data['balanceSms'];
		$smsId 		= $extraParams['idSms'];
		$yourId 	= $extraParams['YouridSms'];
		$dateProg 	= new \DateTime($extraParams['dateProgSms']);
		$dateSms 	= new \DateTime($extraParams['dateSms']);
		$life 		= $extraParams['lifeSms'];
		$numbers 	= $extraParams['numSms'];
		$user_id 	= $data['user_id'];
		$message 	= $data['message'];
		$designation= $data['designation'];

		$dotSmartsms = new DotSmartSms();

		$dotSmartsms->setState($state);
		$dotSmartsms->setCode($code);
		$dotSmartsms->setInfo($info);
		$dotSmartsms->setIdCampagne($idCampagne);
		$dotSmartsms->setCost($cost);
		$dotSmartsms->setPrice($price);
		$dotSmartsms->setBalance($balance);
		$dotSmartsms->setIdSms($smsId);
		$dotSmartsms->setYourId($yourId);
		$dotSmartsms->setDateProg($dateProg);
		$dotSmartsms->setSmsDate($dateSms);
		$dotSmartsms->setLife($life);
		$dotSmartsms->setNumber($numbers);
		$dotSmartsms->setUserId($user_id);
		$dotSmartsms->setMessage($message);
		$dotSmartsms->setDesignation($designation);

		$this->em->persist($dotSmartsms);
	    $this->em->flush();

	    return $dotSmartsms->getId();
	}

	/**
	 * Handle extra data sent by platform
	 *
	 * @param array $compagneData contains extra data to fetch from
	 *
	 * @return array
	 */
	private function handleCompaganeData(array $compagneData = array())
	{
		$compagneId = $compagneData['idCampagneSms'];
		$extras 	= array();
		
		foreach ($compagneData[$compagneId] as $key => $extra) {
			$extras = $extra;
		}

		return $extras;
	}
}