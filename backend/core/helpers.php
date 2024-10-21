<?php
function basePath($path) {
    return BASE_PATH . $path;
}

function abort($message, $code = 404) {
    http_response_code($code);
    echo $message;
    exit();
}

function dataGet($arr, $key) {
    if (!is_array($arr) || empty($key)) {
        return null;
    }

    $keysArr = explode(".", $key);
    $searchedKey = end($keysArr);
    $current = $arr;

    foreach ($keysArr as $k) {
        if (isset($current[$k])) {
            $current = $current[$k];
        } else {
            return null;
        }
    }

    return $current;
}
