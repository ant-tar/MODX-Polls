<?php
/**
 * @package polls
 * @subpackage controllers
 */
require_once dirname(dirname(__FILE__)).'/model/polls/polls.class.php';

$model = new Polls($modx);
return $model->initialize('mgr');

?>