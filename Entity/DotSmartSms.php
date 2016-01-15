<?php

namespace DotSmart\SmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DotSmartSms
 *
 * @ORM\Table(name="dot_smart_sms")
 * @ORM\Entity(repositoryClass="DotSmart\SmsBundle\Repository\DotSmartSmsRepository")
 */
class DotSmartSms
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="sms_state", type="smallint", nullable=true)
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="sms_code", type="integer")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_info", type="string", length=20, nullable=true)
     */
    private $info;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_idcampagne", type="string", length=20)
     */
    private $idCampagne;

    /**
     * @var int
     *
     * @ORM\Column(name="sms_couter", type="smallint", nullable=true)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_price", type="decimal", precision=2, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_balance", type="string", length=10, nullable=true)
     */
    private $balance;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_idsms", type="string", length=40)
     */
    private $idSms;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_yourid", type="string", length=10, nullable=true)
     */
    private $yourId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sms_date_prog", type="datetime", nullable=true)
     */
    private $dateProg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sms_date", type="datetime", nullable=true)
     */
    private $smsDate;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_life", type="string", length=10, nullable=true)
     */
    private $life;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_number", type="string", length=15)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_message", type="string", length=170)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="sms_designation", type="string", length=100)
     */
    private $designation;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $userId;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set state
     *
     * @param integer $state
     *
     * @return DotSmartSms
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return DotSmartSms
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return DotSmartSms
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set idCampagne
     *
     * @param string $idCampagne
     *
     * @return DotSmartSms
     */
    public function setIdCampagne($idCampagne)
    {
        $this->idCampagne = $idCampagne;

        return $this;
    }

    /**
     * Get idCampagne
     *
     * @return string
     */
    public function getIdCampagne()
    {
        return $this->idCampagne;
    }

    /**
     * Set cost
     *
     * @param integer $cost
     *
     * @return DotSmartSms
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return DotSmartSms
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return DotSmartSms
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Set idSms
     *
     * @param string $idSms
     *
     * @return DotSmartSms
     */
    public function setIdSms($idSms)
    {
        $this->idSms = $idSms;

        return $this;
    }

    /**
     * Get idSms
     *
     * @return string
     */
    public function getIdSms()
    {
        return $this->idSms;
    }

    /**
     * Set yourId
     *
     * @param string $yourId
     *
     * @return DotSmartSms
     */
    public function setYourId($yourId)
    {
        $this->yourId = $yourId;

        return $this;
    }

    /**
     * Get yourId
     *
     * @return string
     */
    public function getYourId()
    {
        return $this->yourId;
    }

    /**
     * Set dateProg
     *
     * @param \DateTime $dateProg
     *
     * @return DotSmartSms
     */
    public function setDateProg($dateProg)
    {
        $this->dateProg = $dateProg;

        return $this;
    }

    /**
     * Get dateProg
     *
     * @return \DateTime
     */
    public function getDateProg()
    {
        return $this->dateProg;
    }

    /**
     * Set smsDate
     *
     * @param \DateTime $smsDate
     *
     * @return DotSmartSms
     */
    public function setSmsDate($smsDate)
    {
        $this->smsDate = $smsDate;

        return $this;
    }

    /**
     * Get smsDate
     *
     * @return \DateTime
     */
    public function getSmsDate()
    {
        return $this->smsDate;
    }

    /**
     * Set life
     *
     * @param string $life
     *
     * @return DotSmartSms
     */
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Get life
     *
     * @return string
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return DotSmartSms
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set userId
     *
     * @param string $userId
     *
     * @return DotSmartSms
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return DotSmartSms
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set designation
     *
     * @param string $designation
     *
     * @return DotSmartSms
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;

        return $this;
    }

    /**
     * Get designation
     *
     * @return string
     */
    public function getDesignation()
    {
        return $this->designation;
    }
}

