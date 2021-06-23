<?php
## Old-skool style PHP will never die.
session_start();

## Greet is important!!!!
$name = $_GET['name'];
echo "<h1>hello! ".$_GET['name']."</h1>";

## Confidential must be stored within the session, you know?
if(!isset($_SESSION['my-secret'])){
    $secret = rand(1,1000);
    $_SESSION['my-secret'] = $name . $secret;
}
echo "<h2>my-secret:".$_SESSION['my-secret']."</h2>";

## Cookie is yum.
if(!isset($_COOKIE['cookie-counter'])){
    $counter = 0;
}else{
    $counter = (int)$_COOKIE['cookie-counter'];
}
$counter++;
echo "<h2>counter:$counter</h2>";
setcookie('cookie-counter', $counter);

?>