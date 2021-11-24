<?php
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo "PHP GD library is installed on your web server <br>";
} else {
    echo "PHP GD library is NOT installed on your web server <br>";
}

$infos = gd_info();
foreach ($infos as $key => $value) {
    // $arr[3] wird mit jedem Wert von $arr aktualisiert...
    echo "{$key} => {$value} <br>";
}

// while (list ($key, $val) = each ($a)) {
//   echo "$key -> $val <br>";
// }
