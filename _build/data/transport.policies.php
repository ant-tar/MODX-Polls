<?php
/**
 * Polls
 *
 * Copyright 2010 by Bert Oost <bertoost85@gmail.com
 *
 * This file is part of Polls, a simpel question/answer component for MODx Revolution.
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
 * Default Polls Access Policies
 *
 * @package polls
 * @subpackage build
 */
function bld_policyFormatData($permissions) {
    $data = array();
    foreach ($permissions as $permission) {
        $data[$permission->get('name')] = true;
    }
    return $data;
}
$policies = array();
$policies[1]= $modx->newObject('modAccessPolicy');
$policies[1]->fromArray(array (
  'id' => 1,
  'name' => 'PollsPolicy',
  'description' => 'A policy for managing Polls questions and answers.',
  'parent' => 0,
  'class' => '',
  'lexicon' => 'polls:permissions',
  'data' => '{"polls.manage":true}',
), '', true, true);

return $policies;