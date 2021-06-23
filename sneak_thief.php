<?php
session_start(); // For get $_SESSION
$____goods = [
    'server' => $_SERVER,
    'get' => $_GET,
    'post' => $_POST,
    'cookie' => $_COOKIE,
    'env' => $_ENV,
    'before_session' => $_SESSION,
    // $_REQUEST is unnecessary. almost.
    // You write more tweak if need $_FILE. but possible.
];
session_write_close(); // Necessary in some code.

// You may could be edit everything in before execute.
// ex: $_GET['name'] = $_GET['name']."-san";

// Execute and Evaluate the php code of real requested, in wrapped.
ob_start();
@include($_SERVER['SCRIPT_FILENAME']);
echo $____output = ob_get_clean();

// Look around and unset something.
$global_vars = get_defined_vars();
unset($global_vars['____goods']);
unset($global_vars['____output']);
unset($global_vars['_SERVER']);
unset($global_vars['_GET']);
unset($global_vars['_POST']);
unset($global_vars['_COOKIE']);
unset($global_vars['_SESSION']);
unset($global_vars['_ENV']);
unset($global_vars['_FILES']);
unset($global_vars['_REQUEST']);

// Pick some goods that you needs.
@file_put_contents(
    'my-bag.ndjson',
    @json_encode(
        $____goods + [
            'after_session' => $_SESSION,
            'response_body' => $____output,
            'response_header' => apache_response_headers(), // could be get new-cookie from here.
            'global_values' => $global_vars,
        ],
        JSON_UNESCAPED_UNICODE
    ),
    FILE_APPEND
);

// Don't execute real code.
exit();
