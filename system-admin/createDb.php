<?php
    include("xmlapi.php");

    $db_host = 'cashmaxinc.com'; 
    $cpaneluser = 'cashmax229';
    $cpanelpass = 'Pawn4223626'; 

    $databasename = 'Delta';
    $databaseuser = 'delta_user'; // Warning: in most of cases this can't be longer than 8 characters
    $databasepass = 'delta_pass'; // Warning: be sure the password is strong enough, else the CPanel will reject it

    $xmlapi = new xmlapi($db_host);    
    $xmlapi->password_auth("".$cpaneluser."","".$cpanelpass."");    
    $xmlapi->set_port(2083);
    $xmlapi->set_debug(1);//output actions in the error log 1 for true and 0 false  
    $xmlapi->set_output('array');//set this for browser output  
    //create database    
    $createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
    //create user 
    $usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
     //add user 
    $addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));
?>