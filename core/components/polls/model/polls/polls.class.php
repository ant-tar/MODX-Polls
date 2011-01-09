<?php
/**
 * The Polls object
 *
 * @package polls
 */
class Polls {
	
	/**
     * Constructs the object
     *
     * @param modX &$modx A reference to the modX object
     * @param array $config An array of configuration options
     */
    function __construct(modX &$modx, array $config=array()) {
		$this->modx =& $modx;
		
		$namespace = $this->modx->getObject('modNamespace', 'polls');
		
		$basePath = $namespace->get('path');
		$assetsUrl = $this->modx->getOption('assets_url').'components/polls/';
		
		$this->config = array_merge(array(
			'basePath' => $basePath,
			'corePath' => $basePath,
			'modelPath' => $basePath.'model/',
			'processorsPath' => $basePath.'processors/',
			'chunksPath' => $basePath.'elements/chunks/',
			'jsUrl' => $assetsUrl.'js/',
			'cssUrl' => $assetsUrl.'css/',
			'assetsUrl' => $assetsUrl,
			'connectorUrl' => $assetsUrl.'connector.php',
		), $config);
	   
		$this->modx->addPackage('polls', $this->config['modelPath']);
	   
		// Will create models etc.
		//$this->_setupModels();
	}
	
	/**
     * Initializes the class into the proper context
     *
     * @access public
     * @param string $ctx
     */
    public function initialize($ctx='web') {
		switch ($ctx) {
			case 'mgr':
				$this->modx->lexicon->load('polls:default');
				
				if(!$this->modx->loadClass('polls.request.pollsControllerRequest', $this->config['modelPath'], true, true)) {
					return 'Could not load controller request handler.';
				}
				
				$this->request = new pollsControllerRequest($this);
				
				return $this->request->handleRequest();
            break;
			
            case 'connector':
				if(!$this->modx->loadClass('polls.request.pollsConnectorRequest', $this->config['modelPath'], true, true)) {
                    die('Could not load connector request handler.');
                }
				
				$this->request = new pollsConnectorRequest($this);
				
				return $this->request->handle();
            break;
            default: break;
        }
        return true;
    }
	
	/**
	 * Will generate the models for this part
	 */
	private function _setupModels() {
		/*
		$this->modx->setLogLevel(xPDO::LOG_LEVEL_INFO);
		$this->modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
		*/
		$manager = $this->modx->getManager();
		$generator = $manager->getGenerator();
		
		$schema = $this->config['modelPath'].'schema/polls.mysql.schema.xml';
		$generator->parseSchema($schema, $this->config['modelPath']);
		exit();
	}
}

?>