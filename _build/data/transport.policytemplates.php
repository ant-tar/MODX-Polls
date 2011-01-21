<?php
/**
 * Polls
 *
 * Copyright 2011 by Bert Oost <bertoost85@gmail.com>
 *
 * This file is part of Polls, a simpel commenting component for MODx Revolution.
 *
 * Polls is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Polls is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Polls; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package polls
 */
/**
 * Default Polls Access Policy Templates
 *
 * @package polls
 * @subpackage build
 */
$templates = array();

/* administrator template/policy */
$templates['1'] = $modx->newObject('modAccessPolicyTemplate');
$templates['1']->fromArray(array(
	'id' => 1,
	'name' => 'PollsPolicyTemplate',
	'description' => 'A policy for managing Polls questions and answers.',
	'lexicon' => 'polls:permissions',
	'template_group' => 1,
));
$permissions = include dirname(__FILE__).'/permissions/polls.policy.php';
if (is_array($permissions)) {
	$templates['1']->addMany($permissions);
}
else {
	$modx->log(modX::LOG_LEVEL_ERROR,'Could not load Administrator Policy Template.');
}

return $templates;
