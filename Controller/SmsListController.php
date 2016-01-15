<?php

namespace DotSmart\SmsBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/sms")
 */
class SmsListController extends Controller
{
    /**
     * @Route("/list", name="sms_list")
     */
    public function indexAction(Request $request)
    {
 		$em  = $this->getDoctrine()->getManager();
        $sms = $em->getRepository('DotSmartSmsBundle:DotSmartSms')->findAll();

        return $this->render('DotSmartSmsBundle:SMS:list.html.twig', array(
            'getSms' => $sms,
        ));
	}

	/**
     * @Route("/send", name="sms_send")
     * @Method("POST|GET")
     */
	public function sendSmsAction(Request $request)
	{
		$requiredVal = array('required' => true);
		$form = $this->createFormBuilder()
            ->add('number', 'text', $requiredVal)
            ->add('designation', 'text', array('required' => false))
            ->add('message', 'text', $requiredVal)
            ->add('send', 'submit', array('label' => 'Envoyer SMS'))
            ->getForm();

        $form->handleRequest($request);

	    if ($form->isSubmitted()) {
	    	$number 	 = $form['number']->getData();
	    	$message 	 = $form['message']->getData();
	    	$designation = $form['designation']->getData();
	    	$smsService  = $this->get('dot_smart_sms.send_sms');

	        $result = $smsService->send(array(
	            'user_id' 	  => 1, 
	            'designation' => $designation, 
	            'message' 	  => $message, 
	            'numbers' 	  => $number, //33635470545
	        ));

	        if ($result)
		        return $this->redirectToRoute('sms_list');
	    }

        return $this->render('DotSmartSmsBundle:SMS:new.html.twig', array(
            'form' => $form->createView(),
        ));
	}
}