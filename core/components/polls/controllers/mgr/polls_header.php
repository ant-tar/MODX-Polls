<?php
/**
 * Loads the header for mgr pages.
 *
 * @package polls
 * @subpackage controllers
 */
$modxtags = array_values($modx->sanitizePatterns);
$depth = (int)ini_get('max_input_nesting_level');
$depth = ($depth <= 0) ? 99 : $depth + 1;
$get =  $modx->sanitize($_GET, $modxtags, $depth);

$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/polls.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    Polls.config = '.$modx->toJSON($polls->config).';
    Polls.config.connector_url = "'.$polls->config['connectorUrl'].'";
    Polls.request = '.json_encode($get).';
});
</script>');

return '';

?>