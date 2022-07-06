<?php
# ENDPONT TO CREATE NEW SHORT URL

require_once("classes/Url.php");
header( 'Content-Type: application/json' );

$data = [
    "status" => 401,
    "message" => "param url required"
];

if(isset($_REQUEST["url"])){
    $request_url = explode('shorter.php', $_SERVER['REQUEST_URI']);
    $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST']."".$request_url[0];
    $url_to_short = $_REQUEST["url"];
    $url = new Url;
    $res = $url->shorturl($url_to_short);
    if($res){
        $data["status"] = 200;
        $data["message"] = "url registered";
        $data["url_shorted"] = $current_url."url.php?code=".$res;
    }
}

echo json_encode($data);

ob_end_flush();
