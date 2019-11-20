<?php
require('vendor/autoload.php');

//config do Flight
Flight::set ('flight.log_errors', true);
$app = new flight\Engine ();

//config do Twig
$loader = new Twig_Loader_Filesystem ('templates');
$twig = new Twig_Environment (
    $loader,
    array (
        'autoescape' => true,
        'debug' => true,
        'strict_variables' => false,
        //'cache' => 'templates/cache'
    )
);
$twig -> addExtension (new Twig_Extension_Debug());
?>
