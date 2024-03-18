<?php

function view(string $view, array $data = []){
    $path = dirname(__FILE__, 2).DIRECTORY_SEPARATOR."views";

    $template = new \League\Plates\Engine($path);

    echo $template->render($view, $data);
}

function dd(mixed $var){
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;
}