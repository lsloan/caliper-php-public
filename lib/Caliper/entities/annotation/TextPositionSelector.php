<?php


/**
 * 
 *
 * An Selector which describes a range of text based on its start and end positions
 * Defined by: http://www.w3.org/ns/oa#d4e667
 *
 */
class TextPositionSelector {

	private $start;
	private $end;

	/**
	 * @return the start
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * @param start
	 *            the start to set
	 */
	public function  setStart($start) {
		$this->start = $start;
	}

	/**
	 * @return the end
	 */
	public function  getEnd() {
		return $this->end;
	}

	/**
	 * @param end
	 *            the end to set
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

}
