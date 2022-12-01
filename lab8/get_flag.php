<?php

$code = $_POST['code'];
$files = scandir('flags_ISO_3166-1');
for ($i = 0; $i < count($files); $i++) {
    $value = $files[$i];
    $full_length = strlen($value);
    $type_length = strlen('.png');
    $files[$i] = strtoupper(substr($value, 0, $full_length - $type_length));
}

if (in_array($code, $files)) {
    $flag = strtolower($code) . ".png";
} else {
    $flag = "_unitednations.png";
}

echo $flag;
