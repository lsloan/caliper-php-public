<?php

/**
 *  author: Prashant Nayak
 *  ©2013 IMS Global Learning Consortium, Inc.  All Rights Reserved.
 *  For license information contact, info@imsglobal.org
 *
 *  Envelope required for our reference event store
 */

class EventStoreEnvelope implements JsonSerializable {

	private $id;
    private $type;
    private $time;
    private $data;


    /**
     * Create a new EventStoreEnvelope
     */
    public function __construct($data) {

    	$this->setData($data);

    	// Autogenerate guid and timestamp for Envelope
    	// Note: this is not the CaliperEvent timestamp
    	$this->setId($this->getNewGUID());
    	$this->setType("caliperEvent");
    	$this->setTime(time()*1000);
    }
	
	
	/*
	 * 
	 */
	public function __destruct() {
    }
    
    /**
     * @param mixed $id
     */
    public function setId($id) {
    	$this->id = $id;
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
    }
    
    /**
     * @return mixed
     */
    public function getType() {
    	return $this->type;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time) {
    	$this->time = $time;
    }
    
    /**
     * @return mixed
     */
    public function getTime() {
    	return $this->time;
    }

     /**
     * @param mixed $data
     */
    public function setData($data) {
    	$this->data = $data;
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

	/**
     * 
     * @see JsonSerializable::jsonSerialize()
     *  
     */
    public  function jsonSerialize(){
    	
	    return [['id'=>$this->getId(),
	    		'type'=>$this->getType(),
	    		'time'=>$this->getTime(),
				'data'=>$this->getData()
				]];    
    }
}