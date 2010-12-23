<?php
require_once MODX_CORE_PATH . 'model/modx/modrequest.class.php';

/**
 * Encapsulates the interaction of MODx manager with an HTTP request.
 *
 * {@inheritdoc}
 *
 * @package polls
 * @extends modRequest
 */
class pollsControllerRequest extends modRequest {

	public $discuss = null;
	public $actionVar = 'action';
	public $defaultAction = 'polls';
	
	function __construct(Polls &$polls) {
		parent::__construct($polls->modx);
		$this->polls =& $polls;
    }
	
    /**
     * Extends modRequest::handleRequest and loads the proper error handler and
     * actionVar value.
     *
     * {@inheritdoc}
     */
    public function handleRequest() {
		$this->loadErrorHandler();
	   
		// save page to manager object. allow custom actionVar choice for extending classes
		$this->action = isset($_REQUEST[$this->actionVar]) ? $_REQUEST[$this->actionVar] : $this->defaultAction;
		
		return $this->_prepareResponse();
    }
	
	/**
	 * Prepares the MODx response to a mgr request that is being handled.
	 *
	 * @access public
	 * @return boolean True if the response is properly prepared.
	 */
	protected function _prepareResponse() {
		$modx =& $this->modx;
		$polls =& $this->polls;
		
		$viewHeader = include $this->polls->config['corePath'].'controllers/mgr/polls_header.php';
		
		$f = $this->polls->config['corePath'].'controllers/mgr/'.$this->action.'.php';
		
		if(file_exists($f)) {
			$viewOutput = include $f;
		}
		else {
			$viewOutput = 'Action not found: '.$f;
		}
		
		return $viewHeader.$viewOutput;
	}
}

?>