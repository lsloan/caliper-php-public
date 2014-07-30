<?php
require_once (dirname(dirname(__FILE__)).'/CaliperDigitalResource.php');
require_once (dirname(dirname(__FILE__)).'/schemadotorg/CreativeWork.php');
/**
 * @author balachandiran.v
 *
 *         Representation of an EPUB 3 Volume
 *
 *         A major structural division of a piece of writing, typically
 *         encapsulating a set of related chapters.
 *         http://www.idpf.org/epub/vocab/structure/#part
 *
 */
class EPubPart extends CaliperDigitalResource implements CreativeWork {

	public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType("http://www.idpf.org/epub/vocab/structure/#part");
	}

}