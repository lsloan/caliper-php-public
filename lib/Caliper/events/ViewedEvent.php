<?php


require_once (dirname(dirname(__FILE__)).'/CaliperEvent.php');
require_once (dirname(dirname(dirname(__FILE__))).'/entities/CaliperDigitalResource.php');
require_once (dirname(dirname(dirname(__FILE__))).'/actions/ReadingActions.php');

/**
 * @author balachandiran.v
 *
 */
class ViewedEvent extends CaliperEvent {

	public function __construct(){
		parent::__construct();

        $this->setContext(CaliperEventContexts::VIEWED);
        $this->setType(CaliperEventTypes::VIEWED);
        $this->setAction(ReadingActions::VIEWED);
	}
}
