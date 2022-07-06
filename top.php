<?php
# ENDPONT TO LIST THE MOST FRECUENTLY USED URL's

require_once("classes/Url.php");
header( 'Content-Type: application/json' );

$data = [
    "status" => 401,
    "message" => "no registers"
];


$url = new Url;
$res = $url->get_top(100);
if($res){
    $data["status"] = 200;
    $data["message"] = "top url gotten";
    $data["data"] = $res;
}

echo json_encode($data);

ob_end_flush();
