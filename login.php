<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

function msg($status,$msg){
    return array_merge([
        'status' => $status,
        'msg' => $msg
    ]);
}

$input = json_decode(file_get_contents("php://input"));

if (isset($input->username)&& isset($input->password)){
    $username = trim($input->username);
    $password = trim($input->password);
    $input_user="vaibhav";
    $input_pass="abcd12";
    if ($username==$input_user && $password==$input_pass){
        $output=msg(200,'Success');
    }

    else if (strlen($password)!=6){
        $output=msg(201,'Failure: password should be of length 6');
    }

    else if (!(preg_match('/[A-Za-z]/', $password) && preg_match('/[0-9]/', $password))){
        $output=msg(202,'Failure: password to have 1 character and 1 number');
    }

    else if ( ctype_digit($username)){
        $output=msg(203,'Failure: only characters allowed in username');
    }

}

echo (json_encode($output));

?>