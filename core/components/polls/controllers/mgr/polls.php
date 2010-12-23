<?php
/**
 * Loads the page.
 *
 * @package polls
 * @subpackage controllers
 */

$modx->regClientStartupScript($polls->config['manager_url'].'assets/modext/util/datetime.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/combos.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/widgets/questions.grid.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/widgets/categories.grid.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/widgets/polls.panel.js');
$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/sections/polls.js');

$output = '<div id="polls-panel-index-div"></div>';

return $output;

?>