<?php
# ENDPONT TO REDIRECT URL's

require_once("classes/Url.php");
header( 'Content-Type: application/json' );

$data = [
    "status" => 401,
    "message" => "URL not found"
];

if(isset($_REQUEST["code"])){
    $code = $_REQUEST["code"];
    $url = new Url;
    $res = $url->redirecto($code);
    if($res){
        header('Location: '.$res);
    }
}

echo json_encode($data);

ob_end_flush();
