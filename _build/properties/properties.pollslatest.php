<?php
/**
 * Properties for the PollsLatest snippet.
 *
 * @package polls
 */
$properties = array(
    array(
        'name' => 'category',
        'desc' => '(Optional) When set: will select the latest poll from the given category (id)',
        'type' => 'integer',
        'options' => '',
        'value' => '',
    ),
	array(
        'name' => 'resultResource',
        'desc' => '(Optional) when set to a resource id, this resource will be used to show the poll results',
        'type' => 'integer',
        'options' => '',
        'value' => '',
    ),
	array(
        'name' => 'resultLinkVar',
        'desc' => '(Optional) when using resultResource, this is the paramatername the snippet is looking for',
        'type' => 'integer',
        'options' => '',
        'value' => 'poll',
    ),
	array(
        'name' => 'submitVar',
        'desc' => 'A name wich is provided when posting a vote. This is needed to use multiple polls on one page. This could be the name of the submitbutton or a hidden field in the form',
        'type' => 'textfield',
        'options' => '',
        'value' => 'pollVote',
    ),
	array(
        'name' => 'answerVar',
        'desc' => 'The name of the answer post variable. This could not be empty and could be default for all polls',
        'type' => 'textfield',
        'options' => '',
        'value' => 'answer',
    ),
	array(
        'name' => 'tplVote',
        'desc' => 'The main form template for the latest poll view',
        'type' => 'textfield',
        'options' => '',
        'value' => 'pollsLatestVoteOuter',
    ),
	array(
        'name' => 'tplVoteAnswer',
        'desc' => 'The form template for the answers inside the main view',
        'type' => 'textfield',
        'options' => '',
        'value' => 'pollsLatestVoteAnswer',
    ),
	array(
        'name' => 'tplResult',
        'desc' => 'The main result template for the latest poll view',
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