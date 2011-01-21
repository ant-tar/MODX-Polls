<?php
/**
 * Polls
 *
 * Copyright 2011 by Bert Oost <bertoost85@gmail.com>
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
 * The default Permission scheme for the Polls component.
 *
 * @package polls
 * @subpackage build
 */
$permissions = array();
$permissions[] = $modx->newObject('modAccessPermission',array(
    'name' => 'polls.manage',
    'description' => 'perm.manage_polls',
    'value' => true,
));
return $permissions;