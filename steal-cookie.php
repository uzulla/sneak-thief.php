<?php // steal-cookie.php
# capture COOKIE.
$pre_cookie = $_COOKIE['cookie-counter'] ?? '';

ob_start();
@include($_SERVER['SCRIPT_FILENAME']);
echo $____output = ob_get_clean();

# check new COOKIE.
$raw_header = apache_response_headers();
$cookie = $raw_header['Set-Cookie'] ?? "";
if (preg_match('/cookie-counter=([0-9]+)/u', $cookie, $_)) {
    $after_cookie = $_[1];
} else {
    $after_cookie = "";
}

# save.
@file_put_contents(
    'my-bag.ndjson',
    @json_encode(
        [
            'pre_cookie' => $pre_cookie,
            'after_cookie' => $after_cookie,
        ],
        JSON_UNESCAPED_UNICODE
    ),
    FILE_APPEND
);

exit();
