<?php
/**
 * Adds modActions and modMenus into package
 *
 * @package polls
 * @subpackage build
 */
$action= $modx->newObject('modAction');
$action->fromArray(array(
    'id' => 1,
    'namespace' => 'polls',
    'parent' => 0,
    'controller' => 'index',
    'haslayout' => 1,
    'lang_topics' => 'polls:default',
    'assets' => '',
),'',true,true);

/* load action into menu */
$menu= $modx->newObject('modMenu');
$menu->fromArray(array(
    'text' => 'polls',
    'parent' => 'components',
    'description' => 'polls.desc',
    'icon' => 'images/icons/plugin.gif',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
    'permissions' => 'polls.manage',
),'',true,true);
$menu->addOne($action);
unset($action);

return $menu;