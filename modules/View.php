<?php

function view($view, $args = [], $ext = "php")
{

    $view = str_replace('.', '\\', $view);
    $file = base_path("\src\Views\\$view.f.$ext");

    if (file_exists($file))
        return template($file, $args);
}

function template($file, $args)
{

    extract($args);

    ob_start();
    include($file);
    $fileContent = ob_get_contents();
    ob_clean();
    ob_end_flush();


    echo $fileContent;
}
