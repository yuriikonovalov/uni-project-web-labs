<?php
$ip = $_POST['ip'];
$endpoint = "http://ip-api.com/json/$ip";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $endpoint);
$json = curl_exec($curl);
curl_close($curl);
// $json has one charachter after json text, so in order to pass it as json need to delete that character.
echo substr($json, 0, strlen($json) - 1);
