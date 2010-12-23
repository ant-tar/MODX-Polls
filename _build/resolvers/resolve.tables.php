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

            $manager->createObjectContainer('modPollCategory');
            $manager->createObjectContainer('modPollQuestion');
            $manager->createObjectContainer('modPollAnswer');
            $manager->createObjectContainer('modPollLog');

            break;
        case xPDOTransport::ACTION_UPGRADE:
            break;
    }
}
return true;