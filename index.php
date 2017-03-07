<?php
include 'Model/Init.php';

if (isset($_SESSION['company_login']) && $_SESSION['company_login'] == TRUE) {
    Header('Location: ' . $_SESSION['company']['version'] . '/index');
}else{
    Header('Location: login');
}