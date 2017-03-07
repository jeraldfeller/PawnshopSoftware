<?php
require 'Model/Init.php';
require 'includes/require.php';

$miscTable = new Miscellaneous();
$view = new View();


$data = $_POST['data'];
if ($data == "p"){
    $past_due = $miscTable->getPastDuePawns();
    echo $view->displayPastDuePawns($past_due);
}

if ($data == "t") {
    $past_due_title = $miscTable->getPastDueTitlePawns();
    echo $view->displayPastDueTitlePawns($past_due_title);
}

if ($data == "r"){
	$past_due_title = $miscTable->getPastDueTitlePawns();
    echo $view->displayPastDueTitlePawnsRepo($past_due_title);
}


?>

