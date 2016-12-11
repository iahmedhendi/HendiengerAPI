<?php
 // ** © Hendiware www.hendiware.com **
// include Marei DB Class 
include 'DB.php';
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if id sent from client 
if(!isset($_POST['id'])){
    print "{\"status\":0,\"message\":\" room id not found !\"}" ;
}else{
 // get user id from client 
    $room_id = $_POST['id'];
    // make query using marei db 
    $delete_room= $db->delete("chat_rooms")->where("id", $room_id)->exec();  
    // check if query executed 
    if($delete_room){
             print "{\"status\":1,\"message\":\"Room Deleted Successfully !\"}" ;
    }else{
            print "{\"status\":0,\"message\":\"Error While Deleteing Room !\"}" ;
    }
}









