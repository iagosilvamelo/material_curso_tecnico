<?php
require_once ('vendor/autoload.php');

Flight::set('flight.log_errors', true);
$app = new flight\Engine();

$app->route('get/', home);

function home(){
    echo 'Hello, world';
}

?>
