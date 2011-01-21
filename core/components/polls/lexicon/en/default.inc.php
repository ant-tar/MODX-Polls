<?php
/**
 * The default English Poll lexicon entries
 *
 * @package polls
 * @subpackage lexion
 * @language: English
 * @author: Bert Oost
 * @translation-date: 2011-01-20
 */

$_lang['polls'] = "Polls";
$_lang['polls.manage'] = "Manage Polls";
$_lang['polls.desc'] = "Manage your poll categories, questions and answers here.";
$_lang['polls.search'] = "Search...";
$_lang['polls.publishdate'] = "Publishdate";
$_lang['polls.unpublishdate'] = "Unpublishdate";
$_lang['polls.hide'] = "Hide";
$_lang['polls.duplicate'] = "Duplicate";

// error strings
$_lang['polls.error.griddata'] = "No data from the grid has been found!";
$_lang['polls.error.update'] = "Could not update the record, because the record was unknown!";
$_lang['polls.error.save'] = "Failed to save the record data!";

// questions part
$_lang['polls.questions'] = "Questions";
$_lang['polls.question'] = "Question";
$_lang['polls.questionid'] = "QID";
$_lang['polls.question.nocategory'] = "No category";
$_lang['polls.questions.desc'] = "Here you can manage all the questions you want to be shown on your website. You're also able to hide polls from the website or publish and unpublish polls by setting dates. Edit values simple by clicking on the value.";
$_lang['polls.questions.create'] = "Create Question";
$_lang['polls.questions.create.error_save'] = "Failed to save the new question. Try it again!";
$_lang['polls.questions.votes'] = "Votes";
$_lang['polls.questions.duplicate'] = "Duplicate question and answers";
$_lang['polls.questions.duplicate_confirm'] = "Are you sure you want to duplicate the question and the answers? This would not duplicate the results stats like number of answers.";
$_lang['polls.questions.duplicate_error'] = "Failed duplicating question and/or answers. Try it again!";
$_lang['polls.questions.update'] = "Update Question";
$_lang['polls.questions.remove'] = "Remove Question";
$_lang['polls.questions.remove_confirm'] = "Are you sure you want to remove this question and all the answers and stats?";
$_lang['polls.questions.error_remove'] = "Failed to remove the question. Try it again!";

$_lang['polls.question.update'] = "Update question";
$_lang['polls.question.error_update'] = "Failed to update the question. Try it again!";
$_lang['polls.questions.errorload'] = "Failed to load the question!";

// categories part
$_lang['polls.categories'] = "Categories";
$_lang['polls.category'] = "Category";
$_lang['polls.category.filter'] = "Filter on Category";
$_lang['polls.categoryid'] = "Category ID";
$_lang['polls.categories.desc'] = "Below a list of the categories available for the questions. You can edit a category simple by clicking on the category name and removing by clicking with your right mousebutton.";
$_lang['polls.categories.create'] = "Create Category";
$_lang['polls.categories.create.error_save'] = "Failed to save the new category. Try it again!";
$_lang['polls.categories.remove'] = "Remove Category";
$_lang['polls.categories.remove_confirm'] = "Are you sure you want to remove this category and all the questions inside it?";
$_lang['polls.categories.error_remove'] = "Failed to remove the category. Try it again!";

// answers part
$_lang['polls.answers'] = "Answers";
$_lang['polls.answer'] = "Answer";
$_lang['polls.answerid'] = "Answer ID";
$_lang['polls.answers.btnback'] = "Back to questions";
$_lang['polls.answers.desc'] = "Manage here all the answers of the selected question. You can modify the answer by clicking on the text and you can change the number of sorting for the position of the answers. Note that answers with a sorting of 0 always be the last in the list.";
$_lang['polls.answers.votes'] = "Votes";
$_lang['polls.answers.percents'] = "Percents";
$_lang['polls.answers.sort'] = "Sorting";
$_lang['polls.answers.create'] = "Create Answer";
$_lang['polls.answers.create.error_save'] = "Failed to create the new answer. Try it again!";
$_lang['polls.answers.remove'] = "Remove Answer";
$_lang['polls.answers.remove_confirm'] = "Are you sure you want to remove this answer?";
$_lang['polls.answers.error_remove'] = "Failed to remove the answer. Try it again!";

?>