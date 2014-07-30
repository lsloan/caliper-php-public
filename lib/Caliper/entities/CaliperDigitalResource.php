<?php

/**
 * @author balachandiran.v
 *
 *         Caliper representation of a CreativeWork
 *         (https://schema.org/CreativeWork)
 *
 *         We add on learning specific attributes, including a list of
 *         {@link LearningObjective} learning objectives and a list of
 *         {@link String} keywords
 *
 *         In addition, we add a the following attributes:
 *
 *         name (https://schema.org/name) -the name of the resource,
 *
 *         about (https://schema.org/about) - the subject matter of the resource
 *
 *         language (https://schema.org/Language) - Natural languages such as
 *         Spanish, Tamil, Hindi, English, etc. and programming languages such
 *         as Scheme and Lisp
 *
 */


class CaliperDigitalResource extends CaliperEntity implements JsonSerializable {

	public  function __construct(){
	
	}
	private $name;
	private $parentRef;	
	private $alignedLearningObjectives = array();	
	private $keywords = array();	
	private $about;
	private $language;

	/**
	 * @return the name
	 */
	public function  getName(){
		return $this->name;
	}

	/**
	 * @param name
	 *            the name to set
	 */
	public function setName($name) {
		$this->name = $name;
	}
	/**
	 * @return the parentRef
	 */
	public function getParentRef() {
		return $this->parentRef;
	}
	
	/**
	 * @param parentRef the parentRef to set
	 */
	public function setParentRef($parentRef) {
		$this->parentRef = $parentRef;
	}
	
	/**
	 * @return the alignedLearningObjectives
	 */
	public function  getAlignedLearningObjectives() {
		return $this->alignedLearningObjectives;
	}
	
	/**
	 * @param alignedLearningObjectives the alignedLearningObjectives to set
	 */
	public function setAlignedLearningObjectives($alignedLearningObjectives) {
		$this->alignedLearningObjectives = $alignedLearningObjectives;
	}
	
	/**
	 * @return the keywords
	 */
	public function  getKeywords() {
		return $this->keywords;
	}
	
	/**
	 * @param keywords the keywords to set
	 */
	public function setKeywords($keywords) {
		$this->keywords = $keywords;
	}
	
	/**
	 * @return the about
	 */
	public function  getAbout() {
		return $this->about;
	}
	
	/**
	 * @param about the about to set
	 */
	public function  setAbout($about) {
		$this->about = $about;
	}
	
	/**
	 * @return the language
	 */
	public function  getLanguage() {
		return $this->language;
	}
	
	/**
	 * @param language the language to set
	 */
	public function  setLanguage($language) {
		$this->language = $language;
	}

	/**
	 ** @see JsonSerializable::jsonSerialize()
	 *to implement jsonLD
	 */
	
	public  function jsonSerialize()
	{
		
		return  ['@id'=>$this->getId(),
					'@type'=>$this->getType(),
					'lastModifiedTime'=>$this->getLastModifiedAt(),
					'properties'=>(object) $this->getProperties(),
					"name"=>$this->getName(),
					'alignedLearningObjectives'=>$this->getAlignedLearningObjectives(),
					'keywords'=>$this->keywords,
					"about"=>$this->getAbout(),
					'language'=>$this->getLanguage(),
					'partOf'=>$this->getParentRef()
				];
		
	}


}
