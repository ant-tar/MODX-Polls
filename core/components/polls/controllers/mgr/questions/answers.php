<?php
/**
 * Loads the question-answers editing page.
 *
 * @package polls
 * @subpackage controllers
 */
$modx->regClientStartupScript($modx->getOption('manager_url').'assets/modext/core/modx.view.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/combos.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/widgets/answers.grid.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/widgets/answers.panel.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/sections/answers.js');

$output = '<div id="question-panel-answers-div"></div>';

return $output;
