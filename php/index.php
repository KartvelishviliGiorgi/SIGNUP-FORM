<?php

require "database.php";

$db = new DataBase();
$db->createTable();

if(isset($_POST['name']) && isset($_POST['lname']) && isset($_POST['email']))
{
    if($db->isValidEmail($_POST['email'])){
        $db->addUser($_POST['name'], $_POST['lname'], $_POST['email']);
        echo "Accunt successfully registered";
    }
    else {
        echo "Account already exists with this email address";
    }
}