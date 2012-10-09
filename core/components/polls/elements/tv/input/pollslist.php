<?php
/**
 * The Polls TV input type
 * 
 * @author Bert Oost @ OostDesign
 * @copyright Copyright Bert Oost <bert@oostdesign.nl>
 * @package polls
 */
$modx->lexicon->load('tv_widget','polls:default');
$modx->smarty->assign('base_url',$this->xpdo->getOption('base_url'));

$corePath = $modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/');
$modx->addPackage('polls',$corePath.'model/');

if (empty($params)) $params = array();

$category = (int)$modx->getOption('category',$params,0);
$sort = $modx->getOption('sort',$params,'publishdate DESC, id');
$dir = $modx->getOption('dir',$params,'DESC');
$limit = (int)$modx->getOption('limit',$params,0);

// get list of questions
$c = $modx->newQuery('modPollQuestion');

if(!empty($category)) {
    $categories = explode(',',$category);
    foreach($categories as $category) {
        if(!empty($category) && is_numeric($category)) {
            $c->orCondition(array('category:=' => $category));
        } else if(!empty($category)) {
            $category = $modx->getObject('modPollCategory', array('name' => $category));
            if(!empty($category) && is_object($category) && $category instanceof modPollCategory) {
	            $c->orCondition(array('category:=' => $category->get('id')));
            }
        }
    }
}

$c->where(array(
    "(`modPollQuestion`.`publishdate` <= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`publishdate` IS NULL)",
    "(`modPollQuestion`.`unpublishdate` >= '".date('Y-m-d H:i:s')."' OR `modPollQuestion`.`unpublishdate` IS NULL)",
	'modPollQuestion.hide' => false,
));
$c->sortby($sort, $dir);
if(!empty($limit)) {
	$c->limit($limit);
}

$questions = $modx->getCollection('modPollQuestion', $c);
$list = array();

foreach($questions as $question) {
	$questionArray = array(
		$question->get('id'),
		$question->get('question'),
	);
	$list[] = $questionArray;
}
$modx->smarty->assign('list',$modx->toJSON($list));

return $modx->smarty->fetch($corePath.'elements/tv/pollslist.input.tpl');

?>