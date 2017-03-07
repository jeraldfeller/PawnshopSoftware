<?php
require 'Model/Init.php';
require SERVER_ROOT . '/' . VERSION . '/includes/require.php';





$employeeClass = new Employee();
$view = new View();

$unredeemed_pawns = $employeeClass->getUnredeemedTitlePawns();

echo $view->displayUnredeemedTitledPawns($unredeemed_pawns);