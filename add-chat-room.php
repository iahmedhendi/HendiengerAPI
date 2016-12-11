<?php
 // ** © Hendiware www.hendiware.com **
// include Marei DB Class 
include 'DB.php';
// get content input and create json object to parse it
$data = file_get_contents("php://input");
$obj = json_decode($data);
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if room name  and room desc sent from client 
if(!isset($obj->{'room_name'})){
    print "{\"status\":0,\"message\":\"Room Name  is Missing !\"}" ;
}else if(!isset($obj->{'room_desc'})){
    print "{\"status\":0,\"message\":\"Room Description is Missing !\"}" ;
}else{
    // store room name and desc in variables
    $roomname = $obj->{'room_name'};
    $roomdesc = $obj->{'room_desc'};
    // make query using marei db 
    $insertnewroom = $db->insert('chat_rooms',[
        'room_name' => $roomname,
        'room_desc' => $roomdesc 
    ]);    
    // check if query executed 
    if($insertnewroom){
             print "{\"status\":1,\"message\":\"Room Add Successfully !\"}" ;
    }else{
            print "{\"status\":0,\"message\":\"Error While Adding Room !\"}" ;
    }
}









