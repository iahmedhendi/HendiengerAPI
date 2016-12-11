<?php
 // ** © Hendiware www.hendiware.com **
// include Marei DB Class 
include 'DB.php';
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');

echo $db->table("chat_rooms")->get();


