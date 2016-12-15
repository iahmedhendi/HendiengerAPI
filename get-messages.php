<?php
 // ** © Hendiware www.hendiware.com **
// include Marei DB Class 
include 'DB.php';
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if id sent from client 
if(!isset($_POST['room_id'])){
    print "{\"status\":0,\"message\":\" room id is missing !\"}" ;
}else{
 // get room id from client 
    $room_id = $_POST['room_id'];
    echo $db->table("messages")->where('room_id',$room_id)->limit(25)->get();

}

