<?php
/**
 * Loads the header for mgr pages.
 *
 * @package polls
 * @subpackage controllers
 */

$modx->regClientStartupScript($polls->config['jsUrl'].'mgr/polls.js');
$modx->regClientStartupHTMLBlock('<script type="text/javascript">
Ext.onReady(function() {
    Polls.config = '.$modx->toJSON($polls->config).';
    Polls.config.connector_url = "'.$polls->config['connectorUrl'].'";
    Polls.request = '.$modx->toJSON($_GET).';
});
</script>');

return '';

?>