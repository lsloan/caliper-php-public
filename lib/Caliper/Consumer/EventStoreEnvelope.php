<?php
require_once 'Caliper/request/EnvelopeContext.php';
require_once 'util/TimestampUtil.php';

class EventStoreEnvelope implements JsonSerializable {
    private $apiKey = null;
    private $sensor;
	private $id;
    private $type;
    private $sendTime;
    private $data;
    private $context;

    /**
     * Create a new EventStoreEnvelope
     */
    public function __construct($data = null, $apiKey = null, $sensor = null) {
        $this->setContext(EnvelopeContext::CONTEXT);
        $this->setApiKey($apiKey);
        $this->setSensor($sensor);
    	$this->setData($data);
    	$this->setId($this->getNewGUID());
    	$this->setType("caliperEvent");
    	$this->setSendTime(new DateTime());
    }

	/*
	 * 
	 */
	public function __destruct() {
    }

    /**
     * @return mixed
     */
    public function getContext() {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context) {
        $this->context = $context;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * @param mixed $sensor
     */
    public function setSensor($sensor)
    {
        $this->sensor = $sensor;
        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
    	$this->id = $id;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getId() {
    	return $this->id;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
    	$this->type = $type;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getType() {
    	return $this->type;
    }

    /**
     * @param mixed $sendTime
     */
    public function setSendTime($sendTime) {
    	$this->sendTime = $sendTime;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getSendTime() {
    	return $this->sendTime;
    }

     /**
     * @param mixed $data
     */
    public function setData($data) {
    	$this->data = $data;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getData() {
    	return $this->data;
    }

    private function getNewGUID(){
	    if (function_exists('com_create_guid')){
	        return com_create_guid();
	    }else{
	        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);// "-"
	        $uuid = chr(123)// "{"
	            .substr($charid, 0, 8).$hyphen
	            .substr($charid, 8, 4).$hyphen
	            .substr($charid,12, 4).$hyphen
	            .substr($charid,16, 4).$hyphen
	            .substr($charid,20,12)
	            .chr(125);// "}"
	        return $uuid;
	    }
	}

    public  function jsonSerialize() {
	    $envelopeData = [
            '@context' => $this->getContext(),
            'sensor' => $this->getSensor(),
            //'id' => $this->getId(),
            //'type' => $this->getType(),
            'sendTime' => TimestampUtil::formatTimeISO8601MillisUTC($this->getSendTime()),
            'data' => [$this->getData()],
        ];

        if ($this->getApiKey() != null) {
            $envelopeData['apiKey'] = $this->getApiKey();
        }

        return $envelopeData;
    }
}