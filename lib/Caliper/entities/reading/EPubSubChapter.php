<?php


require_once (dirname(dirname(__FILE__)).'/CaliperDigitalResource.php');
require_once (dirname(dirname(__FILE__)).'/schemadotorg/CreativeWork.php');

/**
 * @author balachandiran.v
 *
 *         Representation of an EPUB 3 Volume
 *
 *         A major sub-division of a chapter
 *         http://www.idpf.org/epub/vocab/structure/#subchapter
 */
  class EPubSubChapter extends CaliperDigitalResource implements CreativeWork {

	public function __construct($id) {
		
		parent::__construct();
		$this->setId($id);
		$this->setType("http://www.idpf.org/epub/vocab/structure/#subchapter");
	}

}