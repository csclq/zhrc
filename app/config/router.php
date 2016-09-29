<?php
$router= new \Phalcon\Mvc\Router();
$router->notFound(
    [
        "controller" => "index",
        "action"     => "route404",
    ]
);