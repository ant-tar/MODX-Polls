<?php
/**
 * The default French Poll lexicon entries
 *
 * @package polls
 * @subpackage lexion
 * @language: Français
 * @author: Romain Fallet
 * @translation-date: 2014-07-16
 */

$_lang['polls'] = "Sondages";
$_lang['polls.manage'] = "Gérer les sondages";
$_lang['polls.desc'] = "Gérer les catégories des sondages, des questions et des réponses ici.";
$_lang['polls.search'] = "Rechercher";
$_lang['polls.publishdate'] = "Date de publication";
$_lang['polls.unpublishdate'] = "Date de fin de publication";
$_lang['polls.hide'] = "Cacher";
$_lang['polls.duplicate'] = "Dupliquer";

// error strings
$_lang['polls.error.griddata'] = "Aucune donnée n'a été trouvée.";
$_lang['polls.error.update'] = "Echec de la mise à jour de cette entrée, l'entrée spécifiée est introuvable.";
$_lang['polls.error.save'] = "Echec de la sauvegarde des données spécifiées.";

// questions part
$_lang['polls.questions'] = "Questions";
$_lang['polls.question'] = "Question";
$_lang['polls.questionid'] = "QID";
$_lang['polls.question.nocategory'] = "Pas de catégorie";
$_lang['polls.questions.desc'] = "Ici vous pouvez gérer toutes les questions que vous voulez voir sur le site. Vous pouvez également cacher les sondages du site ou les publier et les dépublier en spécifiant des dates de publication. Cliquez sur les entrées pour les éditer.";
$_lang['polls.questions.create'] = "Créer une question";
$_lang['polls.questions.create.error_save'] = "Echec de la sauvegarde de la nouvelle question. Veuillez réessayer.";
$_lang['polls.questions.votes'] = "Votes";
$_lang['polls.questions.duplicate'] = "Dupliquer la question et les réponses";
$_lang['polls.questions.duplicate_confirm'] = "Êtes-vous sûr de vouloir dupliquer la question et les réponses ? Cela ne duliquera pas les statistiques de nombre de votes.";
$_lang['polls.questions.duplicate_error'] = "Echec de la duplication de la question et/ou des réponses. Veuillez réessayer.";
$_lang['polls.questions.update'] = "Mettre à jour la question";
$_lang['polls.questions.remove'] = "Supprimer la question";
$_lang['polls.questions.remove_confirm'] = "Êtes-vous sûr de vouloir supprimer cette question ainsi que toutes ses réponses et statistiques ?";
$_lang['polls.questions.error_remove'] = "Echec de la supprission de cette question. Veuillez réessayer.";

$_lang['polls.question.update'] = "Mettre à jour la question";
$_lang['polls.question.error_update'] = "Echec de la mise à jour de cette question. Veuillez réessayer.";
$_lang['polls.questions.errorload'] = "Echec du chargement de la question.";

// categories part
$_lang['polls.categories'] = "Catégories";
$_lang['polls.category'] = "Catégorie";
$_lang['polls.category.filter'] = "Filtrer par catégorie";
$_lang['polls.categoryid'] = "ID de la catégorie";
$_lang['polls.categories.desc'] = "Ci-dessous la liste des catégories disponibles pour les questions. Vous pouvez éditer une catégorie en cliquant simplement sur le nom de la catégorie et la supprimer en faisant un clic droit.";
$_lang['polls.categories.create'] = "Créer une catégorie";
$_lang['polls.categories.create.error_save'] = "Echec de la sauvegarde de la nouvelle catégorie. Veuillez réessayer.";
$_lang['polls.categories.remove'] = "Supprimer la catégorie.";
$_lang['polls.categories.remove_confirm'] = "Êtes-vous sûr de vouloir supprimer cette catégorie ainsi que toutes les questions qui y sont affiliées ?";
$_lang['polls.categories.error_remove'] = "Echec de la suppression de cette catégorie. Veuillez réessayer.";

// answers part
$_lang['polls.answers'] = "Réponses";
$_lang['polls.answer'] = "Réponse";
$_lang['polls.answerid'] = "ID de la réponse";
$_lang['polls.answers.btnback'] = "Retour aux questions";
$_lang['polls.answers.desc'] = "Gérez ici toutes les réponses de la question sélectionnée. Vous pouvez modifier la réponse en cliquant sur le texte ou changer son ordre en modifiant la valeur du champ « Position ». Notez que les réponses dont la position est : « 0 » seront toujours les dernières dans la liste.";
$_lang['polls.answers.votes'] = "Votes";
$_lang['polls.answers.percents'] = "Pourcents";
$_lang['polls.answers.sort'] = "Position";
$_lang['polls.answers.create'] = "Créer une réponse";
$_lang['polls.answers.create.error_save'] = "Impossible de créer la nouvelle réponse. Veuillez réessayer.";
$_lang['polls.answers.remove'] = "Supprimer la réponse.";
$_lang['polls.answers.remove_confirm'] = "Êtes-vous sûr de vouloir supprimer cette réponse ?";
$_lang['polls.answers.error_remove'] = "Echec de la suppression de cette réponse. Veuillez réessayer.";

?>