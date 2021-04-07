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
    Polls.config = '.json_encode($polls->config).';
});
</script>');

return '';

?>