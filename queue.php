<?php
# SCRIPT TO SET THE TITLE FIELD IN URL TABLE

require_once("classes/Url.php");

// function to get webpage title
function getTitle($url) {
    $page = file_get_contents($url);
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $page, $match) ? $match[1] : null;
    return $title;
}

$url = new Url;
$response = $url->get_url_title_null();
if (isset($response)) {
    foreach ($response as $key => $value) {
        $title = "";
        $updated = false;
        $title = getTitle($value['redirecto']);
        if(isset($title)){
            $updated = $url->update_url_title($value["id"], $title);
        }
    }
}

?>