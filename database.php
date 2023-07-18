<?php

function connToData($query)
{
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost; dbname=bms;", $username, $password);

    $sql = $database->prepare($query);
    $sql->execute();
}


function getFromData($query)
{
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost; dbname=bms;", $username, $password);

    $sql = $database->prepare($query);
    $sql->execute();
    //$database = null;
    return $sql;
}
