<?php

namespace DotSmart\SmsBundle\Factory;

/**
* Sender factory interface
*/
interface SenderFactoryInterface
{
	/**
	 * Handles data to be sent to platform
	 *
	 * @param array $data array of data to be sent
	 */
	public function handleSubmittedData(array $data = array());

	/**
	 * Send data to the platform
	 *
	 * @param string       $message     message to send, this parameter is required
	 * @param string/array $numbers     numbers could be a string or a collection of numbers in form of an array
	 * @param string       $sender      required, and it must not exceed twelve characters
	 * @param integer      $myid        a generated random number
	 * @param date         $date        date of sms was sent 
	 * @param string       $time        time of sms was sent 
	 * @param string       $life        life of sms 
	 * @param string       $designation descreptive words 
	 */
	public function send($message, $numbers,  $sender = '', $myId = '', $date = '', $time = '', $life = '', $designation = 'Ma desination');

	/**
	 * Sending sms using SOAP
	 */
	public function sendSmsSoap();

	/**
	 * Preparing data to be sent
	 *
 	 * @param boolean $soap this must be true if you plan to send sms using SOAP method, otherwise set it to false if you want to send data using Curl 
	 */
	public function prepareData($soap = false)

	/**
	 * Url to send data to, it must be Soap url
	 */
	public function getEndPointSoap();
}