<?php
/**
 * Resolve creating db tables
 *
 * @package polls
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/';
            $modx->addPackage('polls', $modelPath);

            $manager = $modx->getManager();
			
			$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
            $manager->createObjectContainer('modPollCategory');
            $manager->createObjectContainer('modPollQuestion');
            $manager->createObjectContainer('modPollAnswer');
            $manager->createObjectContainer('modPollLog');
			
			// to change the default values (since v1.2-pl)
			$manager->alterField('modPollAnswer', 'votes');
			$manager->alterField('modPollAnswer', 'sort_order');
			$modx->setLogLevel(modX::LOG_LEVEL_INFO);
		break;
		
        case xPDOTransport::ACTION_UPGRADE:
		break;
    }
}
return true;