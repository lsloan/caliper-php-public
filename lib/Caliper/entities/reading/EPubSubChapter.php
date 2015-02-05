<?php
$caliperLibDir = dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR;

require_once ($caliperLibDir . 'Caliper/entities/CaliperDigitalResource.php');
require_once ($caliperLibDir . 'Caliper/entities/schemadotorg/CreativeWork.php');

/**
 *         Representation of an EPUB 3 Volume
 *
 *         A major sub-division of a chapter
 *         http://www.idpf.org/epub/vocab/structure/#subchapter
 */
class EPubSubChapter extends CaliperDigitalResource implements CreativeWork, JsonSerializable {
      private $index;

      public function __construct($id) {
		parent::__construct();
		$this->setId($id);
		$this->setType("http://www.idpf.org/epub/vocab/structure/#subchapter");
      }

      public function jsonSerialize() {
	    return array_merge(parent::jsonSerialize(), [
		  'index' => $this->getIndex()
	    ]);
      }

      /**
       * @return mixed
       */
      public function getIndex() {
	    return $this->index;
      }
      
      /**
       * @param mixed $index
       */
      public function setIndex($index) {
	    $this->index = $index;
      }


}