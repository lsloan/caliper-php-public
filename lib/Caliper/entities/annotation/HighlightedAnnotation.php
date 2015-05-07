<?php

require_once 'Annotation.php';
require_once 'TextPositionSelector.php';

/**
 * @author balachandiran.v
 *
 */
class HighlightAnnotation extends Annotation implements JsonSerializable {

    private $selection;
    private $selectionText;

    public function __construct($id) {
        parent::__construct($id);
        $this->setType("http://purl.imsglobal.org/caliper/v1/HighlightAnnotation");
        $selection = new TextPositionSelector();
    }

    public function jsonSerialize() {
        return ['@id' => $this->getId(),
            '@type' => $this->getType(),
            'lastModifiedTime' => $this->getDateModified(),
            'properties' => (object)$this->getExtensions(),
            'target' => $this->getTarget(),
            'selection' => $this->getSelection(),
            'selectionText' => $this->getSelectionText()
        ];
    }

    /**
     * @return the selection
     */
    public function getSelection() {
        return $this->selection;
    }

    /**
     * @param selection
     *            the selection to set
     */
    public function  setSelection($selection) {
        $this->selection = $selection;
    }

    /**
     * @return the selectionText
     */
    public function  getSelectionText() {
        return $this->selectionText;
    }

    /**
     * @param selectionText
     *            the selectionText to set
     */
    public function setSelectionText($selectionText) {
        $this->selectionText = $selectionText;
    }

}
