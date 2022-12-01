<?php
$ip = $_SERVER['REMOTE_ADDR'];
$endpoint = "http://ip-api.com/xml/$ip";
$xml = simplexml_load_file($endpoint);
echo $xml->asXML();
