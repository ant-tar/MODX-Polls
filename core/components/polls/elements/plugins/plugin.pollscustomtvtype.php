<?php
/**
 * PollsCustomTVType
 *
 * This plugin will create the Polls custom TV input type
 * 
 * @author Bert Oost @ OostDesign
 * @copyright Copyright Bert Oost <bert@oostdesign.nl>
 * @package polls
 */
$polls = $modx->getService('polls','Polls',$modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/').'model/polls/',$scriptProperties);
if (!($polls instanceof Polls)) return '';

$modx->lexicon->load('polls:tvrenders');

$corePath = $modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/');
switch($modx->event->name) {
    case 'OnTVInputRenderList':
        $modx->event->output($polls->config['corePath'].'elements/tv/input/');
    break;
    case 'OnTVInputPropertiesList':
        $modx->event->output($polls->config['corePath'].'elements/tv/properties/input/');
    break;
}

?>