<?php


/**
 * @author balachandiran.v
 *
 * An Selector which describes a range of text based on its start and end positions
 * Defined by: http://www.w3.org/ns/oa#d4e667
 *
 */
class TextPositionSelector implements JsonSerializable {

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
	
	public function jsonSerialize(){
		return ['start'=>$this->getStart(),'end'=>$this->getEnd()];
	}

}
