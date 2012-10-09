<?php

$modx->lexicon->load('tv_widget','polls:tvrenders');
$modx->smarty->assign('base_url',$modx->getOption('base_url'));

$corePath = $modx->getOption('polls.core_path',null,$modx->getOption('core_path').'components/polls/');
$modx->addPackage('polls',$corePath.'model/');

/* get categories */
$categories = $modx->getCollection('modPollCategory');
$list = array();

foreach($categories as $category) {
	$categoryArray = array(
		$category->get('id'),
		$category->get('name'),
	);
	$list[] = $categoryArray;
}

/* get TV input properties specific language strings */
$lang = $modx->lexicon->fetch('polls',true);
$modx->smarty->assign('pls',$lang);
$modx->smarty->assign('categories',$modx->toJSON($list));

return $modx->smarty->fetch($corePath.'elements/tv/pollslist.inputproperties.tpl');

?>