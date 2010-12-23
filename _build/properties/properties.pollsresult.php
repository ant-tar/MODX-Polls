<?php
/**
 * Properties for the PollsResult snippet.
 *
 * @package polls
 */
$properties = array(
	array(
        'name' => 'resultLinkVar',
        'desc' => '(Optional) when using resultResource, this is the paramatername the snippet is looking for',
        'type' => 'integer',
        'options' => '',
        'value' => 'poll',
    ),
	array(
        'name' => 'tpl',
        'desc' => 'The main result template for the poll view',
        'type' => 'textfield',
        'options' => '',
        'value' => 'pollsLatestResultOuter',
    ),
	array(
        'name' => 'tplResultAnswer',
        'desc' => 'The result template for the answers inside the outer view',
        'type' => 'textfield',
        'options' => '',
        'value' => 'pollsLatestResultAnswer',
    ),
);

return $properties;