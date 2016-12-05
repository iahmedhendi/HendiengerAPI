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
// check if email and password sent from client 
if(!isset($obj->{'email'})){
    print "{\"status\":0,\"message\":\"Email is Missing !\"}" ;
}else if(!isset($obj->{'password'})){
    print "{\"status\":0,\"message\":\"Password is Missing !\"}" ;
}else{
    // store user name and password in variables
    $useremail = $obj->{'email'};
    $userpassword = $obj->{'password'};
    // make query using marei db 
    $check_email_password = $db->table('users')
    ->where('user_email','=',$useremail)
    ->where("user_password","=",$userpassword)
    ->get();
    
    // check count of found results
    if($db->getCount()>0){
             print "{\"status\":1,\"message\":\"Welcome !\"}" ;

    }else{
            print "{\"status\":0,\"message\":\"Error in Email or Password\"}" ;
    }
}









