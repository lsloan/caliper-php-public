<?php

/**
 * 
 * @author 
 *
 */
class CaliperEntity implements JsonSerializable{

    protected  $id;
    public  $type;
    private $lastModifiedAt =0;
    private $properties ;
    
    public function __construct()
    {
    	
    }   

    /**
     * @return the id
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @param mixed $id
     * 				the id to set
     */
    public function setId($id) {
    	$this->id = $id;
    }
    
    /**
     * @param mixed $lastModifiedAt
     *  					the lastModifiedAt to set
     */
    public function setLastModifiedAt($lastModifiedAt) {
        $this->lastModifiedAt = $lastModifiedAt;
    }

    /**
     * @return the lastModifiedAt
     */
    public function getLastModifiedAt() {
        return $this->lastModifiedAt;
    }

    /**
     * @param mixed $properties
     * 						the properties to set
     */
    public function setProperties($properties) {
        $this->properties = $properties;
    }

    /**
     * @return the properties
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * @param mixed $type
     * 				the type to set
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return the type
     * 			
     */
    public function getType() {
        return $this->type;
    }
    
    /**
     ** @see JsonSerializable::jsonSerialize()
     *to implement jsonLD
     */
    public function jsonSerialize( ){
    	
    	return ['@id'=>$this->getId(),
		    	'@type'=>$this->getType(),
		    	'lastModifiedTime'=>$this->getLastModifiedAt(),
		    	'properties'=>(object) $this->getProperties()
				];
    }
} 