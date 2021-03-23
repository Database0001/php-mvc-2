<?php

function view($view, $args = [], $_data = [])
{

    $data = [
        'ext' => 'php',
        'path' => 'Views',
        'can_abort' => 1
    ];

    foreach ($_data as $key => $val) {
        $data[$key] = $val;
    }

    $view = str_replace('.', '/', $view);
    $file = base_path("/src/" . $data['path'] . "/$view.f." . $data['ext']);

    if (file_exists($file))
        return template($file, $args);


    if ($data['can_abort'] == 1)
        abort(404, ['message' => "Böyle bir view bulunamadı."]);
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
