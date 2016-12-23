<?php
 // ** © Hendiware www.hendiware.com **
include 'DB.php';
// get content input and create json object to parse it
$data = file_get_contents("php://input");
$obj = json_decode($data);
// create db instance to use marei db queris 
$db = DB::getInstance();
// set type of header response to application/json for respone 
header('Content-Type: application/json');
// check if any data missing when  sent from client 
if(!isset($obj->{'room_id'})){
    print "{\"status\":0,\"message\":\"Room id  is Missing !\"}" ;
}else if(!isset($obj->{'user_id'})){
    print "{\"status\":0,\"message\":\"User id is Missing !\"}" ;
}else if(!isset($obj->{'user_name'})){
    print "{\"status\":0,\"message\":\"Username is Missing !\"}" ;
}else if(!isset($obj->{'type'})){
    print "{\"status\":0,\"message\":\"type is Missing !\"}" ;
}else if(!isset($obj->{'content'})){
    print "{\"status\":0,\"message\":\"Content is Missing !\"}" ;
}else{
    // store room name and desc in variables
    $room_id = $obj->{'room_id'};
    $user_id = $obj->{'user_id'};
    $user_name = $obj->{'user_name'};
    $type = $obj->{'type'};
    $content = $obj->{'content'};
    // make query using marei db 
    $insertnewmessage = $db->insert('messages',[
        'room_id' => $room_id,
        'user_id' => $user_id,
        'user_name' => $user_name,
        'type' => $type,
        'content' => $content 
    ]);    
    // check if query executed 
    if($insertnewmessage){
             print "{\"status\":1,\"message\":\"Message Add Successfully !\"}" ;
    }else{
            print "{\"status\":0,\"message\":\"Error While Adding Message !\"}" ;
    }

$date = date("Y-m-d h:i:s");
        $url = 'https://fcm.googleapis.com/fcm/send';
    $fcmdata =  "{
       \"to\": \"/topics/room12\",
       \"data\": {
       \"message\": \"".$content."\",
       \"room_id\":\"".$room_id."\",
       \"user_id\":\"".$user_id."\",
       \"username\":\"".$user_name."\",
       \"type\":\"".$type."\",
       \"timestamp\":\"".$date."\"
   }
}";
    //************   rplace this with your api key ***************// 
    define("GOOGLE_API_KEY", "AIzaSyDgP1YfW1KzqJtyQmPeDSKAnYVNKbXvMuU");
    $headers = array(
        'Authorization: key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fcmdata);
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    echo $result;
}









